<?php
declare(strict_types = 1)
	;

namespace OCA\Geoblocker\Tests\Unit\GeoBlocker;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Config\GeoBlockerConfig;

class GeoBlockerConfigTest extends TestCase {
	private $config;
	private $geo_config;
	public function setUp(): void {
		$this->config = $this->getMockBuilder ( 'OCP\IConfig' )->getMock ();
		$this->geo_config = new GeoBlockerConfig ( $this->config );
	}
	public function testIsGetLogWithIpAddressFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithIpAddress' ) )->will ( 
				$this->returnValue ( '0' ) );
		$this->assertFalse ( $this->geo_config->getLogWithIpAddress () );
	}
	public function testIsGetLogWithIpAddressTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithIpAddress' ) )->will ( 
				$this->returnValue ( '1' ) );
		$this->assertTrue ( $this->geo_config->getLogWithIpAddress () );
	}
	public function testIsSetLogWithIpAddressFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithIpAddress' ), $this->equalTo ( '0' ) );
		$this->geo_config->setLogWithIpAddress ( FALSE );
	}
	public function testIsSetLogWithIpAddressTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithIpAddress' ), $this->equalTo ( '1' ) );
		$this->geo_config->setLogWithIpAddress ( TRUE );
	}
	public function testIsGetLogWithCountryCodeFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithCountryCode' ) )->will ( 
				$this->returnValue ( '0' ) );
		$this->assertFalse ( $this->geo_config->getLogWithCountryCode () );
	}
	public function testIsGetLogWithCountryCodeTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithCountryCode' ) )->will ( 
				$this->returnValue ( '1' ) );
		$this->assertTrue ( $this->geo_config->getLogWithCountryCode () );
	}
	public function testIsSetLogWithCountryCodeFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithCountryCode' ), $this->equalTo ( '0' ) );
		$this->geo_config->setLogWithCountryCode ( FALSE );
	}
	public function testIsSetLogWithCountryCodeTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithCountryCode' ), $this->equalTo ( '1' ) );
		$this->geo_config->setLogWithCountryCode ( TRUE );
	}
	public function testIsGetLogWithUserNameFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithUserName' ) )->will ( 
				$this->returnValue ( '0' ) );
		$this->assertFalse ( $this->geo_config->getLogWithUserName () );
	}
	public function testIsGetLogWithUserNameTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithUserName' ) )->will ( 
				$this->returnValue ( '1' ) );
		$this->assertTrue ( $this->geo_config->getLogWithUserName () );
	}
	public function testIsSetLogWithUserNameFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithUserName' ), $this->equalTo ( '0' ) );
		$this->geo_config->setLogWithUserName ( FALSE );
	}
	public function testIsSetLogWithUserNameTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithUserName' ), $this->equalTo ( '1' ) );
		$this->geo_config->setLogWithUserName ( TRUE );
	}
	
	//TODOs: Follow ip Unit Tests for that class.
}
