<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\UnitMissingServiceTests;

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
		$this->l = $this->createStub('OCP\IL10N');
		$this->logger = $this->createStub('Psr\Log\LoggerInterface');
		$this->l->method('t')->willReturnCallback(
				[$this,'callbackLTJustRouteThrough']);
		$this->config = $this->createStub(
				'OCA\GeoBlocker\Config\GeoBlockerConfig');
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
