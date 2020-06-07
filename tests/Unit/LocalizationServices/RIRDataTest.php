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

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}
}

?>