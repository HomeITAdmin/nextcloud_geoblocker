<?php

/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Command\LocalizationService;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Tester\CommandTester;
use OCA\GeoBlocker\Command\LocalizationService\ResetDB;
use OCA\GeoBlocker\LocalizationServices\IDatabaseUpdate;
use OCA\GeoBlocker\LocalizationServices\ILocalizationService;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;
use OCA\GeoBlocker\LocalizationServices\LocationServiceUpdateStatus;

class ResetDBTest extends TestCase {
	private $factory;
	private $logger;
	private $service;

	public function setUp(): void {
		parent::setUp();
		$this->service = $this->createStubForIntersectionOfInterfaces(
				[ILocalizationService::class, IDatabaseUpdate::class]);
		$this->factory = $this->createStub(LocalizationServiceFactory::class);
		$this->logger = $this->createStub(LoggerInterface::class);
	}

	private function run_command(array $args): CommandTester {
		$tester = new CommandTester(new ResetDB($this->factory, $this->logger));
		$this->assertSame(0, $tester->execute($args));
		return $tester;
	}

	private function expectError(string $message): void {
		$this->logger = $this->createMock(LoggerInterface::class);
		$this->logger->expects($this->once())->method('error')->with($message,
				['app' => 'geoblocker']);
		$this->logger->expects($this->never())->method('info');
	}

	public function testIsNameAndDescriptionValid() {
		$command = new ResetDB($this->factory, $this->logger);
		$this->assertSame('geoblocker:localization-service:reset-db', $command->getName());
		$this->assertSame('Reset the database for the given localization service.', $command->getDescription());
		$this->assertFalse($command->getDefinition()->getArgument('service_id')->isRequired());
	}

	public function testIsCurrentServiceUsedWithoutArgument() {
		$this->factory = $this->createMock(LocalizationServiceFactory::class);
		$this->factory->expects($this->once())->method('getCurrentLocationServiceID')->willReturn(3);
		$this->factory->expects($this->once())->method('hasDatabaseUpdateByID')->with(3)->willReturn(false);
		$this->expectError('The database of this service cannot be reset.');
		$tester = $this->run_command([]);
		$this->assertSame("ERROR: The database of this service cannot be reset.\n", $tester->getDisplay());
	}

	public function testIsGivenArgumentUsedAsInteger() {
		$this->factory = $this->createMock(LocalizationServiceFactory::class);
		$this->factory->expects($this->never())->method('getCurrentLocationServiceID');
		$this->factory->expects($this->once())->method('hasDatabaseUpdateByID')->with(2)->willReturn(false);
		$this->expectError('The database of this service cannot be reset.');
		$this->run_command(['service_id' => '2']);
	}

	public function testIsArgumentZeroUsedAsServiceId() {
		$this->factory = $this->createMock(LocalizationServiceFactory::class);
		$this->factory->expects($this->never())->method('getCurrentLocationServiceID');
		$this->factory->expects($this->once())->method('hasDatabaseUpdateByID')->with(0)->willReturn(false);
		$this->expectError('The database of this service cannot be reset.');
		$this->run_command(['service_id' => '0']);
	}

	private function prepareService(): void {
		$this->factory->method('getCurrentLocationServiceID')->willReturn(1);
		$this->factory->method('hasDatabaseUpdateByID')->willReturnMap([[1, true]]);
		$this->factory->method('getLocationServiceByID')->willReturnMap([[1, $this->service]]);
	}

	private function expectStartAndError(string $error): CommandTester {
		$this->logger = $this->createMock(LoggerInterface::class);
		$this->logger->expects($this->once())->method('info')->with('Starting reset of the database.', ['app' => 'geoblocker']);
		$this->logger->expects($this->once())->method('error')->with($error, ['app' => 'geoblocker']);
		$tester = $this->run_command([]);
		$this->assertStringContainsString("Starting reset of the database.\nERROR: " . $error, $tester->getDisplay());
		return $tester;
	}

	public function testIsSuccessValid() {
		$this->prepareService();
		$this->service->method('resetDatabase')->willReturn(true);
		$this->service->method('getDatabaseUpdateStatus')->willReturn(
				LocationServiceUpdateStatus::kUpdatePossible);
		$this->service->method('getStatus')->willReturn(false);
		$this->logger = $this->createMock(LoggerInterface::class);
		$infos = [];
		$this->logger->expects($this->exactly(2))->method('info')->willReturnCallback(
				function (string $m, array $ctx) use (&$infos) {
					$this->assertSame(['app' => 'geoblocker'], $ctx);
					$infos[] = $m;
				});
		$this->logger->expects($this->never())->method('error');
		$tester = $this->run_command([]);
		$this->assertSame(['Starting reset of the database.', 'Reset was successful.'], $infos);
		$this->assertSame("Starting reset of the database.\nReset was successful.\n",
				$tester->getDisplay());
	}

	public function testIsWrongUpdateStatusError() {
		$this->prepareService();
		$this->service->method('resetDatabase')->willReturn(true);
		$this->service->method('getDatabaseUpdateStatus')->willReturn(
				LocationServiceUpdateStatus::kUpdating);
		$this->service->method('getStatus')->willReturn(false);
		$this->expectStartAndError(
				'There was a problem when reseting the database. Service is not in correct status.');
	}

	public function testIsWrongServiceStatusError() {
		$this->prepareService();
		$this->service->method('resetDatabase')->willReturn(true);
		$this->service->method('getDatabaseUpdateStatus')->willReturn(
				LocationServiceUpdateStatus::kUpdatePossible);
		$this->service->method('getStatus')->willReturn(true);
		$this->expectStartAndError(
				'There was a problem when reseting the database. Service is not in correct status.');
	}

	public function testIsResetReturningFalseError() {
		$this->prepareService();
		$this->service->method('resetDatabase')->willReturn(false);
		$this->expectStartAndError(
				'There was a problem when reseting the database. Reset function returned false.');
	}
}
