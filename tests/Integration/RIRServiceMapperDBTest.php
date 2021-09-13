<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Integration;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Db\RIRServiceMapper;
use OCA\GeoBlocker\Db\RIRServiceDBEntity;

class RIRServiceMapperDBTest extends TestCase {
	public const kUsedTestVersion = 101;

	/** @var IDBConnection */
	private $db;
	/** @var IAppContainer */
	private $container;
	/** @var RIRServiceMapper */
	private $rir_mapper;

	public function setUp(): void {
		parent::setUp();

		$app = new \OCA\GeoBlocker\AppInfo\Application();
		$this->container = $app->getContainer();
		$this->db = $this->container->get('ServerContainer')->getDatabaseConnection();
		$this->rir_mapper = new RIRServiceMapper($this->db);
	}
	
	public function testDbEntryCycle() {
		$this->rir_mapper->eraseAllDatabaseEntries(RIRServiceMapperDBTest::kUsedTestVersion);
		$this->assertEquals($this->rir_mapper->getNumberOfEntries(RIRServiceMapperDBTest::kUsedTestVersion), 0);

		$db_entry = new RIRServiceDBEntity();
		$db_entry->setBeginIpRange(
			RIRServiceMapper::ipv4String2Int64('24.165.23.0'));
		$db_entry->setCountryCode('US');
		$db_entry->setLengthIpRange(256);
		$db_entry->setIsIpV6(false);
		$db_entry->setVersion(RIRServiceMapperDBTest::kUsedTestVersion);
		$this->rir_mapper->insert($db_entry);

		$db_entry = new RIRServiceDBEntity();
		$db_entry->setBeginIpRange(
			RIRServiceMapper::ipv6String2Int64('2a02:2e0::'));
		$db_entry->setCountryCode('DE');
		$db_entry->setLengthIpRange(pow(2, 64 - intval(29)));
		$db_entry->setIsIpV6(true);
		$db_entry->setVersion(RIRServiceMapperDBTest::kUsedTestVersion);
		$this->rir_mapper->insert($db_entry);

		$this->assertEquals($this->rir_mapper->getNumberOfEntries(RIRServiceMapperDBTest::kUsedTestVersion), 2);
		$this->assertEquals($this->rir_mapper->getCountryCodeFromIpv4(RIRServiceMapper::ipv4String2Int64('24.165.23.67'), RIRServiceMapperDBTest::kUsedTestVersion), 'US');
		$this->assertEquals($this->rir_mapper->getCountryCodeFromIpv6(RIRServiceMapper::ipv6String2Int64('2a02:2e0:3fe:1001:302::'), RIRServiceMapperDBTest::kUsedTestVersion), 'DE');

		$this->rir_mapper->eraseAllDatabaseEntries(RIRServiceMapperDBTest::kUsedTestVersion);
		$this->assertEquals($this->rir_mapper->getNumberOfEntries(RIRServiceMapperDBTest::kUsedTestVersion), 0);
	}
}
