<?php

declare(strict_types = 1)
	;

namespace OCA\Geoblocker\Tests\UnitMissingServiceTests;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;

class MaxMindGeoLite2MissingTest extends TestCase {
	protected $l;
	protected $config;
	private $geo_ip_lookup;

	public function setUp(): void {
		parent::setUp();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->l->method('t')->will(
				$this->returnCallback([$this,'callbackLTJustRouteThrough']));
		$tmp_config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
	}

	public function testIsInvalidStatusOk() {
		$phar_file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
				'..' . DIRECTORY_SEPARATOR . '3rdparty' . DIRECTORY_SEPARATOR .
				'maxmind_geolite2' . DIRECTORY_SEPARATOR . '' . 'geoip2.phar';
		$this->assertTrue(file_exists($phar_file));
		rename($phar_file, $phar_file . 'bak');
		try {
			$this->geo_ip_lookup = new MaxMindGeoLite2($this->config, $this->l);
			$this->assertFalse($this->geo_ip_lookup->getStatus());
		} finally {
			rename($phar_file . 'bak', $phar_file);
		}
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
