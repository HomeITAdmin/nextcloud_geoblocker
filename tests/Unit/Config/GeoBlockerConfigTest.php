<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Config;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Config\GeoBlockerConfig;

class GeoBlockerConfigTest extends TestCase {
	private $config;
	private $geo_config;

	public function setUp(): void {
		parent::setUp();
		$this->config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->geo_config = new GeoBlockerConfig($this->config);
	}

	public function testIsGetLogWithIpAddressFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithIpAddress'),
				$this->equalTo('0'))->will($this->returnValue('0'));
		$this->assertFalse($this->geo_config->getLogWithIpAddress());
	}

	public function testIsGetLogWithIpAddressTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithIpAddress'),
				$this->equalTo('0'))->will($this->returnValue('1'));
		$this->assertTrue($this->geo_config->getLogWithIpAddress());
	}

	public function testIsSetLogWithIpAddressFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithIpAddress'),
				$this->equalTo('0'));
		$this->geo_config->setLogWithIpAddress(false);
	}

	public function testIsSetLogWithIpAddressTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithIpAddress'),
				$this->equalTo('1'));
		$this->geo_config->setLogWithIpAddress(true);
	}

	public function testIsGetLogWithCountryCodeFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('logWithCountryCode'), $this->equalTo('0'))->will(
				$this->returnValue('0'));
		$this->assertFalse($this->geo_config->getLogWithCountryCode());
	}

	public function testIsGetLogWithCountryCodeTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('logWithCountryCode'), $this->equalTo('0'))->will(
				$this->returnValue('1'));
		$this->assertTrue($this->geo_config->getLogWithCountryCode());
	}

	public function testIsSetLogWithCountryCodeFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('logWithCountryCode'), $this->equalTo('0'));
		$this->geo_config->setLogWithCountryCode(false);
	}

	public function testIsSetLogWithCountryCodeTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('logWithCountryCode'), $this->equalTo('1'));
		$this->geo_config->setLogWithCountryCode(true);
	}

	public function testIsGetLogWithUserNameFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithUserName'))->will(
				$this->returnValue('0'), $this->equalTo('0'));
		$this->assertFalse($this->geo_config->getLogWithUserName());
	}

	public function testIsGetLogWithUserNameTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithUserName'),
				$this->equalTo('0'))->will($this->returnValue('1'));
		$this->assertTrue($this->geo_config->getLogWithUserName());
	}

	public function testIsSetLogWithUserNameFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithUserName'),
				$this->equalTo('0'));
		$this->geo_config->setLogWithUserName(false);
	}

	public function testIsSetLogWithUserNameTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithUserName'),
				$this->equalTo('1'));
		$this->geo_config->setLogWithUserName(true);
	}

	public function testIsGetUseWhiteListingFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('choosenWhiteBlackList'), $this->equalTo('0'))->will(
				$this->returnValue('0'));
		$this->assertFalse($this->geo_config->getUseWhiteListing());
	}

	public function testIsGetUseWhiteListingTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('choosenWhiteBlackList'), $this->equalTo('0'))->will(
				$this->returnValue('1'));
		$this->assertTrue($this->geo_config->getUseWhiteListing());
	}

	public function testIsSetUseWhiteListingFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('choosenWhiteBlackList'), $this->equalTo('0'));
		$this->geo_config->setUseWhiteListing(false);
	}

	public function testIsSetUseWhiteListingTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('choosenWhiteBlackList'), $this->equalTo('1'));
		$this->geo_config->setUseWhiteListing(true);
	}

	public function testIsGetChoosenCountriesByStringValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo(''))->will($this->returnValue($return_string));
		$this->assertEquals($return_string,
				$this->geo_config->getChoosenCountriesByString());
	}

	public function testIsCountryCodeInListOfChoosenCountriesFalseValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo(''))->will($this->returnValue($return_string));
		$this->assertFalse(
				$this->geo_config->isCountryCodeInListOfChoosenCountries('AQ'));
	}

	public function testIsCountryCodeInListOfChoosenCountriesFalseEmptyCountryListValid() {
		$return_string = '';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo(''))->will($this->returnValue($return_string));
		$this->assertFalse(
				$this->geo_config->isCountryCodeInListOfChoosenCountries('AQ'));
	}

	public function testIsCountryCodeInListOfChoosenCountriesTrueValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo(''))->will($this->returnValue($return_string));
		$this->assertTrue(
				$this->geo_config->isCountryCodeInListOfChoosenCountries('AG'));
	}

	public function testIsGetDoFakeAddressFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('doFakeAddress'),
				$this->equalTo('0'))->will($this->returnValue('0'));
		$this->assertFalse($this->geo_config->getDoFakeAddress());
	}

	public function testIsGetDoFakeAddressTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('doFakeAddress'),
				$this->equalTo('0'))->will($this->returnValue('1'));
		$this->assertTrue($this->geo_config->getDoFakeAddress());
	}

	public function testIsSetDoFakeAddressFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('doFakeAddress'),
				$this->equalTo('0'));
		$this->geo_config->setDoFakeAddress(false);
	}

	public function testIsSetDoFakeAddressTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('doFakeAddress'),
				$this->equalTo('1'));
		$this->geo_config->setDoFakeAddress(true);
	}

	public function testIsGetFakeAddressValidAddressValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddress'),
				$this->equalTo('127.0.0.1'))->will(
				$this->returnValue('24.165.23.67'));
		$this->assertEquals('24.165.23.67', $this->geo_config->getFakeAddress());
	}

	public function testIsGetFakeAddressInvalidAddressValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddress'),
				$this->equalTo('127.0.0.1'))->will(
				$this->returnValue('24.165.23.67.234'));
		$this->assertEquals('127.0.0.1', $this->geo_config->getFakeAddress());
	}

	public function testIsGetFakeAddressEmptyAddressValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddress'),
				$this->equalTo('127.0.0.1'))->will($this->returnValue(''));
		$this->assertEquals('127.0.0.1', $this->geo_config->getFakeAddress());
	}

	public function testIsGetChosenServiceValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('chosenService'),
				$this->equalTo('3'))->will($this->returnValue('1'));
		$this->assertEquals('1', $this->geo_config->getChosenService());
	}

	public function testIsSetChosenServiceValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('chosenService'),
				$this->equalTo('1'));
		$this->geo_config->setChosenService('1');
	}

	public function testIsGetServiceSpecificConfigValueValid() {
		$test_name = 'test_value';
		$test_default = '00';
		$test_return = '11';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo($test_name),
				$this->equalTo($test_default))->will(
				$this->returnValue($test_return));
		$this->assertEquals($test_return,
				$this->geo_config->getServiceSpecificConfigValue($test_name,
						$test_default));
	}

	public function testIsSetServiceSpecificConfigValueValid() {
		$test_name = 'test_value';
		$test_return = '11';
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo($test_name),
				$this->equalTo($test_return));
		$this->geo_config->setServiceSpecificConfigValue($test_name,
				$test_return);
	}
}
