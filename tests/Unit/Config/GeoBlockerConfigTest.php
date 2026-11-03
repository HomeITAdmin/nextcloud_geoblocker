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
				$this->equalTo('0'))->willReturn('0');
		$this->assertFalse($this->geo_config->getLogWithIpAddress());
	}

	public function testIsGetLogWithIpAddressTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithIpAddress'),
				$this->equalTo('0'))->willReturn('1');
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
				$this->equalTo('logWithCountryCode'), $this->equalTo('0'))->willReturn(
				'0');
		$this->assertFalse($this->geo_config->getLogWithCountryCode());
	}

	public function testIsGetLogWithCountryCodeTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('logWithCountryCode'), $this->equalTo('0'))->willReturn(
				'1');
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
				$this->equalTo('geoblocker'), $this->equalTo('logWithUserName'), $this->equalTo('0'))->willReturn(
				'0');
		$this->assertFalse($this->geo_config->getLogWithUserName());
	}

	public function testIsGetLogWithUserNameTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('logWithUserName'),
				$this->equalTo('0'))->willReturn('1');
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
				$this->equalTo('choosenWhiteBlackList'), $this->equalTo('0'))->willReturn(
				'0');
		$this->assertFalse($this->geo_config->getUseWhiteListing());
	}

	public function testIsGetUseWhiteListingTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('choosenWhiteBlackList'), $this->equalTo('0'))->willReturn(
				'1');
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
				$this->equalTo(''))->willReturn($return_string);
		$this->assertEquals($return_string,
				$this->geo_config->getChoosenCountriesByString());
	}

	public function testIsCountryCodeInListOfChoosenCountriesFalseValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo(''))->willReturn($return_string);
		$this->assertFalse(
				$this->geo_config->isCountryCodeInListOfChoosenCountries('AQ'));
	}

	public function testIsCountryCodeInListOfChoosenCountriesFalseEmptyCountryListValid() {
		$return_string = '';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo(''))->willReturn($return_string);
		$this->assertFalse(
				$this->geo_config->isCountryCodeInListOfChoosenCountries('AQ'));
	}

	public function testIsCountryCodeInListOfChoosenCountriesTrueValid() {
		$return_string = 'AE, AF, AG, AI, AL,';
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo(''))->willReturn($return_string);
		$this->assertTrue(
				$this->geo_config->isCountryCodeInListOfChoosenCountries('AG'));
	}

	public function testIsGetDoFakeAddressFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('doFakeAddress'),
				$this->equalTo('0'))->willReturn('0');
		$this->assertFalse($this->geo_config->getDoFakeAddress());
	}

	public function testIsGetDoFakeAddressTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('doFakeAddress'),
				$this->equalTo('0'))->willReturn('1');
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
				$this->equalTo('127.0.0.1'))->willReturn(
				'24.165.23.67');
		$this->assertEquals('24.165.23.67', $this->geo_config->getFakeAddress());
	}

	public function testIsGetFakeAddressInvalidAddressValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddress'),
				$this->equalTo('127.0.0.1'))->willReturn(
				'24.165.23.67.234');
		$this->assertEquals('127.0.0.1', $this->geo_config->getFakeAddress());
	}

	public function testIsGetFakeAddressEmptyAddressValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddress'),
				$this->equalTo('127.0.0.1'))->willReturn('');
		$this->assertEquals('127.0.0.1', $this->geo_config->getFakeAddress());
	}

	public function testIsGetChosenServiceValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('chosenService'),
				$this->equalTo('3'))->willReturn('1');
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
				$this->equalTo($test_default))->willReturn($test_return);
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

	public function testIsGetDelayIpAddressFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('delayIpAddress'),
				$this->equalTo('0'))->willReturn('0');
		$this->assertFalse($this->geo_config->getDelayIpAddress());
	}

	public function testIsGetDelayIpAddressTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('delayIpAddress'),
				$this->equalTo('0'))->willReturn('1');
		$this->assertTrue($this->geo_config->getDelayIpAddress());
	}

	public function testIsSetDelayIpAddressFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('delayIpAddress'),
				$this->equalTo('0'));
		$this->geo_config->setDelayIpAddress(false);
	}

	public function testIsSetDelayIpAddressTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('delayIpAddress'),
				$this->equalTo('1'));
		$this->geo_config->setDelayIpAddress(true);
	}

	public function testIsGetBlockIpAddressFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('blockIpAddress'),
				$this->equalTo('0'))->willReturn('0');
		$this->assertFalse($this->geo_config->getBlockIpAddress());
	}

	public function testIsGetBlockIpAddressTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('blockIpAddress'),
				$this->equalTo('0'))->willReturn('1');
		$this->assertTrue($this->geo_config->getBlockIpAddress());
	}

	public function testIsSetBlockIpAddressFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('blockIpAddress'),
				$this->equalTo('0'));
		$this->geo_config->setBlockIpAddress(false);
	}

	public function testIsSetBlockIpAddressTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('blockIpAddress'),
				$this->equalTo('1'));
		$this->geo_config->setBlockIpAddress(true);
	}

	public function testIsGetBlockIpAddressBeforeFalseValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('blockIpAddressBefore'), $this->equalTo('0'))->willReturn('0');
		$this->assertFalse($this->geo_config->getBlockIpAddressBefore());
	}

	public function testIsGetBlockIpAddressBeforeTrueValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('blockIpAddressBefore'), $this->equalTo('0'))->willReturn('1');
		$this->assertTrue($this->geo_config->getBlockIpAddressBefore());
	}

	public function testIsSetBlockIpAddressBeforeFalseValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('blockIpAddressBefore'), $this->equalTo('0'));
		$this->geo_config->setBlockIpAddressBefore(false);
	}

	public function testIsSetBlockIpAddressBeforeTrueValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('blockIpAddressBefore'), $this->equalTo('1'));
		$this->geo_config->setBlockIpAddressBefore(true);
	}

	public function testIsSetChoosenCountriesByStringValid() {
		$countries = 'AE, AF, AG,';
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('choosenCountries'),
				$this->equalTo($countries));
		$this->geo_config->setChoosenCountriesByString($countries);
	}

	public function testIsGetFakeAddressUserValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddressUser'),
				$this->equalTo(''))->willReturn('admin');
		$this->assertEquals('admin', $this->geo_config->getFakeAddressUser());
	}

	public function testIsGetFakeAddressUserEmptyValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddressUser'),
				$this->equalTo(''))->willReturn('');
		$this->assertEquals('', $this->geo_config->getFakeAddressUser());
	}

	public function testIsSetFakeAddressUserValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'), $this->equalTo('fakeAddressUser'),
				$this->equalTo('admin'));
		$this->geo_config->setFakeAddressUser('admin');
	}

	public function testIsGetDatabaseFileLocationValid() {
		$this->config->expects($this->once())->method('getAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('MaxMindGeoLite2_DatabaseFileLocation'),
				$this->equalTo(''))->willReturn('/tmp/GeoLite2.mmdb');
		$this->assertEquals('/tmp/GeoLite2.mmdb',
				$this->geo_config->getDatabaseFileLocation('MaxMindGeoLite2'));
	}

	public function testIsSetDatabaseFileLocationValid() {
		$this->config->expects($this->once())->method('setAppValue')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('MaxMindGeoLite2_DatabaseFileLocation'),
				$this->equalTo('/tmp/GeoLite2.mmdb'));
		$this->geo_config->setDatabaseFileLocation('/tmp/GeoLite2.mmdb',
				'MaxMindGeoLite2');
	}
}
