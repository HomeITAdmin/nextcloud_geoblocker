<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\GeoBlocker;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;
use PHPUnit\Framework\MockObject\Rule\InvokedCount as InvokedCountMatcher;
use OC\User\LoginException;

class GeoBlockerTest extends TestCase {
	protected $user;
	protected $logger;
	protected $config;
	protected $l;
	protected $location_service;
	protected $geo_blocker;

	private function mySetUp(): void {
		$this->user = 'admin';
		$this->logger = $this->getMockBuilder('OCP\ILogger')->getMock();
		$tmp_config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->location_service = $this->getMockBuilder(
				'OCA\GeoBlocker\LocalizationServices\ILocalizationService')->getMock();
		$this->geo_blocker = new GeoBlocker($this->user, $this->logger,
				$this->config, $this->l, $this->location_service);
	}

	private function doCheckTest(String $ip_address, String $country_code,
			InvokedCountMatcher $invoker_location_service,
			String $log_string_template, String $log_method,
			InvokedCountMatcher $invoker_logging, bool $blocking_active = true,
			bool $expect_blocking = false, bool $is_country_in_list = false,
			bool $use_white_listing = false, bool $log_with_user_name = true,
			bool $log_with_country_code = true, bool $log_with_ip_address = true) {
		$this->mySetUp();
		$log_string = sprintf($log_string_template, $this->user, $ip_address,
				$country_code);
		$this->location_service->expects($invoker_location_service)->method(
				'getCountryCodeFromIP')->with($this->equalTo($ip_address))->willReturn(
				$country_code);
		$this->config->method('getLogWithUserName')->will(
				$this->returnValue($log_with_user_name));
		$this->config->method('getLogWithCountryCode')->will(
				$this->returnValue($log_with_country_code));
		$this->config->method('getLogWithIpAddress')->will(
				$this->returnValue($log_with_ip_address));
		$this->config->method('isCountryCodeInListOfChoosenCountries')->with(
				$this->equalTo($country_code))->will(
				$this->returnValue($is_country_in_list));
		$this->config->method('getUseWhiteListing')->with()->will(
				$this->returnValue($use_white_listing));
		$this->config->method('getDelayIpAddress')->with()->will(
				$this->returnValue(false));
		$this->config->method('getBlockIpAddress')->with()->will(
				$this->returnValue($blocking_active));
		$this->l->method('t')->will(
				$this->returnCallback([$this,'defaultTranslate']));
		$this->logger->expects($invoker_logging)->method($log_method)->with(
				$this->equalTo($log_string),
				$this->equalTo(['app' => 'geoblocker']));
		if ($expect_blocking) {
			$this->expectException(LoginException::class);
			$this->expectExceptionMessageMatches('/^Your attempt to login from country ".." is blocked by the Nextcloud GeoBlocker App. '
			. 'If this is a problem for you, please contact your administrator.$/');
		}
		$this->geo_blocker->blockIpAddress($ip_address);
	}

	public function defaultTranslate() {
		$args = func_get_args();
		$sprintf_args = array_merge([$args[0]], $args[1]);
		return call_user_func_array('sprintf', $sprintf_args);
	}

	public function testIsCountryLoggedBlockedBlacklist() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = 'The user "%s" attempt to login with IP address "%s" from blocked country "%s".';
		$log_method = 'warning';
		$isCountryInList = true;
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " No reaction is activated.", $log_method,
				$this->once(), false, false, $isCountryInList);
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " Login is blocked.", $log_method,
				$this->once(), true, true, $isCountryInList);

		$ip_address = '24.165.23.67';
		$country_code = 'US';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " No reaction is activated.", $log_method,
				$this->once(), false, false, $isCountryInList);
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " Login is blocked.", $log_method,
				$this->once(), true, true, $isCountryInList);
	}

	public function testIsCountryLoggedBlockedWhitelist() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = 'The user "%s" attempt to login with IP address "%s" from blocked country "%s".';
		$log_method = 'warning';
		$isCountryInList = false;
		$useWhiteListing = true;
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " No reaction is activated.", $log_method,
				$this->once(), false, false, $isCountryInList, $useWhiteListing);
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " Login is blocked.", $log_method,
				$this->once(), true, true, $isCountryInList, $useWhiteListing);

		$ip_address = '24.165.23.67';
		$country_code = 'US';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " No reaction is activated.", $log_method,
				$this->once(), false, false, $isCountryInList, $useWhiteListing);
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template . " Login is blocked.", $log_method,
				$this->once(), true, true, $isCountryInList, $useWhiteListing);
	}

	public function testIsCountryNotLoggedBlacklist() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = '';
		$log_method = 'warning';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never());
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never(), true, false);

		$ip_address = '24.165.23.67';
		$country_code = 'US';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never());
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never(), true, false);
	}

	public function testIsCountryNotLoggedWhitelist() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = '';
		$log_method = 'warning';
		$isCountryInList = true;
		$useWhiteListing = true;
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never(), false, false,
				$isCountryInList, $useWhiteListing);
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never(), true, false,
				$isCountryInList, $useWhiteListing);

		$ip_address = '24.165.23.67';
		$country_code = 'US';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never(), false, false,
				$isCountryInList, $useWhiteListing);
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never(), true, false,
				$isCountryInList, $useWhiteListing);
	}

	public function testIsLocalIpAddressIgnored() {
		$ip_address = '127.0.0.23';
		$country_code = '';
		$log_string_template = '';
		$log_method = 'warning';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->never());

		$ip_address = '192.168.5.12';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->never());

		$ip_address = '10.234.122.37';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->never());

		$ip_address = '169.254.7.30';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->never());

		$ip_address = '172.23.25.77';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->never());

		$ip_address = 'fe80::';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->never());

		$ip_address = 'fc00::';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->never());
	}

	public function testIsInvalidIpLogged() {
		$ip_address = '234234.23456.831.24667.8876';
		$country_code = 'INVALID_IP';
		$log_string_template = 'The user "%s" attempt to login with an invalid IP address "%s".';
		$log_method = 'warning';
		$this->doCheckTest($ip_address, $country_code, $this->never(),
				$log_string_template, $log_method, $this->once());
	}

	public function testIsUnavailableServiceLogged() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'UNAVAILABLE';
		$log_string_template = 'The login of user "%s" with IP address "%s" could not be checked due to problems with location service.';
		$log_method = 'warning';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->once());
	}

	public function testIsLogInformationProtectionWorking() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = 'The user "NOT_SHOWN_IN_LOG" attempt to login with IP address "NOT_SHOWN_IN_LOG" from blocked country "NOT_SHOWN_IN_LOG". Login is blocked.';
		$log_method = 'warning';
		$isCountryInList = true;
		$useWhiteListing = false;
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->once(), true, true,
				$isCountryInList, $useWhiteListing, false, false, false);

		$log_string_template = 'The user "%s" attempt to login with IP address "NOT_SHOWN_IN_LOG" from blocked country "NOT_SHOWN_IN_LOG". No reaction is activated.';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->once(), false, false,
				$isCountryInList, $useWhiteListing, true, false, false);

		$log_string_template = 'The user "%s" attempt to login with IP address "%s" from blocked country "NOT_SHOWN_IN_LOG". Login is blocked.';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->once(), true, true,
				$isCountryInList, $useWhiteListing, true, false, true);

		$log_string_template = 'The user "%s" attempt to login with IP address "%s" from blocked country "%s". No reaction is activated.';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->once(), false, false,
				$isCountryInList, $useWhiteListing, true, true, true);
	}
}
