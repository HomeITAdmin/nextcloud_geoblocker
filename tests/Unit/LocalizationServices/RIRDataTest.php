<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\LocalizationService;

use Exception;
use OCA\GeoBlocker\Db\RIRServiceMapper;
use OCA\GeoBlocker\LocalizationServices\LocationServiceUpdateStatus;
use OCA\GeoBlocker\LocalizationServices\RIRData;
use OCA\GeoBlocker\LocalizationServices\RIRStatus;
use OCA\GeoBlocker\Db\RIRServiceDBEntity;
use PHPUnit\Framework\TestCase;

class RIRDataTest extends TestCase {
	protected $rir_data_checks;
	protected $config;
	protected $rir_service_mapper;
	protected $l;
	private $rir_data;
	private $error_message_not_enough_entries = 'No entries in the database. Please run update.';
	private $rir_data_test_file = __DIR__ . DIRECTORY_SEPARATOR .
			'test-rir-data.txt';

	public function setUp(): void {
		parent::setUp();
		$this->rir_data_checks = $this->getMockBuilder(
				'OCA\GeoBlocker\LocalizationServices\RIRDataChecks')->getMock();
		$tmp_config = $this->getMockBuilder('OCP\IConfig')->getMock();
		$this->config = $this->getMockBuilder(
				'OCA\GeoBlocker\Config\GeoBlockerConfig')->setConstructorArgs(
				[$tmp_config])->getMock();
		$tmp_db = $this->getMockBuilder('OCP\IDbConnection')->getMock();
		$this->rir_service_mapper = $this->getMockBuilder(
				'OCA\GeoBlocker\Db\RIRServiceMapper')->setConstructorArgs(
				[$tmp_db])->getMock();
		$this->l = $this->getMockBuilder('OCP\IL10N')->getMock();
		$this->l->method('t')->will(
				$this->returnCallback([$this,'callbackLTJustRouteThrough']));
		$this->rir_data = new RIRData($this->rir_data_checks,
				$this->rir_service_mapper, $this->config, $this->l);
	}

	/**
	 *
	 * @dataProvider okRirStatusProvider
	 */
	public function testIsStatusTrueOk(int $rir_status) {
		$this->rir_data_checks->expects($this->Once())->method(
			'checkGMP')->willReturn(true);
		$this->config->expects($this->exactly(2))->method(
			'getServiceSpecificConfigValue')->withConsecutive([
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0')]
			,[$this->equalTo(RIRData::kDbVersionName), $this->equalTo('0')])->willReturnOnConsecutiveCalls(
			strval($rir_status), '0');
		$this->rir_service_mapper->expects($this->Once())->method(
			'getNumberOfEntries')->willReturn(100);
		$this->assertTrue($this->rir_data->getStatus());
	}

	/**
	 *
	 * @dataProvider nonOkRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsStatusFalseOkForNonOkRirStatus(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				true);
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status));
		$this->rir_service_mapper->expects($this->atMost(1))->method(
					'getNumberOfEntries')->willReturn(100);

		$this->assertFalse($this->rir_data->getStatus());
	}

	/**
	 *
	 * @dataProvider allRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsStatusFalseOkForCheckGmpNotOk(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				false);
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status));
		$this->rir_service_mapper->expects($this->atMost(1))->method(
					'getNumberOfEntries')->willReturn(100);

		$this->assertFalse($this->rir_data->getStatus());
	}

	/**
	 *
	 * @dataProvider allRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsStatusFalseOkForNoEntriesInDb(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				true);
		$this->rir_service_mapper->expects($this->atMost(1))->method(
				'getNumberOfEntries')->willReturn(0);

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '0']
		];
		
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		
		if ($rir_status == RIRStatus::kDbOk || $rir_status == RIRStatus::kDbUpdating) {
			$this->checkSetDBToErrorState($this->error_message_not_enough_entries);
		}

		$this->assertFalse($this->rir_data->getStatus());
	}

	/**
	 *
	 * @dataProvider okRirStatusProvider
	 */
	public function testIsValidStatusStringOk(int $rir_status) {
		$this->rir_data_checks->expects($this->once())->method('checkGMP')->willReturn(
				true);
		$this->config->expects($this->exactly(2))->method(
			'getServiceSpecificConfigValue')->withConsecutive([
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0')]
			,[$this->equalTo(RIRData::kDbVersionName), $this->equalTo('0')])->willReturnOnConsecutiveCalls(
			strval($rir_status), '0');
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(1000);

		$result = '"RIR Data": OK';
		$this->assertStringStartsWith($result, $this->rir_data->getStatusString());
	}

	/**
	 *
	 * @dataProvider nonOkRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsErrorStatusStringOkForNonOkRirStatus(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				true);
		$this->rir_service_mapper->expects($this->atMost(1))->method(
				'getNumberOfEntries')->willReturn(1000);
		$error_message = 'My last error message!';

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '0'],
			[RIRData::kErrorMessageName, '', $error_message]
		];

		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$result = '"RIR Data": ERROR';
		$this->assertStringStartsWith($result, $this->rir_data->getStatusString());
	}

	/**
	 *
	 * @dataProvider allRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsErrorStatusStringOkforCheckGmpNotOk(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				false);
		$this->rir_service_mapper->expects($this->atMost(1))->method(
				'getNumberOfEntries')->willReturn(1000);
		$error_message = 'My last error message!';

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '0'],
			[RIRData::kErrorMessageName, '', $error_message]
		];

		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$result = '"RIR Data": ERROR';
		$this->assertStringStartsWith($result, $this->rir_data->getStatusString());
	}

	/**
	 *
	 * @dataProvider allRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsInvalidStatusStringOkForNoEntriesInDb(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				true);
		$this->rir_service_mapper->expects($this->atMost(1))->method(
				'getNumberOfEntries')->willReturn(0);

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '0'],
			[RIRData::kErrorMessageName, '', $this->error_message_not_enough_entries]
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		if ($rir_status == RIRStatus::kDbOk || $rir_status == RIRStatus::kDbUpdating) {
			$this->checkSetDBToErrorState($this->error_message_not_enough_entries);
		}

		$result = '"RIR Data": ERROR';
		$this->assertStringStartsWith($result, $this->rir_data->getStatusString());
	}

	//TODO: IP Provider
	public function testIsCountryCodeFromValidIpOk() {
		$this->makeServiceValid();

		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'DE';
		$this->rir_service_mapper->expects($this->once())->method(
				'getCountryCodeFromIpv6')->with(
				RIRServiceMapper::ipv6String2Int64($ip_address))->willReturn(
				$country_code);
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));

		$country_code = 'US';
		$ip_address = '24.165.23.67';
		$this->rir_service_mapper->expects($this->once())->method(
				'getCountryCodeFromIpv4')->with(
				RIRServiceMapper::ipv4String2Int64($ip_address))->willReturn(
				$country_code);
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromInvalidIpOk() {
		$this->makeServiceValid();

		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv6');
		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv4');

		$country_code = 'INVALID_IP';
		$ip_address = 'asdfes';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
		$ip_address = '2342552';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
		$ip_address = '24.165.523.67';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
	}

	/**
	 *
	 * @dataProvider allRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsCountryCodeFromValidIpWithCheckGmpNotOkServiceOk(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				false);
		$this->rir_service_mapper->expects($this->atMost(1))->method(
			'getNumberOfEntries')->willReturn(120);
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '1']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv6');
		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv4');

		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'UNAVAILABLE';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
	}

	/**
	 *
	 * @dataProvider allRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsCountryCodeFromValidIpWithNoEntriesInDbServiceOk(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				true);
		$this->rir_service_mapper->expects($this->atMost(1))->method(
			'getNumberOfEntries')->willReturn(0);

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '1']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		
		
		if ($rir_status == RIRStatus::kDbOk || $rir_status == RIRStatus::kDbUpdating) {
			$this->checkSetDBToErrorState($this->error_message_not_enough_entries);
		}

		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv6');
		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv4');

		$ip_address = '24.165.23.67';
		$country_code = 'UNAVAILABLE';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
	}

	/**
	 *
	 * @dataProvider nonOkRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsCountryCodeFromValidIpWithNonOkStatus(int $rir_status) {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				true);
		$this->rir_service_mapper->expects($this->atMost(1))->method(
			'getNumberOfEntries')->willReturn(120);

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '1']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		
		
		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv6');
		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv4');

		$ip_address = '24.165.23.67';
		$country_code = 'UNAVAILABLE';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
	}

	/**
	 *
	 * @dataProvider okRirStatusProvider
	 */
	public function testIsGetDatabaseDateValidOk(int $rir_status) {
		$db_date = '2020-06-07';
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(1000);
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '1'],
			[RIRData::kDatabaseDateName, '', $db_date]
		];
		$this->config->expects($this->atLeast(2))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$this->assertEquals($db_date, $this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider okRirStatusProvider
	 */
	public function testIsGetDatabaseDateInvalidForNoSavedDateAndOKStatusOk(int $rir_status) {
		$this->rir_service_mapper->expects($this->never())->method(
				'getNumberOfEntries');
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '1'],
			[RIRData::kDatabaseDateName, '', '']
		];
		$this->config->expects($this->atLeast(2))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		
		$this->assertEquals('Date of the database cannot be determined!',
				$this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider nonOkRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsGetDatabaseDateInvalidForNoSavedDateAndNonOkStatusOk(int $rir_status) {
		$this->rir_service_mapper->expects($this->never())->method(
				'getNumberOfEntries');
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '1'],
			[RIRData::kDatabaseDateName, '', '']
		];
		$this->config->expects($this->atLeast(2))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$this->assertEquals('No database available!',
				$this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider nonOkRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsGetDatabaseDateInvalidForNonOKStatusOk(int $rir_status) {
		$db_date = '2020-06-07';
		$this->rir_service_mapper->expects($this->never())->method(
			'getNumberOfEntries');
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '0'],
			[RIRData::kDatabaseDateName, '', $db_date]
		];
		$this->config->expects($this->atLeast(2))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$this->assertEquals('No database available!',
				$this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider allRirStatusProvider
	 * @dataProvider invalidRirStatusProvider
	 */
	public function testIsGetDatabaseDateInvalidForNoEntryInDbOk(int $rir_status) {
		$db_date = '2020-06-07';
		$this->rir_service_mapper->expects($this->atMost(1))->method(
				'getNumberOfEntries')->willReturn(0);

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '0'],
			[RIRData::kDatabaseDateName, '', $db_date]
		];
		$this->config->expects($this->atLeast(2))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$this->assertEquals('No database available!',
				$this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider initializableRirStatusProvider
	 */
	public function testIsUpdateDatabaseSuccessForInitializableOk(int $rir_status_before,
			int $rir_status_inter) {
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status_before)],
			[RIRData::kDbVersionName, '0', '0']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(true);
		$this->config->expects($this->exactly(5))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')],
				[$this->equalTo(RIRData::kDatabaseDateName),
					$this->equalTo(date("Y-m-d"))],
				[$this->equalTo(RIRData::kDbVersionName),$this->equalTo('0')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbOk)]);

		$this->setupAndCheckDbEntriesCalled();

		$this->assertTrue($this->rir_data->updateDatabase());
	}

	/**
	 *
	 * @dataProvider updateableRirStatusProvider
	 */
	public function testIsUpdateDatabaseSuccessForUpdateableOk(int $rir_status_before,
			int $rir_status_inter) {
		$this->config->expects($this->exactly(4))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0')],
				[$this->equalTo(RIRData::kDbVersionName), $this->equalTo('0')],
				[$this->equalTo(RIRData::kDbVersionName), $this->equalTo('0')],
				[$this->equalTo(RIRData::kDbVersionName), $this->equalTo('0')])
				->willReturnOnConsecutiveCalls(strval($rir_status_before), '1', '1', '0');
		$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(true);
		$this->config->expects($this->exactly(4))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kDatabaseDateName),
					$this->equalTo(date("Y-m-d"))],
				[$this->equalTo(RIRData::kDbVersionName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbOk)]);

		$this->setupAndCheckDbEntriesCalled();

		$this->assertTrue($this->rir_data->updateDatabase());
	}

	/**
	 *
	 * @dataProvider nonUpdateableRirStatusProvider
	 */
	public function testIsUpdateDatabaseForNoUpdateStatesOk(
			int $rir_status_before) {
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status_before));
		$this->rir_service_mapper->expects($this->never())->method(
				'eraseAllDatabaseEntries');

		$this->setupAndCheckDbEntriesNotCalled($this->rir_data_test_file);

		$this->assertFalse($this->rir_data->updateDatabase());
	}

	/**
	 *
	 * @dataProvider initializableRirStatusProvider
	 */
	public function testIsUpdateDatabaseErrorDuringErasingForInitializableOk(int $rir_status_before,
			int $rir_status_inter) {
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status_before)],
			[RIRData::kDbVersionName, '0', '1']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(false);
		$this->config->expects($this->exactly(4))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo(
							'Problem during erasing the whole database occured.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);

		$this->setupAndCheckDbEntriesNotCalled($this->rir_data_test_file);

		$this->assertFalse($this->rir_data->updateDatabase());
	}

	/**
	 *
	 * @dataProvider updateableRirStatusProvider
	 */
	public function testIsUpdateDatabaseErrorDuringErasingForUpdateableOk(int $rir_status_before,
			int $rir_status_inter) {
		$this->config->expects($this->exactly(3))->method(
			'getServiceSpecificConfigValue')->withConsecutive(
			[$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0')],
			[$this->equalTo(RIRData::kDbVersionName), $this->equalTo('0')],
			[$this->equalTo(RIRData::kDbVersionName), $this->equalTo('0')])
			->willReturnOnConsecutiveCalls(strval($rir_status_before), '1', '1');
		$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(false);
		$this->config->expects($this->exactly(6))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kDatabaseDateName),
					$this->equalTo(date("Y-m-d"))],
				[$this->equalTo(RIRData::kDbVersionName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo(
							'Problem during erasing the whole database occured.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]
				);

		$this->setupAndCheckDbEntriesCalled();

		$this->assertFalse($this->rir_data->updateDatabase());
	}

	/**
	 *
	 * @dataProvider updateableRirStatusAndInvalidFilesProvider
	 */
	public function testIsUpdateDatabaseErrorRirFormatOk(int $rir_status_before,
			int $rir_status_inter, string $file) {
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status_before)],
			[RIRData::kDbVersionName, '0', '0']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		
		if ($rir_status_before == RIRStatus::kDbOk) {
			$this->rir_service_mapper->expects($this->never())->method(
				'eraseAllDatabaseEntries');
			$this->config->expects($this->exactly(4))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo('RIR seems to have changed the file format.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);
		} else {
			$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(true);
			$this->config->expects($this->exactly(5))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo('RIR seems to have changed the file format.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);
		}

		$this->setupAndCheckDbEntriesNotCalled($file);

		$this->assertFalse($this->rir_data->updateDatabase());
	}

	/**
	 *
	 * @dataProvider updateableRirStatusProvider
	 * @dataProvider initializableRirStatusProvider
	 */
	public function testIsUpdateDatabaseExceptionDuringFillingOk(int $rir_status_before,
			int $rir_status_inter) {
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status_before)],
			[RIRData::kDbVersionName, '0', '1']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		
		if ($rir_status_before == RIRStatus::kDbOk) {
			$this->rir_service_mapper->expects($this->never())->method(
				'eraseAllDatabaseEntries');
			$this->config->expects($this->exactly(4))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo('Exception caught during Update.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);
		} else {
			$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(true);
			$this->config->expects($this->exactly(5))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo('Exception caught during Update.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);
		}

		$this->rir_data->setDataSource(
				['afrinic' => $this->rir_data_test_file]);

		$db_entry = new RIRServiceDBEntity();
		$db_entry->setBeginIpRange(
				RIRServiceMapper::ipv4String2Int64('41.75.48.0'));
		$db_entry->setCountryCode('GH');
		$db_entry->setLengthIpRange('4096');
		$db_entry->setIsIpV6(false);
		$db_entry->setVersion(0);

		$this->rir_service_mapper->expects($this->once())->method('insert')->with(
				$db_entry)->willReturnCallback(
				[$this,'callbackRirServiceMapperInsertException']);

		$this->assertFalse($this->rir_data->updateDatabase());
	}

	/**
	 *
	 * @dataProvider updateableRirStatusProvider
	 * @dataProvider initializableRirStatusProvider
	 */
	public function testIsUpdateDatabaseErrorInvalidFileHandleOk(int $rir_status_before,
			int $rir_status_inter) {
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status_before)],
			[RIRData::kDbVersionName, '0', '1']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
		
		if ($rir_status_before == RIRStatus::kDbOk) {
			$this->rir_service_mapper->expects($this->never())->method(
				'eraseAllDatabaseEntries');
			$this->config->expects($this->exactly(4))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo(
							'Invalid file handle. Probably the internet connection got lost during the update.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);
		} else {
			$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(true);
			$this->config->expects($this->exactly(5))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo(
							'Invalid file handle. Probably the internet connection got lost during the update.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);
		}

		$this->setupAndCheckDbEntriesNotCalled(
				__DIR__ . DIRECTORY_SEPARATOR . 'file-does-not-exist.txt');

		$this->assertFalse($this->rir_data->updateDatabase());
	}

	public function testIsResetDatabaseSuccessOk() {
		$this->config->expects($this->never())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'));
		$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(true);
		$this->config->expects($this->exactly(2))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbNotInitialized)]);

		$this->assertTrue($this->rir_data->resetDatabase());
	}

	public function testIsResetDatabaseFailureOk() {
		$this->config->expects($this->never())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'));
		$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(false);
		$this->config->expects($this->exactly(3))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),
					$this->equalTo(
							'Problem during erasing the whole database occured.')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')]);

		$this->assertFalse($this->rir_data->resetDatabase());
	}

	/**
	 *
	 * @dataProvider databaseUpdatingStatusProvider
	 */
	public function testIsGetDatabaseUpdateStatusUpdatingOk(int $rir_status) {
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status));

		$this->assertEquals(LocationServiceUpdateStatus::kUpdating,
				$this->rir_data->getDatabaseUpdateStatus());
	}

	/**
	 *
	 * @dataProvider databaseNotUpdatingStatusProvider
	 */
	public function testIsGetDatabaseUpdateStatusUpdateNotPossibleOk(
			int $rir_status) {
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status));

		$this->rir_data_checks->expects($this->once())->method('checkAll')->willReturn(
				false);

		$this->assertEquals(LocationServiceUpdateStatus::kUpdateNotPossible,
				$this->rir_data->getDatabaseUpdateStatus());
	}

	/**
	 *
	 * @dataProvider databaseNotUpdatingStatusProvider
	 */
	public function testIsGetDatabaseUpdateStatusUpdatePossibleOk(
			int $rir_status) {
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status));

		$this->rir_data_checks->expects($this->once())->method('checkAll')->willReturn(
				true);

		$this->assertEquals(LocationServiceUpdateStatus::kUpdatePossible,
				$this->rir_data->getDatabaseUpdateStatus());
	}

	/**
	 *
	 * @dataProvider databaseUpdatingStatusProvider
	 */
	public function testIsGetDatabaseUpdateStatusStringUpdatingOk(
			int $rir_status) {
		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval($rir_status)],
			[RIRData::kDbVersionName, '0', '1']
		];
		$this->config->expects($this->atLeast(1))->method(
			'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));

		$number_of_entries = 55;
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn($number_of_entries);

		$this->assertEquals(
				'Current number of entries: ' . strval($number_of_entries),
				$this->rir_data->getDatabaseUpdateStatusString());
	}

	/**
	 *
	 * @dataProvider databaseNotUpdatingStatusStingsProvider
	 */
	public function testIsGetDatabaseUpdateStatusStringUpdateNotPossibleOk(
			int $rir_status, bool $ret1, bool $ret2, bool $ret3, string $msg) {
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status));

		$this->rir_data_checks->expects($this->once())->method('checkAll')->willReturn(
				false);
		$this->rir_data_checks->expects($this->atMost(1))->method(
				'checkAllowURLFOpen')->willReturn($ret1);
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				$ret2);
		$this->rir_data_checks->expects($this->atMost(1))->method(
				'checkInternetConnection')->willReturn($ret3);

		$this->assertEquals($msg,
				$this->rir_data->getDatabaseUpdateStatusString());
	}

	/**
	 *
	 * @dataProvider databaseNotUpdatingStatusProvider
	 */
	public function testIsGetDatabaseUpdateStatusStringUpdatePossibleOk(
			int $rir_status) {
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status));

		$this->rir_data_checks->expects($this->once())->method('checkAll')->willReturn(
				true);

		$this->assertEquals('', $this->rir_data->getDatabaseUpdateStatusString());
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}

	public function allRirStatusProvider(): array {
		return ["kDbError" => [RIRStatus::kDbError],
			"kDbInitilazing" => [RIRStatus::kDbInitilazing],
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized],
			"kDbUpdating" => [RIRStatus::kDbUpdating],
			"kDbOk" => [RIRStatus::kDbOk]];
	}

	public function invalidRirStatusProvider(): array {
		return ["invalid" => [- 1]];
	}

	public function okRirStatusProvider(): array {
		return ["kDbOk" => [RIRStatus::kDbOk],
			"kDbUpdating" => [RIRStatus::kDbUpdating]];
	}

	public function nonOkRirStatusProvider(): array {
		return ["kDbError" => [RIRStatus::kDbError],
			"kDbInitilazing" => [RIRStatus::kDbInitilazing],
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized]];
	}

	public function initializableRirStatusProvider(): array {
		return [
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized,
				RIRStatus::kDbInitilazing],
			"kDbError" => [RIRStatus::kDbError,RIRStatus::kDbInitilazing]];
	}

	public function updateableRirStatusProvider(): array {
		return ["kDbOk" => [RIRStatus::kDbOk,RIRStatus::kDbUpdating]];
	}

	public function nonUpdateableRirStatusProvider(): array {
		return ["kDbInitilazing" => [RIRStatus::kDbInitilazing],
			"kDbUpdating" => [RIRStatus::kDbUpdating]];
	}

	public function updateableRirStatusAndInvalidFilesProvider(): array {
		$ret = [];

		$states = ["kDbOk" => [RIRStatus::kDbOk,RIRStatus::kDbUpdating],
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized,
				RIRStatus::kDbInitilazing],
			"kDbError" => [RIRStatus::kDbError,RIRStatus::kDbInitilazing]];
		$files = [
			"tooShort" => [
				__DIR__ . DIRECTORY_SEPARATOR . 'test-rir-data-invalid1.txt'],
			"invalidRIRName" => [
				__DIR__ . DIRECTORY_SEPARATOR . 'test-rir-data-invalid2.txt']];

		foreach ($states as $state_key => $state_value) {
			foreach ($files as $file_key => $file_value) {
				$ret_val = $state_value;
				array_push($ret_val, $file_value[0]);
				$ret[$state_key . '_' . $file_key] = $ret_val;
			}
		}

		return $ret;
	}

	public function databaseUpdatingStatusProvider(): array {
		return ["kDbInitilazing" => [RIRStatus::kDbInitilazing],
			"kDbUpdating" => [RIRStatus::kDbUpdating]];
	}

	public function databaseNotUpdatingStatusProvider(): array {
		return ["kDbError" => [RIRStatus::kDbError],
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized],
			"kDbOk" => [RIRStatus::kDbOk]];
	}

	public function databaseNotUpdatingStatusStingsProvider(): array {
		$ret = [];

		$states = ["kDbError" => [RIRStatus::kDbError],
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized],
			"kDbOk" => [RIRStatus::kDbOk]];

		$other = [
			"checkAllowURLFOpen" => [false,true,true,
				'"allow_url_fopen" needs to be allowed in php.ini.'],
			"checkGMP" => [true,false,true,
				'PHP GMP Extension needs to be installed.'],
			"checkInternetConnection" => [true,true,false,
				'Internet connection needs to be available.'],
			"shouldNotHappen" => [true,true,true,'']];

		foreach ($states as $state_key => $state_value) {
			foreach ($other as $other_key => $other_value) {
				$ret_val = $state_value;
				array_push($ret_val, $other_value[0]);
				array_push($ret_val, $other_value[1]);
				array_push($ret_val, $other_value[2]);
				array_push($ret_val, $other_value[3]);
				$ret[$state_key . '_' . $other_key] = $ret_val;
			}
		}

		return $ret;
	}

	private function checkSetDBToErrorState($error_message) {
		$this->config->expects($this->exactly(3))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbError)],
				[$this->equalTo(RIRData::kErrorMessageName),$error_message],
				[$this->equalTo(RIRData::kDatabaseDateName),'']);
	}

	private function makeServiceValid() {
		$this->rir_data_checks->expects($this->atLeastOnce())->method(
				'checkGMP')->willReturn(true);
		$this->rir_service_mapper->expects($this->atLeastOnce())->method(
				'getNumberOfEntries')->willReturn(100);

		$ret_map = [
			[RIRData::kServiceStatusName, '0', strval(RIRStatus::kDbOk)],
			[RIRData::kDbVersionName, '0', '0']
		];
		$this->config->expects($this->atLeast(2))->method(
					'getServiceSpecificConfigValue')->will($this->returnValueMap($ret_map));
	}

	private function setupAndCheckDbEntriesCalled(): void {
		$this->rir_data->setDataSource(
				['afrinic' => $this->rir_data_test_file]);

		$inputsV4 = ["afrinic|GH|ipv4|41.75.48.0|4096|20101111|allocated",
			"afrinic|KE|ipv4|41.76.184.0|2048|20100701|allocated"];

		$inputsV6 = ["afrinic|CI|ipv6|2001:42d8::|32|20171229|allocated",
			"afrinic|AO|ipv6|2001:43f8:720::|48|20121025|assigned"];

		$db_entries = [];

		foreach ($inputsV4 as $input) {
			$parts = explode('|', $input);
			$db_entry = new RIRServiceDBEntity();
			$db_entry->setBeginIpRange(
					RIRServiceMapper::ipv4String2Int64($parts[3]));
			$db_entry->setCountryCode($parts[1]);
			$db_entry->setLengthIpRange($parts[4]);
			$db_entry->setIsIpV6(false);
			$db_entry->setVersion(0);
			array_push($db_entries, $db_entry);
		}

		foreach ($inputsV6 as $input) {
			$parts = explode('|', $input);
			$db_entry = new RIRServiceDBEntity();
			$db_entry->setBeginIpRange(
					RIRServiceMapper::ipv6String2Int64($parts[3]));
			$db_entry->setCountryCode($parts[1]);
			$db_entry->setLengthIpRange(pow(2, 64 - intval($parts[4])));
			$db_entry->setIsIpV6(true);
			$db_entry->setVersion(0);
			array_push($db_entries, $db_entry);
		}

		$this->rir_service_mapper->expects($this->exactly(4))->method('insert')->withConsecutive(
				[$this->equalTo($db_entries[0])],
				[$this->equalTo($db_entries[1])],
				[$this->equalTo($db_entries[2])],
				[$this->equalTo($db_entries[3])]);
	}

	private function setupAndCheckDbEntriesNotCalled(string $file): void {
		$this->rir_data->setDataSource(['afrinic' => $file]);
		$this->rir_service_mapper->expects($this->never())->method('insert');
	}

	public function callbackRirServiceMapperInsertException(): string {
		throw new Exception('Test Exception during Insert into DB.');
		return null;
	}
}
