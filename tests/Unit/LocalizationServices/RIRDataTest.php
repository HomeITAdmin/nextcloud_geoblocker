<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\LocalizationService;

use OCA\GeoBlocker\LocalizationServices\RIRData;
use PHPUnit\Framework\TestCase;

class RIRDataTest extends TestCase {
	protected $config;
	protected $db;
	protected $l;
	private $rir_data;

	public function setUp(): void {
		parent::setUp();
		$tmp_config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
		$this->db = $this->getMockBuilder('OCP\IDbConnection')->getMock();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->l->method('t')->will(
				$this->returnCallback([$this,'callbackLTJustRouteThrough']));
		$this->rir_data = new RIRData($this->db, $this->config, $this->l);
	}

	public function testDummy() {
		$this->assertTrue(true);
		$this->markTestIncomplete('This test has not been implemented yet.');
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}
