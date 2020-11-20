<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\LocalizationService;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\LocalizationServices\Dummy;

class DummyTest extends TestCase {
	protected $l;
	protected $dummy;

	public function setUp(): void {
		parent::setUp();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->l->method('t')->will(
				$this->returnCallback(
						[$this,'callbackLTJustRouteThrough']));
		$this->dummy = new Dummy($this->l);
	}

	public function testIsStatusOk() {
		$this->assertTrue($this->dummy->getStatus());
	}

	public function testIsStatusStringOk() {
		$this->assertStringStartsWith('"Dummy": OK. This service always returns', $this->dummy->getStatusString());
	}

	/**
	 *
	 * @dataProvider ipProvider
	 */
	public function testIsCountryCodeOk(string $ip_address) {
		$this->assertEquals('AA', $this->dummy->getCountryCodeFromIP($ip_address));
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}

	public function ipProvider(): array {
		return [ ['2a02:2e0:3fe:1001:302::'],
			['24.165.23.67'],
			['asdfes'],
			['2342552'],
			['24.165.523.67'],];
	}
}
