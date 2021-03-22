<?php

declare(strict_types = 1)
	;

namespace OCA\Geoblocker\Tests\UnitMissingServiceTests;

use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;
use OCA\GeoBlocker\Tests\UnitMissingServiceTests\MaxMindGeoLite2TestBase;

class MaxMindGeoLite2MissingTest extends MaxMindGeoLite2TestBase {
	public function testIsInvalidStatusOkWhenAllFilesMissing() {
		$this->assertTrue(file_exists($this->phar_file_1));
		$this->assertFalse(file_exists($this->phar_file_2));

		rename($this->phar_file_1, $this->phar_file_1 . 'bak');

		$this->assertFalse(file_exists($this->phar_file_1));
		$this->assertFalse(file_exists($this->phar_file_2));

		try {
			$this->geo_ip_lookup = new MaxMindGeoLite2($this->config, $this->l, $this->logger);
			$this->assertFalse($this->geo_ip_lookup->getStatus());
		} catch (Exception $e) {
			$this->assertFalse(true);
			throw $e;
		} finally {
			rename($this->phar_file_1 . 'bak', $this->phar_file_1);
		}

		$this->assertTrue(file_exists($this->phar_file_1));
		$this->assertFalse(file_exists($this->phar_file_2));
	}
}
