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
		parent::setUp ();
		$this->config = $this->getMockBuilder ( 'OCP\IConfig' )->getMock ();
		$this->geo_config = new GeoBlockerConfig ( $this->config );
	}
	public function testIsGetLogWithIpAddressFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithIpAddress' ), $this->equalTo ( '0' ) )->will ( 
				$this->returnValue ( '0' ) );
		$this->assertFalse ( $this->geo_config->getLogWithIpAddress () );
	}
	public function testIsGetLogWithIpAddressTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithIpAddress' ), $this->equalTo ( '0' ) )->will ( 
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
				$this->equalTo ( 'logWithCountryCode' ), $this->equalTo ( '0' ) )->will ( 
				$this->returnValue ( '0' ) );
		$this->assertFalse ( $this->geo_config->getLogWithCountryCode () );
	}
	public function testIsGetLogWithCountryCodeTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithCountryCode' ), $this->equalTo ( '0' ) )->will ( 
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
				$this->returnValue ( '0' ), $this->equalTo ( '0' ) );
		$this->assertFalse ( $this->geo_config->getLogWithUserName () );
	}
	public function testIsGetLogWithUserNameTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'logWithUserName' ), $this->equalTo ( '0' ) )->will ( 
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
	public function testIsGetUseWhiteListingFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenWhiteBlackList' ),
				$this->equalTo ( '0' ) )->will ( $this->returnValue ( '0' ) );
		$this->assertFalse ( $this->geo_config->getUseWhiteListing () );
	}
	public function testIsGetUseWhiteListingTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenWhiteBlackList' ),
				$this->equalTo ( '0' ) )->will ( $this->returnValue ( '1' ) );
		$this->assertTrue ( $this->geo_config->getUseWhiteListing () );
	}
	public function testIsSetUseWhiteListingFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenWhiteBlackList' ),
				$this->equalTo ( '0' ) );
		$this->geo_config->setUseWhiteListing ( FALSE );
	}
	public function testIsSetUseWhiteListingTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenWhiteBlackList' ),
				$this->equalTo ( '1' ) );
		$this->geo_config->setUseWhiteListing ( TRUE );
	}
	public function testIsGetChoosenCountriesByStringValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenCountries' ), $this->equalTo ( '' ) )->will ( 
				$this->returnValue ( $return_string ) );
		$this->assertEquals ( $return_string,
				$this->geo_config->getChoosenCountriesByString () );
	}
	public function testIsCountryCodeInListOfChoosenCountriesFalseValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenCountries' ), $this->equalTo ( '' ) )->will ( 
				$this->returnValue ( $return_string ) );
		$this->assertFalse ( 
				$this->geo_config->isCountryCodeInListOfChoosenCountries ( 'AQ' ) );
	}
	public function testIsCountryCodeInListOfChoosenCountriesFalseEmptyCountryListValid() {
		$return_string = '';
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenCountries' ), $this->equalTo ( '' ) )->will ( 
				$this->returnValue ( $return_string ) );
		$this->assertFalse ( 
				$this->geo_config->isCountryCodeInListOfChoosenCountries ( 'AQ' ) );
	}
	public function testIsCountryCodeInListOfChoosenCountriesTrueValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'choosenCountries' ), $this->equalTo ( '' ) )->will ( 
				$this->returnValue ( $return_string ) );
		$this->assertTrue ( 
				$this->geo_config->isCountryCodeInListOfChoosenCountries ( 'AG' ) );
	}
	public function testIsGetDoFakeAddressFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'doFakeAddress' ), $this->equalTo ( '0' ) )->will ( 
				$this->returnValue ( '0' ) );
		$this->assertFalse ( $this->geo_config->getDoFakeAddress () );
	}
	public function testIsGetDoFakeAddressTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'doFakeAddress' ), $this->equalTo ( '0' ) )->will ( 
				$this->returnValue ( '1' ) );
		$this->assertTrue ( $this->geo_config->getDoFakeAddress () );
	}
	public function testIsSetDoFakeAddressFalseValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'doFakeAddress' ), $this->equalTo ( '0' ) );
		$this->geo_config->setDoFakeAddress ( FALSE );
	}
	public function testIsSetDoFakeAddressTrueValid() {
		$this->config->expects ( $this->once () )->method ( 'setAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'doFakeAddress' ), $this->equalTo ( '1' ) );
		$this->geo_config->setDoFakeAddress ( TRUE );
	}
	public function testIsGetFakeAddressValidAddressValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with ( 
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'fakeAddress' ), $this->equalTo ( '127.0.0.1' ) )->will ( 
				$this->returnValue ( '24.165.23.67' ) );
		$this->assertEquals ( '24.165.23.67',
				$this->geo_config->getFakeAddress () );
	}
	public function testIsGetFakeAddressInvalidAddressValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with (
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'fakeAddress' ), $this->equalTo ( '127.0.0.1' ) )->will (
						$this->returnValue ( '24.165.23.67.234' ) );
				$this->assertEquals ( '127.0.0.1',
						$this->geo_config->getFakeAddress () );
	}
	public function testIsGetFakeAddressEmptyAddressValid() {
		$this->config->expects ( $this->once () )->method ( 'getAppValue' )->with (
				$this->equalTo ( 'geoblocker' ),
				$this->equalTo ( 'fakeAddress' ), $this->equalTo ( '127.0.0.1' ) )->will (
						$this->returnValue ( '' ) );
				$this->assertEquals ( '127.0.0.1',
						$this->geo_config->getFakeAddress () );
	}
}
