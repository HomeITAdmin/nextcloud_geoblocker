<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\LocalizationServices;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

class MaxMindGeoLite2Test extends TestCase {
	protected $l;
	protected $logger;
	protected $config;
	private $geo_ip_lookup;
	private $temp_files = [];

	public function setUp(): void {
		parent::setUp();
		$this->l = $this->createStub('OCP\IL10N');
		$this->l->method('t')->willReturnCallback(
				[$this,'callbackLTJustRouteThrough']);
		$this->logger = $this->createStub('Psr\Log\LoggerInterface');
		$this->config = $this->createStub(
				'OCA\GeoBlocker\Config\GeoBlockerConfig');
		$this->geo_ip_lookup = new MaxMindGeoLite2($this->config, $this->l, $this->logger);
	}

	protected function tearDown(): void {
		foreach ($this->temp_files as $file) {
			if (file_exists($file)) {
				unlink($file);
			}
		}
		parent::tearDown();
	}

	private function createServiceWithLocation(string $location, $config = null, $logger = null): MaxMindGeoLite2 {
		if ($config === null) {
			$config = $this->createStub('OCA\GeoBlocker\Config\GeoBlockerConfig');
		}
		$config->method('getDatabaseFileLocation')->willReturn($location);
		return new MaxMindGeoLite2($config, $this->l, $logger ?? $this->logger);
	}

	private function createTempFile(string $content): string {
		$file = tempnam(sys_get_temp_dir(), 'geoblocker_mmdb_');
		file_put_contents($file, $content);
		$this->temp_files[] = $file;
		return $file;
	}

	private function nonexistentFile(): string {
		return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'geoblocker_does_not_exist_' . uniqid() . '.mmdb';
	}

	public function testDefaultDatabaseFileLocation() {
		$this->assertSame('/var/lib/GeoIP/GeoLite2-Country.mmdb',
				$this->geo_ip_lookup->getDatabaseFileLocation());
	}

	public function testConfiguredDatabaseFileLocationIsUsed() {
		$config = $this->createMock('OCA\GeoBlocker\Config\GeoBlockerConfig');
		$config->expects($this->once())->method('getDatabaseFileLocation')->with(
				'MaxMindGeoLite2')->willReturn('/some/where/db.mmdb');
		$service = new MaxMindGeoLite2($config, $this->l, $this->logger);
		$this->assertSame('/some/where/db.mmdb', $service->getDatabaseFileLocation());
	}

	public function testSetDatabaseFileLocationStoresInConfig() {
		$config = $this->createMock('OCA\GeoBlocker\Config\GeoBlockerConfig');
		$config->expects($this->once())->method('setDatabaseFileLocation')->with(
				'/new/location.mmdb', 'MaxMindGeoLite2');
		$service = new MaxMindGeoLite2($config, $this->l, $this->logger);
		$service->setDatabaseFileLocation('/new/location.mmdb');
		$this->assertSame('/new/location.mmdb', $service->getDatabaseFileLocation());
	}

	public function testDatabaseDateOfExistingFile() {
		$file = $this->createTempFile('x');
		touch($file, 1700000000);
		$service = $this->createServiceWithLocation($file);
		$this->assertSame(date('Y-m-d', filemtime($file)), $service->getDatabaseDate());
		$this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}$/', $service->getDatabaseDate());
	}

	public function testDatabaseDateOfRealDatabase() {
		$this->assertSame(date('Y-m-d', filemtime('/var/lib/GeoIP/GeoLite2-Country.mmdb')),
				$this->geo_ip_lookup->getDatabaseDate());
	}

	public function testDatabaseDateOfNonexistentFile() {
		$service = $this->createServiceWithLocation($this->nonexistentFile());
		$this->assertSame('Date of the database cannot be determined!', $service->getDatabaseDate());
	}

	public function testNonexistentDatabaseFileIsUnavailable() {
		$file = $this->nonexistentFile();
		$logger = $this->createMock('Psr\Log\LoggerInterface');
		$logger->expects($this->once())->method('error')->with(
				$this->stringContains('Database File Not Found Exception: No file at ' . $file),
				['app' => 'geoblocker']);
		$service = $this->createServiceWithLocation($file, null, $logger);
		$this->assertSame('UNAVAILABLE', $service->getCountryCodeFromIP('8.8.8.8'));
	}

	public function testNonexistentDatabaseFileStatusAndStatusString() {
		$service = $this->createServiceWithLocation($this->nonexistentFile());
		$this->assertFalse($service->getStatus());
		$this->assertSame(
				'"MaxMind GeoLite2": ERROR: Database is not valid, does not have the correct access rights or is not placed at %s.',
				$service->getStatusString());
	}

	public function testInvalidDatabaseFileIsUnavailable() {
		$file = $this->createTempFile(str_repeat('this is not a maxmind database ', 50));
		$logger = $this->createMock('Psr\Log\LoggerInterface');
		$logger->expects($this->once())->method('error')->with(
				$this->stringStartsWith('Geoblocker: MaxMindGeoLite2: Invalid Database Exception'),
				['app' => 'geoblocker']);
		$service = $this->createServiceWithLocation($file, null, $logger);
		$this->assertSame('UNAVAILABLE', $service->getCountryCodeFromIP('8.8.8.8'));
	}

	public function testInvalidDatabaseFileStatusString() {
		$file = $this->createTempFile(str_repeat('this is not a maxmind database ', 50));
		$service = $this->createServiceWithLocation($file);
		$this->assertFalse($service->getStatus());
		$this->assertStringStartsWith(
				'"MaxMind GeoLite2": ERROR: Database is not valid, does not have the correct access rights or is not placed at',
				$service->getStatusString());
	}

	public static function invalidIpProvider(): array {
		return [
			['abc'],
			['291.133.564.12'],
			['aöerb03s'],
			['2a023:2e0:3fe:1001:302::'],
		];
	}

	#[DataProvider('invalidIpProvider')]
	public function testInvalidIpArgumentIsUnavailable(string $ip_address) {
		$logger = $this->createMock('Psr\Log\LoggerInterface');
		$logger->expects($this->once())->method('error')->with(
				$this->stringStartsWith('Geoblocker: MaxMindGeoLite2: Invalid Argument Exception'),
				['app' => 'geoblocker']);
		$service = $this->createServiceWithLocation('/var/lib/GeoIP/GeoLite2-Country.mmdb', null, $logger);
		$this->assertSame('UNAVAILABLE', $service->getCountryCodeFromIP($ip_address));
	}

	public function testIsValidStatusOk() {
		$this->assertTrue($this->geo_ip_lookup->getStatus());
	}

	public function testIsValidStatusStringOk() {
		$result = '"MaxMind GeoLite2": OK.';
		$this->assertEquals($result, $this->geo_ip_lookup->getStatusString());
	}

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

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
