<?php
declare(strict_types = 1)
	;

namespace OCA\Geoblocker\Tests\Unit\LocalizationService;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;

class GeoIPLookupTest extends TestCase {
	// TODO: How to Mock the service? To also test no valid service.
	private $geo_ip_lookup;
	public function setUp(): void {
		$this->geo_ip_lookup = new GeoIPLookup ();
	}
	public function testIsValidStatusOk() {
		$this->assertTrue ( $this->geo_ip_lookup->getStatus () );
	}
	public function testIsValidStatusStringOk() {
		$result = 'OK.  (Please make sure the databases are up to date. This is currently not checked here.)';
		$this->assertEquals ( $result, $this->geo_ip_lookup->getStatusString () );
	}
	public function testIsCountryCodeFromValidIpOk() {
		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$this->assertEquals($country_code, $this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
		
		$ip_address = '24.165.23.67';
		$country_code = 'US';
		$this->assertEquals($country_code, $this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}
	public function testIsCountryCodeFromInvalidIpOk() {
		$ip_address = '291.133.564.12';
		$this->assertEquals('INVALID_IP', $this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
		
		$ip_address = 'aöerb03s';
		$this->assertEquals('INVALID_IP', $this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
		
		$ip_address = '2a023:2e0:3fe:1001:302::';
		$this->assertEquals('INVALID_IP', $this->geo_ip_lookup->getCountryCodeFromIP($ip_address));
	}
}

?>