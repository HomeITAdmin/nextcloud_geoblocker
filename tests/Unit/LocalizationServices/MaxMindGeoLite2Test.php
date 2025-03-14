<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\LocalizationService;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

class MaxMindGeoLite2Test extends TestCase {
	protected $l;
	protected $logger;
	protected $config;
	private $geo_ip_lookup;

	public function setUp(): void {
		parent::setUp();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->l->method('t')->will(
				$this->returnCallback([$this,'callbackLTJustRouteThrough']));
		$this->logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();
		$tmp_config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
		$this->geo_ip_lookup = new MaxMindGeoLite2($this->config, $this->l, $this->logger);
	}

	public function testIsValidStatusOk() {
		$this->assertTrue($this->geo_ip_lookup->getStatus());
	}

	// public function testIsInvalidStatusOk() {
	// $phar_file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
	// '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
	// '3rdparty' . DIRECTORY_SEPARATOR . 'maxmind_geolite2' .
	// DIRECTORY_SEPARATOR . '' . 'geoip2.phar';
	// $this->assertTrue(file_exists($phar_file));
	// rename($phar_file, $phar_file . 'bak');
	// try {
	// $this->geo_ip_lookup = new MaxMindGeoLite2($this->config, $this->l);
	// $this->assertFalse($this->geo_ip_lookup->getStatus());
	// } finally {
	// rename($phar_file . 'bak', $phar_file);
	// }
	// }
	public function testIsValidStatusStringOk() {
		// $this->cmd_wrapper->method ( 'geoiplookup' )->will (
		// $this->returnCallback (
		// array ($this,'callbackGeoIpLookupValid'
		// ) ) );
		// $this->cmd_wrapper->method ( 'geoiplookup6' )->will (
		// $this->returnCallback (
		// array ($this,'callbackGeoIpLookup6Valid'
		// ) ) );
		$result = '"MaxMind GeoLite2": OK.';
		$this->assertEquals($result, $this->geo_ip_lookup->getStatusString());
	}

	// public function testIsInvalidStatusStringOk() {
	// $this->cmd_wrapper->method ( 'geoiplookup' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookupInvalid'
	// ) ) );
	// $this->cmd_wrapper->method ( 'geoiplookup6' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookup6Invalid'
	// ) ) );
	// $result = 'ERROR: "geoiplookup" seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini.';
	// $this->assertEquals ( $result, $this->geo_ip_lookup->getStatusString () );
	// }
	public function testIsCountryCodeFromValidIpOk() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$this->assertEquals($country_code,
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));

		$country_code = 'US';
		$ip_address = '24.165.23.67';
		$this->assertEquals($country_code,
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromNotFoundIpOk() {
		$ip_address = 'fe80::';
		$country_code = GeoBlocker::kCountryNotFoundCode;
		$this->assertEquals($country_code,
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));

		$ip_address = '127.0.0.1';
		$country_code = GeoBlocker::kCountryNotFoundCode;
		$this->assertEquals($country_code,
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	// public function testIsCountryCodeFromInvalidIp1Ok() {
	// $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup' )->with (
	// '127.0.0.1' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookupValid'
	// ) ) );
	// $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup6' )->with (
	// 'fe80::' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookup6Valid'
	// ) ) );
	// $ip_address = '291.133.564.12';
	// $this->assertEquals ( 'INVALID_IP',
	// $this->geo_ip_lookup->getCountryCodeFromIP ( $ip_address ) );
	// }
	// public function testIsCountryCodeFromInvalidIp2Ok() {
	// $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup' )->with (
	// '127.0.0.1' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookupValid'
	// ) ) );
	// $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup6' )->with (
	// 'fe80::' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookup6Valid'
	// ) ) );
	// $ip_address = 'aöerb03s';
	// $this->assertEquals ( 'INVALID_IP',
	// $this->geo_ip_lookup->getCountryCodeFromIP ( $ip_address ) );
	// }
	// public function testIsCountryCodeFromInvalidIp3Ok() {
	// $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup' )->with (
	// '127.0.0.1' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookupValid'
	// ) ) );
	// $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup6' )->with (
	// 'fe80::' )->will (
	// $this->returnCallback (
	// array ($this,'callbackGeoIpLookup6Valid'
	// ) ) );
	// $ip_address = '2a023:2e0:3fe:1001:302::';
	// $this->assertEquals ( 'INVALID_IP',
	// $this->geo_ip_lookup->getCountryCodeFromIP ( $ip_address ) );
	// }
	// // public function testIsCountryCodeFromValidIpButInvalidServiceOk() {
	// // $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup' )->with (
	// // '127.0.0.1' )->will (
	// // $this->returnCallback (
	// // array ($this,'callbackGeoIpLookupInvalid'
	// // ) ) );
	// // $this->cmd_wrapper->expects ( $this->once () )->method ( 'geoiplookup6' )->with (
	// // 'fe80::' )->will (
	// // $this->returnCallback (
	// // array ($this,'callbackGeoIpLookup6Invalid'
	// // ) ) );
	// // $ip_address = '2a02:2e0:3fe:1001:302::';
	// // $this->assertEquals ( 'UNAVAILABLE',
	// // $this->geo_ip_lookup->getCountryCodeFromIP ( $ip_address ) );
	// // }
	// public function callbackGeoIpLookupInvalid(string $ip_address,
	// array &$output, int &$return_var): String {
	// $output = array ();
	// $return_var = - 1;
	// return 'Command not found';
	// }
	// public function callbackGeoIpLookup6Invalid(string $ip_address,
	// array &$output, int &$return_var): String {
	// $output = array ();
	// $return_var = - 1;
	// return 'Command not found';
	// }
	// public function callbackGeoIpLookupValid(string $ip_address, array &$output,
	// int &$return_var): String {
	// $output = array ('GeoIP Country Edition: IP Address not found'
	// );
	// $return_var = 0;
	// return 'GeoIP Country Edition: IP Address not found';
	// }
	// public function callbackGeoIpLookup6Valid(string $ip_address, array &$output,
	// int &$return_var): String {
	// $output = array ('GeoIP Country V6 Edition: IP Address not found'
	// );
	// $return_var = 0;
	// return 'GeoIP Country V6 Edition: IP Address not found';
	// }
	// public function callbackGeoIpLookupValidIP(string $ip_address,
	// array &$output, int &$return_var): String {
	// if ($ip_address === '127.0.0.1') {
	// $output = array ('GeoIP Country Edition: IP Address not found'
	// );
	// $return_var = 0;
	// return 'GeoIP Country Edition: IP Address not found';
	// } else {
	// $output = array ('GeoIP Country Edition: DE, Germany'
	// );
	// $return_var = 0;
	// return 'GeoIP Country Edition: DE, Germany';
	// }
	// }
	// public function callbackGeoIpLookup6ValidIP(string $ip_address,
	// array &$output, int &$return_var): String {
	// if ($ip_address === 'fe80::') {
	// $output = array ('GeoIP Country V6 Edition: IP Address not found'
	// );
	// $return_var = 0;
	// return 'GeoIP Country V6 Edition: IP Address not found';
	// } else {
	// $output = array ('GeoIP Country V6 Edition: DE, Germany'
	// );
	// $return_var = 0;
	// return 'GeoIP Country V6 Edition: DE, Germany';
	// }
	// }
	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
