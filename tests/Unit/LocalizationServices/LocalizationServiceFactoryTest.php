<?php

/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1);

namespace OCA\GeoBlocker\Tests\Unit\LocalizationServices;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\LocalizationServices\Dummy;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCA\GeoBlocker\LocalizationServices\IDatabaseUpdate;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;
use OCA\GeoBlocker\LocalizationServices\RIRData;
use OCP\IDBConnection;
use OCP\IL10N;
use OutOfRangeException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class LocalizationServiceFactoryTest extends TestCase {
	private $l;
	private $db;
	private $logger;

	public function setUp(): void {
		parent::setUp();
		$this->l = $this->createStub(IL10N::class);
		$this->l->method('t')->willReturnCallback(fn ($text) => $text);
		$this->db = $this->createStub(IDBConnection::class);
		$this->logger = $this->createStub(LoggerInterface::class);
	}

	private function createFactory(string $chosen = '3'): LocalizationServiceFactory {
		$config = $this->createStub(GeoBlockerConfig::class);
		$config->method('getChosenService')->willReturn($chosen);
		return new LocalizationServiceFactory($config, $this->l, $this->db, $this->logger);
	}

	public static function serviceClassProvider(): array {
		return [
			[0, GeoIPLookup::class],
			[1, MaxMindGeoLite2::class],
			[2, RIRData::class],
			[3, Dummy::class],
			[4, Dummy::class],
			[-1, Dummy::class],
		];
	}

	public static function capabilityProvider(): array {
		// id, hasDate, hasFileLocation, hasUpdate
		return [
			[0, true, false, false],
			[1, true, true, false],
			[2, true, false, true],
			[3, false, false, false],
			[99, false, false, false],
		];
	}

	public function testGetCurrentLocationServiceIDReturnsInt(): void {
		$this->assertSame(2, $this->createFactory('2')->getCurrentLocationServiceID());
	}

	#[DataProvider('validIdProvider')]
	public function testSetCurrentLocationServiceIDStoresString(int $id): void {
		$config = $this->createMock(GeoBlockerConfig::class);
		$config->expects($this->once())->method('setChosenService')->with(strval($id));
		$factory = new LocalizationServiceFactory($config, $this->l, $this->db, $this->logger);
		$factory->setCurrentLocationServiceID($id);
	}

	public static function validIdProvider(): array {
		return [[0], [1], [2], [3]];
	}

	#[DataProvider('invalidIdProvider')]
	public function testSetCurrentLocationServiceIDRejectsInvalid(int $id): void {
		$config = $this->createMock(GeoBlockerConfig::class);
		$config->expects($this->never())->method('setChosenService');
		$factory = new LocalizationServiceFactory($config, $this->l, $this->db, $this->logger);
		$this->expectException(OutOfRangeException::class);
		$factory->setCurrentLocationServiceID($id);
	}

	public static function invalidIdProvider(): array {
		return [[-1], [4]];
	}

	#[DataProvider('serviceClassProvider')]
	public function testGetLocationServiceByID(int $id, string $class): void {
		$this->assertInstanceOf($class, $this->createFactory()->getLocationServiceByID($id));
		$this->assertSame($class, get_class($this->createFactory()->getLocationServiceByID($id)));
	}

	public function testGetLocationServiceUsesCurrentId(): void {
		$this->assertInstanceOf(GeoIPLookup::class, $this->createFactory('0')->getLocationService());
		$this->assertInstanceOf(RIRData::class, $this->createFactory('2')->getLocationService());
	}

	public function testGetLocationServiceOverview(): void {
		$expected_keys = [
			'GeoIPLookup (local)',
			'MaxMindGeoLite2 (local)',
			'RIRData (local)',
			'Dummy  (default)',
		];
		$overview = $this->createFactory('1')->getLocationServiceOverview();
		$this->assertSame($expected_keys, array_keys($overview));
		$this->assertSame([false, true, false, false], array_values($overview));
	}

	public function testGetLocationServiceOverviewDefaultActive(): void {
		$overview = $this->createFactory('3')->getLocationServiceOverview();
		$this->assertSame([false, false, false, true], array_values($overview));
	}

	#[DataProvider('capabilityProvider')]
	public function testCapabilitiesByID(int $id, bool $date, bool $file, bool $update): void {
		$factory = $this->createFactory();
		$this->assertSame($date, $factory->hasDatabaseDateByID($id));
		$this->assertSame($file, $factory->hasDatabaseFileLocationByID($id));
		$this->assertSame($update, $factory->hasDatabaseUpdateByID($id));
	}

	#[DataProvider('capabilityProvider')]
	public function testCapabilitiesForCurrentService(int $id, bool $date, bool $file, bool $update): void {
		$factory = $this->createFactory(strval($id));
		$this->assertSame($date, $factory->hasDatabaseDate());
		$this->assertSame($file, $factory->hasDatabaseFileLocation());
		$this->assertSame($update, $factory->hasDatabaseUpdate());
	}

	#[DataProvider('noUpdateIdProvider')]
	public function testUpdateAndResetWithoutUpdateCapabilityReturnTrue(int $id): void {
		$factory = $this->createFactory(strval($id));
		$this->assertTrue($factory->updateDatabaseByID($id));
		$this->assertTrue($factory->resetDatabaseByID($id));
		$this->assertTrue($factory->updateDatabase());
		$this->assertTrue($factory->resetDatabase());
	}

	public static function noUpdateIdProvider(): array {
		return [[0], [1], [3]];
	}

	private function createFactoryWithService(string $chosen, ?IDatabaseUpdate $service): LocalizationServiceFactory {
		$config = $this->createStub(GeoBlockerConfig::class);
		$config->method('getChosenService')->willReturn($chosen);
		$factory = $this->getMockBuilder(LocalizationServiceFactory::class)
			->setConstructorArgs([$config, $this->l, $this->db, $this->logger])
			->onlyMethods(['getLocationServiceByID'])
			->getMock();
		$factory->expects($this->atLeastOnce())->method('getLocationServiceByID')->willReturn($service);
		return $factory;
	}

	#[DataProvider('boolProvider')]
	public function testUpdateDatabaseDelegatesToService(bool $result): void {
		$service = $this->createMock(IDatabaseUpdate::class);
		$service->expects($this->exactly(2))->method('updateDatabase')->willReturn($result);
		$service->expects($this->never())->method('resetDatabase');
		$factory = $this->createFactoryWithService('2', $service);
		$this->assertSame($result, $factory->updateDatabaseByID(2));
		$this->assertSame($result, $factory->updateDatabase());
	}

	#[DataProvider('boolProvider')]
	public function testResetDatabaseDelegatesToService(bool $result): void {
		$service = $this->createMock(IDatabaseUpdate::class);
		$service->expects($this->exactly(2))->method('resetDatabase')->willReturn($result);
		$service->expects($this->never())->method('updateDatabase');
		$factory = $this->createFactoryWithService('2', $service);
		$this->assertSame($result, $factory->resetDatabaseByID(2));
		$this->assertSame($result, $factory->resetDatabase());
	}

	public static function boolProvider(): array {
		return [[true], [false]];
	}
}
