<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\LocalizationService;

use OCA\GeoBlocker\Db\RIRServiceMapper;
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
		$this->config->expects($this->atLeastOnce())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval(RIRStatus::kDbOk));
		$this->rir_service_mapper->expects($this->atLeastOnce())->method(
				'getNumberOfEntries')->willReturn(100);
	}

	public function testIsValidStatusOk() {
		$this->makeServiceValid();
		$this->assertTrue($this->rir_data->getStatus());
	}

	public function testIsInvalidStatus1Ok() {
		$this->rir_data_checks->expects($this->once())->method('checkGMP')->willReturn(
				false);
		$this->config->expects($this->exactly(5))->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval(RIRStatus::kDbNotInitialized),
				strval(RIRStatus::kDbInitilazing), strval(RIRStatus::kDbError),
				strval(RIRStatus::kDbUpdating), strval(RIRStatus::kDbOk));

		$this->assertFalse($this->rir_data->getStatus());
		$this->assertFalse($this->rir_data->getStatus());
		$this->assertFalse($this->rir_data->getStatus());
		$this->assertFalse($this->rir_data->getStatus());
		$this->assertFalse($this->rir_data->getStatus());
	}

	public function testIsInvalidStatus2Ok() {
		$this->rir_data_checks->expects($this->once())->method('checkGMP')->willReturn(
				true);
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval(RIRStatus::kDbOk));
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(0);

		$this->checkSetDBToErrorState($this->error_message_not_enough_entries);

		$this->assertFalse($this->rir_data->getStatus());
	}

	public function testIsValidStatusStringOk() {
		$this->rir_data_checks->expects($this->once())->method('checkGMP')->willReturn(
				true);
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval(RIRStatus::kDbOk));
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(1000);

		$result = '"RIR Data": OK.';
		$this->assertEquals($result, $this->rir_data->getStatusString());
	}

	public function testIsInvalidStatusString1Ok() {
		$this->rir_data_checks->expects($this->once())->method('checkGMP')->willReturn(
				false);
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(1000);
		$error_message = 'My last error message!';

		$this->config->expects($this->exactly(6))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kErrorMessageName),$this->equalTo('')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')])->willReturnOnConsecutiveCalls(
				strval(RIRStatus::kDbNotInitialized),
				strval(RIRStatus::kDbInitilazing), strval(RIRStatus::kDbError),
				$error_message, strval(RIRStatus::kDbUpdating),
				strval(RIRStatus::kDbOk));

		$this->assertEquals(
				'"RIR Data": ERROR: The database is not initialized. Please run update.',
				$this->rir_data->getStatusString());
		$this->assertEquals(
				'"RIR Data": ERROR: The database is currently initializing. Please wait until update is finished. This may take several minutes.',
				$this->rir_data->getStatusString());
		$this->assertEquals(
				'"RIR Data": ERROR: The database is corrupted. Please run update again. Last error message: ' .
				$error_message, $this->rir_data->getStatusString());
		$this->assertEquals(
				'"RIR Data": ERROR: The database is currently updating. Please wait until update is finished. This may take several minutes.',
				$this->rir_data->getStatusString());
		$this->assertEquals(
				'"RIR Data": ERROR: PHP GMP Extension needs to be installed.',
				$this->rir_data->getStatusString());
	}

	public function testIsInvalidStatusString2Ok() {
		$this->rir_data_checks->expects($this->atMost(1))->method('checkGMP')->willReturn(
				true);
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(0);

		$this->config->expects($this->exactly(2))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kErrorMessageName),$this->equalTo('')])->willReturnOnConsecutiveCalls(
				strval(RIRStatus::kDbOk),
				$this->error_message_not_enough_entries);

		$this->checkSetDBToErrorState($this->error_message_not_enough_entries);

		$result = '"RIR Data": ERROR: The database is corrupted. Please run update again. Last error message: ' .
				$this->error_message_not_enough_entries;
		$this->assertEquals($result, $this->rir_data->getStatusString());
	}

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

	public function testIsCountryCodeFromValidIpWithUnavailableService1Ok() {
		$this->rir_data_checks->expects($this->once())->method('checkGMP')->willReturn(
				false);
		$this->config->expects($this->exactly(5))->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval(RIRStatus::kDbNotInitialized),
				strval(RIRStatus::kDbInitilazing), strval(RIRStatus::kDbError),
				strval(RIRStatus::kDbUpdating), strval(RIRStatus::kDbOk));

		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv6');
		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv4');

		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'UNAVAILABLE';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
		$ip_address = '24.165.23.67';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
	}

	public function testIsCountryCodeFromValidIpWithUnavailableService2Ok() {
		$this->rir_data_checks->expects($this->once())->method('checkGMP')->willReturn(
				true);
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval(RIRStatus::kDbOk));
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(0);

		$this->checkSetDBToErrorState($this->error_message_not_enough_entries);

		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv6');
		$this->rir_service_mapper->expects($this->never())->method(
				'getCountryCodeFromIpv4');

		$ip_address = '2a02:2e0:3fe:1001:302::';
		$country_code = 'UNAVAILABLE';
		$this->assertEquals($country_code,
				$this->rir_data->getCountryCodeFromIP($ip_address));
	}

	public function testIsGetDatabaseDateValidOk() {
		$db_date = '2020-06-07';
		$this->config->expects($this->exactly(2))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')])->willReturnOnConsecutiveCalls(
				strval(RIRStatus::kDbOk), $db_date);
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(1000);

		$this->assertEquals($db_date, $this->rir_data->getDatabaseDate());
	}

	public function testIsGetDatabaseDateInvalid1Ok() {
		$this->config->expects($this->exactly(2))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')])->willReturnOnConsecutiveCalls(
				strval(RIRStatus::kDbOk), '');
		$this->rir_service_mapper->expects($this->never())->method(
				'getNumberOfEntries');

		$this->assertEquals('Date of the database cannot be determined!',
				$this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider nonOkRirStatusProvider
	 */
	public function testIsGetDatabaseDateInvalid2Ok(int $rir_status) {
		$this->config->expects($this->exactly(2))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')])->willReturnOnConsecutiveCalls(
				strval($rir_status), '');
		$this->rir_service_mapper->expects($this->never())->method(
				'getNumberOfEntries');

		$this->assertEquals('No database available!',
				$this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider nonOkRirStatusProvider
	 */
	public function testIsGetDatabaseDateInvalid3Ok(int $rir_status) {
		$db_date = '2020-06-07';
		$this->config->expects($this->exactly(2))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')])->willReturnOnConsecutiveCalls(
				strval($rir_status), $db_date);
		$this->rir_service_mapper->expects($this->never())->method(
				'getNumberOfEntries');

		$this->assertEquals('No database available!',
				$this->rir_data->getDatabaseDate());
	}

	public function testIsGetDatabaseDateInvalid4Ok() {
		$db_date = '2020-06-07';
		$this->config->expects($this->exactly(2))->method(
				'getServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo('0')],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')])->willReturnOnConsecutiveCalls(
				strval(RIRStatus::kDbOk), $db_date);
		$this->rir_service_mapper->expects($this->once())->method(
				'getNumberOfEntries')->willReturn(0);

		$this->assertEquals('No database available!',
				$this->rir_data->getDatabaseDate());
	}

	/**
	 *
	 * @dataProvider updateableRirStatusProvider
	 */
	public function testIsUpdateDatabaseSuccessOk(int $rir_status_before,
			int $rir_status_inter) {
		$this->config->expects($this->once())->method(
				'getServiceSpecificConfigValue')->with(
				$this->equalTo(RIRData::kServiceStatusName), $this->equalTo('0'))->willReturn(
				strval($rir_status_before));
		$this->rir_service_mapper->expects($this->once())->method(
				'eraseAllDatabaseEntries')->willReturn(true);
		$this->config->expects($this->exactly(4))->method(
				'setServiceSpecificConfigValue')->withConsecutive(
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo($rir_status_inter)],
				[$this->equalTo(RIRData::kDatabaseDateName),$this->equalTo('')],
				[$this->equalTo(RIRData::kDatabaseDateName),
					$this->equalTo(date("Y-m-d"))],
				[$this->equalTo(RIRData::kServiceStatusName),
					$this->equalTo(RIRStatus::kDbOk)]);

		$this->setupAndCheckDbEntries();

		$this->assertTrue($this->rir_data->updateDatabase());
	}

	public function callbackLTJustRouteThrough(string $in): string {
		return $in;
	}

	public function nonOkRirStatusProvider(): array {
		return ["kDbError" => [RIRStatus::kDbError],
			"kDbInitilazing" => [RIRStatus::kDbInitilazing],
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized],
			"kDbUpdating" => [RIRStatus::kDbUpdating]];
	}

	public function updateableRirStatusProvider(): array {
		return ["kDbOk" => [RIRStatus::kDbOk,RIRStatus::kDbUpdating],
			"kDbNotInitialized" => [RIRStatus::kDbNotInitialized,
				RIRStatus::kDbInitilazing]];
	}

	private function setupAndCheckDbEntries(): void {
		$this->rir_data->setDataSource(
				array('afrinic' => $this->rir_data_test_file));

		$inputsV4 = ["afrinic|GH|ipv4|41.75.48.0|4096|20101111|allocated",
			"afrinic|KE|ipv4|41.76.184.0|2048|20100701|allocated"];

		$inputsV6 = ["afrinic|CI|ipv6|2001:42d8::|32|20171229|allocated",
			"afrinic|AO|ipv6|2001:43f8:720::|48|20121025|assigned"];

		$db_entries = array();

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
}
