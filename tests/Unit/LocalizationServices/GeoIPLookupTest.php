<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\LocalizationService;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;

class GeoIPLookupTest extends TestCase {
	protected $cmd_wrapper;
	protected $l;
	private $geo_ip_lookup;

	public function setUp(): void {
		parent::setUp();
		$this->cmd_wrapper = $this->getMockBuilder(
				'OCA\GeoBlocker\LocalizationServices\GeoIPLookupCmdWrapper')->getMock();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->l->method('t')->will(
				$this->returnCallback(
						[$this,'callbackLTJustRouteThrough']));
		$this->geo_ip_lookup = new GeoIPLookup($this->cmd_wrapper, $this->l);
	}

	public function testIsValidStatusOk() {
		$this->cmd_wrapper->method('geoiplookup')->will(
				$this->returnCallback([$this,'callbackGeoIpLookupValid']));
		$this->cmd_wrapper->method('geoiplookup6')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Valid']));
		$this->assertTrue($this->geo_ip_lookup->getStatus());
	}

	public function testIsInvalidStatusOk() {
		$this->cmd_wrapper->method('geoiplookup')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupInvalid']));
		$this->cmd_wrapper->method('geoiplookup6')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Invalid']));
		$this->assertFalse($this->geo_ip_lookup->getStatus());
	}

	public function testIsValidStatusStringOk() {
		$this->cmd_wrapper->method('geoiplookup')->will(
				$this->returnCallback([$this,'callbackGeoIpLookupValid']));
		$this->cmd_wrapper->method('geoiplookup6')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Valid']));

		$result = '"Geoiplookup": OK.';
		$this->assertEquals($result, $this->geo_ip_lookup->getStatusString());
	}

	public function testIsInvalidStatusStringOk() {
		$this->cmd_wrapper->method('geoiplookup')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupInvalid']));
		$this->cmd_wrapper->method('geoiplookup6')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Invalid']));
		$result = '"Geoiplookup": ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini.';
		$this->assertEquals($result, $this->geo_ip_lookup->getStatusString());
	}

	public function testIsCountryCodeFromValidIpOk() {
		$this->cmd_wrapper->method('geoiplookup')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupValidIP']));
		$this->cmd_wrapper->method('geoiplookup6')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6ValidIP']));
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$this->assertEquals($country_code,
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));

		$country_code = 'US';
		$ip_address = '24.165.23.67';
		$this->assertEquals($country_code,
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromInvalidIp1Ok() {
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
				'127.0.0.1')->will(
				$this->returnCallback([$this,'callbackGeoIpLookupValid']));
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
				'fe80::')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Valid']));
		$ip_address = '291.133.564.12';
		$this->assertEquals('INVALID_IP',
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromInvalidIp2Ok() {
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
				'127.0.0.1')->will(
				$this->returnCallback([$this,'callbackGeoIpLookupValid']));
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
				'fe80::')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Valid']));
		$ip_address = 'aöerb03s';
		$this->assertEquals('INVALID_IP',
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromInvalidIp3Ok() {
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
				'127.0.0.1')->will(
				$this->returnCallback([$this,'callbackGeoIpLookupValid']));
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
				'fe80::')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Valid']));
		$ip_address = '2a023:2e0:3fe:1001:302::';
		$this->assertEquals('INVALID_IP',
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromValidIpButInvalidServiceOk() {
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
				'127.0.0.1')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupInvalid']));
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
				'fe80::')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Invalid']));
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$this->assertEquals('UNAVAILABLE',
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromValidIpButNonsenseServiceOk() {
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
				'127.0.0.1')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupNonsense']));
		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
				'fe80::')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookup6Nonsense']));
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$this->assertEquals('UNAVAILABLE',
				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}

	public function testIsDateFromValidConfigOk() {
		$this->cmd_wrapper->expects($this->once())->method('getFullDateString')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupValidDate']));
		$this->assertEquals('2021-02-22',
				$this->geo_ip_lookup->getDatabaseDate());
	}

	public function testIsDateFromValidConfig2Ok() {
		$this->cmd_wrapper->expects($this->once())->method('getFullDateString')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupValidDate2']));
		$this->assertEquals('2018-11-08',
				$this->geo_ip_lookup->getDatabaseDate());
	}

	public function testIsDateFromInvalidConfigOk() {
		$this->cmd_wrapper->expects($this->once())->method('getFullDateString')->will(
				$this->returnCallback(
						[$this,'callbackGeoIpLookupInvalidDate']));
		$this->assertEquals('Date of the database cannot be determined!',
				$this->geo_ip_lookup->getDatabaseDate());
	}

	public function callbackGeoIpLookupInvalid(string $ip_address,
			array &$output, int &$return_var): String {
		$output = [];
		$return_var = - 1;
		return 'Command not found';
	}

	public function callbackGeoIpLookup6Invalid(string $ip_address,
			array &$output, int &$return_var): String {
		$output = [];
		$return_var = - 1;
		return 'Command not found';
	}

	public function callbackGeoIpLookupNonsense(string $ip_address,
			array &$output, int &$return_var): String {
		$output = [];
		$return_var = - 1;
		return 'Nonsense';
	}

	public function callbackGeoIpLookup6Nonsense(string $ip_address,
			array &$output, int &$return_var): String {
		$output = [];
		$return_var = - 1;
		return 'Nonsense';
	}

	public function callbackGeoIpLookupValid(string $ip_address, array &$output,
			int &$return_var): String {
		$output = ['GeoIP Country Edition: IP Address not found'];
		$return_var = 0;
		return 'GeoIP Country Edition: IP Address not found';
	}

	public function callbackGeoIpLookup6Valid(string $ip_address, array &$output,
			int &$return_var): String {
		$output = ['GeoIP Country V6 Edition: IP Address not found'];
		$return_var = 0;
		return 'GeoIP Country V6 Edition: IP Address not found';
	}

	public function callbackGeoIpLookupValidIP(string $ip_address,
			array &$output, int &$return_var): String {
		if ($ip_address === '127.0.0.1') {
			$output = ['GeoIP Country Edition: IP Address not found'];
			$return_var = 0;
			return 'GeoIP Country Edition: IP Address not found';
		} else {
			$output = ['GeoIP Country Edition: US, United States',
				'GeoIP City Edition, Rev 1: US, 00, N/A, N/A, N/A, 37.750999, -97.821999, 0, 0',
				'GeoIP ASNum Edition: AS15169 GOOGLE'];
			$return_var = 0;
			return 'GeoIP ASNum Edition: AS15169 GOOGLE';
		}
	}

	public function callbackGeoIpLookup6ValidIP(string $ip_address,
			array &$output, int &$return_var): String {
		if ($ip_address === 'fe80::') {
			$output = ['GeoIP Country V6 Edition: IP Address not found'];
			$return_var = 0;
			return 'GeoIP Country V6 Edition: IP Address not found';
		} else {
			$output = ['GeoIP Country V6 Edition: DE, Germany'];
			$return_var = 0;
			return 'GeoIP Country V6 Edition: DE, Germany';
		}
	}

	public function callbackGeoIpLookupValidDate(
			array &$output, int &$return_var): String {
		$output = ['GeoIP Country Edition: GeoLite2 Country 20210223',
			'GeoIP City Edition, Rev 1: GeoLite2 City 20210223',
			'GeoIP ASNum Edition:',
			'GeoIP Country V6 Edition: GeoLite2 Country 20210222',
			'GeoIP City Edition V6, Rev 1: GeoLite2 City 20210223',
			'GeoIP ASNum V6 Edition:'];
		$return_var = 0;
		return 'GeoIP ASNum V6 Edition:';
	}

	public function callbackGeoIpLookupValidDate2(
		array &$output, int &$return_var): String {
		$output = ['GeoIP Country Edition: GEO-106FREE 20181108 Build',
			'GeoIP Country V6 Edition: GEO-106FREE 20181108 Build'];
		$return_var = 0;
		return 'GeoIP Country V6 Edition: GEO-106FREE 20181108 Build';
	}

	public function callbackGeoIpLookupInvalidDate(
		array &$output, int &$return_var): String {
		$output = ['Nothing to show'];
		$return_var = 0;
		return 'Nothing to show';
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
