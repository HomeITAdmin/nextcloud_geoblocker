<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Integration;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookupCmdWrapper;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;
use PHPUnit\Framework\MockObject\Rule\InvokedCount as InvokedCountMatcher;
use OC\User\LoginException;

class GeoBlockerIntegrationTest extends TestCase {
	protected $user;
	protected $logger;
	protected $config;
	protected $l;
	protected $location_service;
	protected $geoblocker;

	public function setUp(): void {
		parent::setUp();
	}

	private function mySetUp(): void {
		$this->user = 'admin';
		$this->logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();
		$tmp_config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
	}

	private function doCheckTest(String $ip_address, String $country_code,
			InvokedCountMatcher $invokerLocationService,
			String $log_string_template, String $log_method,
			InvokedCountMatcher $invokerLogging, bool $blocking_active = true,
			bool $expect_blocking = false, bool $isCountryInList = false,
			bool $useWhiteListing = false, bool $logWithUserName = true,
			bool $logWithCountryCode = true, bool $logWithIPAdress = true) {
		$log_string = sprintf($log_string_template, $this->user, $ip_address,
				$country_code);
		// $this->location_service->expects ( $invokerLocationService )->method (
		// 'getCountryCodeFromIP' )->with ( $this->equalTo ( $ip_address ) )->willReturn (
		// $country_code );
		$this->config->method('getLogWithUserName')->will(
				$this->returnValue($logWithUserName));
		$this->config->method('getLogWithCountryCode')->will(
				$this->returnValue($logWithCountryCode));
		$this->config->method('getLogWithIpAddress')->will(
				$this->returnValue($logWithIPAdress));
		$this->config->method('isCountryCodeInListOfChoosenCountries')->with(
				$this->equalTo($country_code))->will(
				$this->returnValue($isCountryInList));
		$this->config->method('getUseWhiteListing')->with()->will(
				$this->returnValue($useWhiteListing));
		$this->config->method('getDelayIpAddress')->with()->will(
				$this->returnValue(false));
		$this->config->method('getBlockIpAddress')->with()->will(
				$this->returnValue($blocking_active));
		$this->l->method('t')->will(
				$this->returnCallback([$this,'defaultTranslate']));
		$this->logger->expects($invokerLogging)->method($log_method)->with(
				$this->equalTo($log_string),
				$this->equalTo(['app' => 'geoblocker']));
		if ($expect_blocking) {
			$this->expectException(LoginException::class);
			$this->expectExceptionMessageMatches('/^Your attempt to login from country ".." is blocked by the Nextcloud GeoBlocker App. '
			. 'If this is a problem for you, please contact your administrator.$/');
		}
		$this->geoblocker->blockIpAddress($ip_address);
	}

	public function defaultTranslate() {
		$args = func_get_args();
		$sprintf_args = array_merge([$args[0]], $args[1]);
		return call_user_func_array('sprintf', $sprintf_args);
	}

	/**
	 *
	 * @dataProvider ipCountryListProvider
	 */
	public function testLoginNotBlockedFromGeoiplookup(string $ip_address,
			string $country_code) {
		$this->mySetUp();
		$this->location_service = new GeoIPLookup(new GeoIPLookupCmdWrapper(),
				$this->l);

		$this->geoblocker = new GeoBlocker($this->user, $this->logger,
				$this->config, $this->l, $this->location_service);

		$log_string_template = '';
		$log_method = 'warning';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never());
	}
	
	/**
	 *
	 * @dataProvider ipCountryListProvider
	 */
	public function testLoginBlockedFromGeoiplookup(string $ip_address,
			string $country_code) {
		$this->mySetUp();
		$this->location_service = new GeoIPLookup(new GeoIPLookupCmdWrapper(),
				$this->l);

		$this->geoblocker = new GeoBlocker($this->user, $this->logger,
				$this->config, $this->l, $this->location_service);

		$log_string_template = 'The user "%s" attempt to login with IP address "%s" from blocked country "%s". Login is blocked.';
		$log_method = 'warning';
		$isCountryInList = true;
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->once(), true, true,
				$isCountryInList);
	}

	/**
	 *
	 * @dataProvider ipCountryListProvider
	 */
	public function testLoginNotBlockedFromMaxmindGeoLite2(string $ip_address,
			string $country_code) {
		$this->mySetUp();
		$this->location_service = new MaxMindGeoLite2($this->config, $this->l, $this->logger);

		$this->geoblocker = new GeoBlocker($this->user, $this->logger,
				$this->config, $this->l, $this->location_service);

		$log_string_template = '';
		$log_method = 'warning';
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->never());
	}

	/**
	 *
	 * @dataProvider ipCountryListProvider
	 */
	public function testLoginBlockedFromMaxmindGeoLite2(string $ip_address,
			string $country_code) {
		$this->mySetUp();
		$this->location_service = new MaxMindGeoLite2($this->config, $this->l, $this->logger);

		$this->geoblocker = new GeoBlocker($this->user, $this->logger,
				$this->config, $this->l, $this->location_service);

		$log_string_template = 'The user "%s" attempt to login with IP address "%s" from blocked country "%s". Login is blocked.';
		$log_method = 'warning';
		$isCountryInList = true;
		$this->doCheckTest($ip_address, $country_code, $this->once(),
				$log_string_template, $log_method, $this->once(), true, true,
				$isCountryInList);
	}

	public function ipCountryListProvider(): array {
		return ["ip_v6" => ['2a02:2e0:3fe:1001:302::','DE'],
			"ip_v4" => ['24.165.23.67','US']];
	}
}
