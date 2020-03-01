<?php
declare(strict_types = 1)
	;

namespace OCA\Geoblocker\Tests\Integration;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\App;
use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookupCmdWrapper;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoIP2;
use PHPUnit\Framework\MockObject\Rule\InvokedCount as InvokedCountMatcher;

class GeoblockerIntegrationTest extends TestCase {
	protected $user;
	protected $logger;
	protected $config;
	protected $l;
	protected $location_service;
	protected $geoblocker;
	public function setUp(): void {
		parent::setUp ();
	}
	private function mySetUp(): void {
		$this->user = 'admin';
		$this->logger = $this->getMockBuilder ( 'OCP\ILogger' )->getMock ();
		$tmp_config = $this->getMockBuilder ( 'OCP\IConfig' )->getMock ();
		$this->config = $this->getMockBuilder ( 
				'OCA\GeoBlocker\Config\GeoBlockerConfig' )->setConstructorArgs ( 
				[ $tmp_config
				] )->getMock ();
		$this->l = $this->getMockBuilder ( 'OCP\IL10N' )->getMock ();
	}
	private function doCheckTest(String $ip_address, String $country_code,
			InvokedCountMatcher $invokerLocationService,
			String $log_string_template, String $log_method,
			InvokedCountMatcher $invokerLogging, bool $isCountryInList = FALSE,
			bool $useWhiteListing = FALSE, bool $logWithUserName = TRUE,
			bool $logWithCountryCode = TRUE, bool $logWithIPAdress = TRUE) {
		$log_string = sprintf ( $log_string_template, $this->user, $ip_address,
				$country_code );
		// $this->location_service->expects ( $invokerLocationService )->method (
		// 'getCountryCodeFromIP' )->with ( $this->equalTo ( $ip_address ) )->willReturn (
		// $country_code );
		$this->config->method ( 'getLogWithUserName' )->will ( 
				$this->returnValue ( $logWithUserName ) );
		$this->config->method ( 'getLogWithCountryCode' )->will ( 
				$this->returnValue ( $logWithCountryCode ) );
		$this->config->method ( 'getLogWithIpAddress' )->will ( 
				$this->returnValue ( $logWithIPAdress ) );
		$this->config->method ( 'isCountryCodeInListOfChoosenCountries' )->with ( 
				$this->equalTo ( $country_code ) )->will ( 
				$this->returnValue ( $isCountryInList ) );
		$this->config->method ( 'getUseWhiteListing' )->with ()->will ( 
				$this->returnValue ( $useWhiteListing ) );
		$this->l->method ( 't' )->will ( 
				$this->returnCallback ( array ($this,'defaultTranslate'
				) ) );
		$this->logger->expects ( $invokerLogging )->method ( $log_method )->with ( 
				$this->equalTo ( $log_string ),
				$this->equalTo ( array ('app' => 'geoblocker'
				) ) );
		$this->geoblocker->check ( $ip_address );
	}
	public function defaultTranslate() {
		$args = func_get_args ();
		$sprintf_args = array_merge ( array ($args [0]
		), $args [1] );
		return call_user_func_array ( 'sprintf', $sprintf_args );
	}
	public function testLoggingNotBlockedFromGeoiplookup() {
		$this->mySetUp ();
		$this->location_service = new GeoIPLookup ( 
				new GeoIPLookupCmdWrapper (), $this->l );

		$this->geoblocker = new GeoBlocker ( $this->user, $this->logger,
				$this->config, $this->l, $this->location_service );
		
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = '';
		$log_method = 'warning';
		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
				$log_string_template, $log_method, $this->never () );
		
// 		$ip_address = '24.165.23.67';
// 		$country_code = 'US';
// 		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
// 				$log_string_template, $log_method, $this->never () );
	}
	public function testLoggingBlockedFromGeoiplookup() {
		$this->mySetUp ();
		$this->location_service = new GeoIPLookup ( 
				new GeoIPLookupCmdWrapper (), $this->l );

		$this->geoblocker = new GeoBlocker ( $this->user, $this->logger,
				$this->config, $this->l, $this->location_service );

		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = 'The user "%s" logged in with IP address "%s" from blocked country "%s".';
		$log_method = 'warning';
		$isCountryInList = TRUE;
		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
				$log_string_template, $log_method, $this->once (),
				$isCountryInList );

// 		$ip_address = '24.165.23.67';
// 		$country_code = 'US';
// 		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
// 				$log_string_template, $log_method, $this->once (),
// 				$isCountryInList );
	}
	public function testLoggingNotBlockedFromMaxmindGeoip2() {
		$this->mySetUp ();
		$this->location_service = new MaxMindGeoIP2($this->l);
		
		$this->geoblocker = new GeoBlocker ( $this->user, $this->logger,
				$this->config, $this->l, $this->location_service );
		
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = '';
		$log_method = 'warning';
		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
				$log_string_template, $log_method, $this->never () );
		
		// 		$ip_address = '24.165.23.67';
		// 		$country_code = 'US';
		// 		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
		// 				$log_string_template, $log_method, $this->never () );
	}
	public function testLoggingBlockedFromMaxmindGeoip2() {
		$this->mySetUp ();
		$this->location_service = new MaxMindGeoIP2($this->l);
		
		$this->geoblocker = new GeoBlocker ( $this->user, $this->logger,
				$this->config, $this->l, $this->location_service );
		
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$log_string_template = 'The user "%s" logged in with IP address "%s" from blocked country "%s".';
		$log_method = 'warning';
		$isCountryInList = TRUE;
		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
				$log_string_template, $log_method, $this->once (),
				$isCountryInList );
		
		// 		$ip_address = '24.165.23.67';
		// 		$country_code = 'US';
		// 		$this->doCheckTest ( $ip_address, $country_code, $this->once (),
		// 				$log_string_template, $log_method, $this->once (),
		// 				$isCountryInList );
	}
}