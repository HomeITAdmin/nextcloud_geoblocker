<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\GeoBlocker;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;
use PHPUnit\Framework\MockObject\Rule\InvokedCount as InvokedCountMatcher;
use OC\User\LoginException;
use PHPUnit\Framework\Attributes\DataProvider;

class GeoBlockerTest extends TestCase {
	protected $user;
	protected $logger;
	protected $config;
	protected $l;
	protected $location_service;
	protected $geo_blocker;

	private function mySetUp(): void {
		$this->user = 'admin';
		$this->logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();
		$tmp_config = $this->createStub('OCP\IConfig');
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
		$this->l = $this->createStub('OCP\IL10N');
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
		$this->config->method('getLogWithUserName')->willReturn(
				$log_with_user_name);
		$this->config->method('getLogWithCountryCode')->willReturn(
				$log_with_country_code);
		$this->config->method('getLogWithIpAddress')->willReturn(
				$log_with_ip_address);
		$this->config->method('isCountryCodeInListOfChoosenCountries')->willReturnCallback(
				function (string $cc) use ($country_code, $is_country_in_list): bool {
					$this->assertSame($country_code, $cc);
					return $is_country_in_list;
				});
		$this->config->method('getUseWhiteListing')->willReturn(
				$use_white_listing);
		$this->config->method('getDelayIpAddress')->willReturn(
				false);
		$this->config->method('getBlockIpAddress')->willReturn(
				$blocking_active);
		$this->config->expects($this->never())->method('setBlockIpAddress');
		$this->l->method('t')->willReturnCallback(
				[$this,'defaultTranslate']);
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

	public function testLegacyBlockSettingBlocksAndMigratesNewSetting() {
		$this->mySetUp();
		$this->location_service->expects($this->once())->method('getCountryCodeFromIP')->willReturn('DE');
		$this->config->method('isCountryCodeInListOfChoosenCountries')->willReturn(true);
		$this->config->method('getBlockIpAddress')->willReturn(false);
		$this->config->method('getBlockIpAddressBefore')->willReturn(true);
		$this->config->expects($this->once())->method('setBlockIpAddress')->with(true);
		$this->l->method('t')->willReturnCallback([$this,'defaultTranslate']);
		$this->logger->expects($this->once())->method('warning')->with(
			$this->stringEndsWith(' Login is blocked.'), ['app' => 'geoblocker']);
		$this->expectException(LoginException::class);
		$this->expectExceptionMessage('Your attempt to login from country "DE" is blocked');
		$this->geo_blocker->blockIpAddress('24.165.23.67');
	}

	public function testBlockSettingDoesNotRewriteNewSetting() {
		$this->mySetUp();
		$this->location_service->expects($this->once())->method('getCountryCodeFromIP')->willReturn('DE');
		$this->config->method('isCountryCodeInListOfChoosenCountries')->willReturn(true);
		$this->config->method('getBlockIpAddress')->willReturn(true);
		$this->config->method('getBlockIpAddressBefore')->willReturn(true);
		$this->config->expects($this->never())->method('setBlockIpAddress');
		$this->logger->expects($this->once())->method('warning');
		$this->l->method('t')->willReturnCallback([$this,'defaultTranslate']);
		$this->expectException(LoginException::class);
		$this->geo_blocker->blockIpAddress('24.165.23.67');
	}

	public function testNoReactionActivatedIsLoggedWithoutBlocking() {
		$this->mySetUp();
		$this->location_service->expects($this->once())->method('getCountryCodeFromIP')->willReturn('DE');
		$this->config->method('isCountryCodeInListOfChoosenCountries')->willReturn(true);
		$this->config->method('getLogWithUserName')->willReturn(true);
		$this->config->method('getLogWithCountryCode')->willReturn(true);
		$this->config->method('getLogWithIpAddress')->willReturn(true);
		$this->config->expects($this->never())->method('setBlockIpAddress');
		$this->logger->expects($this->once())->method('warning')->with(
			'The user "admin" attempt to login with IP address "24.165.23.67" from blocked country "DE". No reaction is activated.',
			['app' => 'geoblocker']);
		$this->geo_blocker->blockIpAddress('24.165.23.67');
	}

	public static function ipAddressProvider(): array {
		return [
			'public ipv4' => ['8.8.8.8', true, false],
			'public ipv6' => ['2a02:2e0:3fe:1001:302::', true, false],
			'loopback ipv4' => ['127.0.0.1', true, true],
			'private 10/8' => ['10.0.0.1', true, true],
			'private 172.16/12' => ['172.16.0.1', true, true],
			'private 192.168/16' => ['192.168.1.1', true, true],
			'link local ipv4' => ['169.254.1.1', true, true],
			'reserved 240/4' => ['240.0.0.1', true, true],
			'ipv6 loopback' => ['::1', true, true],
			'ipv6 unique local' => ['fc00::1', true, true],
			'ipv6 link local' => ['fe80::1', true, true],
			'invalid octet' => ['256.1.1.1', false, false],
			'garbage' => ['abc', false, false],
			'empty' => ['', false, false],
			'too many octets' => ['1.2.3.4.5', false, false],
		];
	}

	#[DataProvider('ipAddressProvider')]
	public function testIsIPAddressValidAndLocal(string $ip, bool $valid, bool $local) {
		$this->assertSame($valid, GeoBlocker::isIPAddressValid($ip));
		$this->assertSame($local, GeoBlocker::isIPAddressLocal($ip));
	}

	public function testInvalidIpCodeFromLocationServiceIsLogged() {
		$ip_address = '24.165.23.67';
		$this->doCheckTest($ip_address, 'INVALID_IP', $this->once(),
				'The user "%s" attempt to login with an invalid IP address "%s".',
				'warning', $this->once());
	}
}
