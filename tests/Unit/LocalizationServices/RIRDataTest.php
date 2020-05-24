<?php
declare(strict_types = 1)
	;

namespace OCA\Geoblocker\Tests\Unit\LocalizationService;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\LocalizationServices\RIRData;

class RIRDataTest extends TestCase {
	protected $config;
	protected $db;
	protected $l;
	private $rir_data;

	public function setUp(): void {
		parent::setUp();
		$tmp_config = $this->getMockBuilder ( 'OCP\IConfig' )->getMock ();
		$this->config = $this->getMockBuilder (
				'OCA\GeoBlocker\Config\GeoBlockerConfig' )->setConstructorArgs (
						[ $tmp_config
						] )->getMock ();
		$this->db = $this->getMockBuilder('OCP\IDbConnection')->getMock();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();		
		$this->l->method('t')->will(
				$this->returnCallback(
						array($this,'callbackLTJustRouteThrough')));
		$this->rir_data = new RIRData($this->l,$this->db,$this->config);
	}
	
	public function testIsIpv6String2Int64Correct() {
		$ip = "::"; 
		$this->assertEquals(-9223372036854775808, RIRData::ipv6String2Int64($ip));
		
		$ip = "0:0:0:0::";
		$this->assertEquals(-9223372036854775808, RIRData::ipv6String2Int64($ip));
		
		$ip = "ffff:ffff:ffff:ffff::";
		$this->assertEquals(9223372036854775807, RIRData::ipv6String2Int64($ip));
		
		$ip = "7fff:ffff:ffff:ffff::";
		$this->assertEquals(-1, RIRData::ipv6String2Int64($ip));
		
		$ip = "8000:0:0:0::";
		$this->assertEquals(0, RIRData::ipv6String2Int64($ip));
	}
	
	public function testIsIpv6String2Int64Correct2() {
		$ip = "1::";
		$ip2 = "0:0:0:1::";
		
		$this->assertNotEquals(RIRData::ipv6String2Int64($ip2), RIRData::ipv6String2Int64($ip));
		
		$ip = "ABCD:1234:4312:DBCA::";
		$ip2 = "ABCD:1234:4312:DBCA:FFFF:EEEE:1111:5555";
		
		$this->assertEquals(RIRData::ipv6String2Int64($ip2), RIRData::ipv6String2Int64($ip));
	}
	

// 	public function testIsValidStatusOk() {
// 		$this->cmd_wrapper->method('geoiplookup')->will(
// 				$this->returnCallback(array($this,'callbackGeoIpLookupValid')));
// 		$this->cmd_wrapper->method('geoiplookup6')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Valid')));
// 		$this->assertTrue($this->geo_ip_lookup->getStatus());
// 	}

// 	public function testIsInvalidStatusOk() {
// 		$this->cmd_wrapper->method('geoiplookup')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookupInvalid')));
// 		$this->cmd_wrapper->method('geoiplookup6')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Invalid')));
// 		$this->assertFalse($this->geo_ip_lookup->getStatus());
// 	}

// 	public function testIsValidStatusStringOk() {
// 		$this->cmd_wrapper->method('geoiplookup')->will(
// 				$this->returnCallback(array($this,'callbackGeoIpLookupValid')));
// 		$this->cmd_wrapper->method('geoiplookup6')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Valid')));

// 		$result = '"Geoiplookup": OK.';
// 		$this->assertEquals($result, $this->geo_ip_lookup->getStatusString());
// 	}

// 	public function testIsInvalidStatusStringOk() {
// 		$this->cmd_wrapper->method('geoiplookup')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookupInvalid')));
// 		$this->cmd_wrapper->method('geoiplookup6')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Invalid')));
// 		$result = '"Geoiplookup": ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini.';
// 		$this->assertEquals($result, $this->geo_ip_lookup->getStatusString());
// 	}

// 	public function testIsCountryCodeFromValidIpOk() {
// 		$this->cmd_wrapper->method('geoiplookup')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookupValidIP')));
// 		$this->cmd_wrapper->method('geoiplookup6')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6ValidIP')));
// 		$ip_address = '2a02:2e0:3fe:1001:302::';
// 		$country_code = 'DE';
// 		$this->assertEquals($country_code,
// 				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));

// 		$country_code = 'US';
// 		$ip_address = '24.165.23.67';
// 		$this->assertEquals($country_code,
// 				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
// 	}

// 	public function testIsCountryCodeFromInvalidIp1Ok() {
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
// 				'127.0.0.1')->will(
// 				$this->returnCallback(array($this,'callbackGeoIpLookupValid')));
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
// 				'fe80::')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Valid')));
// 		$ip_address = '291.133.564.12';
// 		$this->assertEquals('INVALID_IP',
// 				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
// 	}

// 	public function testIsCountryCodeFromInvalidIp2Ok() {
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
// 				'127.0.0.1')->will(
// 				$this->returnCallback(array($this,'callbackGeoIpLookupValid')));
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
// 				'fe80::')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Valid')));
// 		$ip_address = 'aöerb03s';
// 		$this->assertEquals('INVALID_IP',
// 				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
// 	}

// 	public function testIsCountryCodeFromInvalidIp3Ok() {
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
// 				'127.0.0.1')->will(
// 				$this->returnCallback(array($this,'callbackGeoIpLookupValid')));
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
// 				'fe80::')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Valid')));
// 		$ip_address = '2a023:2e0:3fe:1001:302::';
// 		$this->assertEquals('INVALID_IP',
// 				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
// 	}

// 	public function testIsCountryCodeFromValidIpButInvalidServiceOk() {
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
// 				'127.0.0.1')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookupInvalid')));
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
// 				'fe80::')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Invalid')));
// 		$ip_address = '2a02:2e0:3fe:1001:302::';
// 		$this->assertEquals('UNAVAILABLE',
// 				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
// 	}

// 	public function testIsCountryCodeFromValidIpButNonsenseServiceOk() {
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup')->with(
// 				'127.0.0.1')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookupNonsense')));
// 		$this->cmd_wrapper->expects($this->once())->method('geoiplookup6')->with(
// 				'fe80::')->will(
// 				$this->returnCallback(
// 						array($this,'callbackGeoIpLookup6Nonsense')));
// 		$ip_address = '2a02:2e0:3fe:1001:302::';
// 		$this->assertEquals('UNAVAILABLE',
// 				$this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
// 	}

// 	public function callbackGeoIpLookupInvalid(string $ip_address,
// 			array &$output, int &$return_var): String {
// 		$output = array();
// 		$return_var = - 1;
// 		return 'Command not found';
// 	}

// 	public function callbackGeoIpLookup6Invalid(string $ip_address,
// 			array &$output, int &$return_var): String {
// 		$output = array();
// 		$return_var = - 1;
// 		return 'Command not found';
// 	}

// 	public function callbackGeoIpLookupNonsense(string $ip_address,
// 			array &$output, int &$return_var): String {
// 		$output = array();
// 		$return_var = - 1;
// 		return 'Nonsense';
// 	}

// 	public function callbackGeoIpLookup6Nonsense(string $ip_address,
// 			array &$output, int &$return_var): String {
// 		$output = array();
// 		$return_var = - 1;
// 		return 'Nonsense';
// 	}

// 	public function callbackGeoIpLookupValid(string $ip_address, array &$output,
// 			int &$return_var): String {
// 		$output = array('GeoIP Country Edition: IP Address not found');
// 		$return_var = 0;
// 		return 'GeoIP Country Edition: IP Address not found';
// 	}

// 	public function callbackGeoIpLookup6Valid(string $ip_address, array &$output,
// 			int &$return_var): String {
// 		$output = array('GeoIP Country V6 Edition: IP Address not found');
// 		$return_var = 0;
// 		return 'GeoIP Country V6 Edition: IP Address not found';
// 	}

// 	public function callbackGeoIpLookupValidIP(string $ip_address,
// 			array &$output, int &$return_var): String {
// 		if ($ip_address === '127.0.0.1') {
// 			$output = array('GeoIP Country Edition: IP Address not found');
// 			$return_var = 0;
// 			return 'GeoIP Country Edition: IP Address not found';
// 		} else {
// 			$output = array('GeoIP Country Edition: US, United States');
// 			$return_var = 0;
// 			return 'GeoIP Country Edition: US, United States';
// 		}
// 	}

// 	public function callbackGeoIpLookup6ValidIP(string $ip_address,
// 			array &$output, int &$return_var): String {
// 		if ($ip_address === 'fe80::') {
// 			$output = array('GeoIP Country V6 Edition: IP Address not found');
// 			$return_var = 0;
// 			return 'GeoIP Country V6 Edition: IP Address not found';
// 		} else {
// 			$output = array('GeoIP Country V6 Edition: DE, Germany');
// 			$return_var = 0;
// 			return 'GeoIP Country V6 Edition: DE, Germany';
// 		}
// 	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}

?>