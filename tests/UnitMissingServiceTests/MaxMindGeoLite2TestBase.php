<?php

declare(strict_types = 1)
	;

namespace OCA\Geoblocker\Tests\UnitMissingServiceTests;

use PHPUnit\Framework\TestCase;

abstract class MaxMindGeoLite2TestBase extends TestCase {
	protected $l;
	protected $logger;
	protected $config;
	protected $geo_ip_lookup;
	protected $phar_file_1 = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
				'..' . DIRECTORY_SEPARATOR . '3rdparty' . DIRECTORY_SEPARATOR .
				'maxmind_geolite2' . DIRECTORY_SEPARATOR  . 'geoip2.phar';
	protected $phar_file_2 = '/var/lib/GeoIP/geoip2.phar';

	public function setUp(): void {
		parent::setUp();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->logger = $this->getMockBuilder('Psr\Log\LoggerInterface')->getMock();
		$this->l->method('t')->will(
				$this->returnCallback([$this,'callbackLTJustRouteThrough']));
		$tmp_config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
