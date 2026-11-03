<?php

/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1);

namespace OCA\GeoBlocker\Tests\Unit\Controller;

use OCA\GeoBlocker\Controller\ServiceController;
use OCA\GeoBlocker\LocalizationServices\Dummy;
use OCA\GeoBlocker\LocalizationServices\IDatabaseDate;
use OCA\GeoBlocker\LocalizationServices\IDatabaseFileLocation;
use OCA\GeoBlocker\LocalizationServices\IDatabaseUpdate;
use OCA\GeoBlocker\LocalizationServices\ILocalizationService;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\IConfig;
use OCP\IDBConnection;
use OCP\IL10N;
use OCP\IRequest;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use ReflectionProperty;

class ServiceControllerTest extends TestCase {
	private const ID = 5;

	private function createController(?object $factory, ?object $service = null): ServiceController {
		$l = $this->createStub(IL10N::class);
		$l->method('t')->willReturnCallback(fn ($text) => $text);
		$controller = new ServiceController(
			'geoblocker',
			$this->createStub(IRequest::class),
			$this->createStub(IConfig::class),
			$l,
			$this->createStub(IDBConnection::class),
			$this->createStub(LoggerInterface::class)
		);
		if ($factory !== null) {
			$property = new ReflectionProperty(ServiceController::class, 'location_service_factory');
			$property->setValue($controller, $factory);
		}
		return $controller;
	}

	private function createFactory(object $service, bool $date, bool $file, bool $update): LocalizationServiceFactory {
		$factory = $this->createStub(LocalizationServiceFactory::class);
		$factory->method('getLocationServiceByID')->willReturn($service);
		$factory->method('hasDatabaseDateByID')->willReturn($date);
		$factory->method('hasDatabaseFileLocationByID')->willReturn($file);
		$factory->method('hasDatabaseUpdateByID')->willReturn($update);
		return $factory;
	}

	private function createFullService() {
		$service = $this->createStubForIntersectionOfInterfaces([
			ILocalizationService::class,
			IDatabaseDate::class,
			IDatabaseFileLocation::class,
			IDatabaseUpdate::class,
		]);
		$service->method('getStatusString')->willReturn('status-text');
		$service->method('getDatabaseDate')->willReturn('2026-01-02');
		$service->method('getDatabaseFileLocation')->willReturn('/path/to/db');
		$service->method('getDatabaseUpdateStatus')->willReturn(1);
		$service->method('getDatabaseUpdateStatusString')->willReturn('update-text');
		return $service;
	}

	public function testConstructorBuildsRealFactory(): void {
		$controller = $this->createController(null);
		$property = new ReflectionProperty(ServiceController::class, 'location_service_factory');
		$this->assertInstanceOf(LocalizationServiceFactory::class, $property->getValue($controller));
	}

	public function testStatus(): void {
		$service = $this->createFullService();
		$controller = $this->createController($this->createFactory($service, true, true, true));
		$response = $controller->status(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('status-text', $response->getData());
	}

	public function testHasDatabaseDate(): void {
		foreach ([true, false] as $value) {
			$controller = $this->createController($this->createFactory($this->createFullService(), $value, false, false));
			$response = $controller->hasDatabaseDate(self::ID);
			$this->assertInstanceOf(DataResponse::class, $response);
			$this->assertSame($value, $response->getData());
		}
	}

	public function testGetDatabaseDateAvailable(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), true, false, false));
		$response = $controller->getDatabaseDate(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('2026-01-02', $response->getData());
	}

	public function testGetDatabaseDateNotAvailable(): void {
		$controller = $this->createController($this->createFactory(new Dummy($this->createStub(IL10N::class)), false, false, false));
		$response = $controller->getDatabaseDate(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('No database date available.', $response->getData());
	}

	public static function configurationOptionProvider(): array {
		// file, update, expected
		return [
			[false, false, false],
			[true, false, true],
			[false, true, true],
			[true, true, true],
		];
	}

	#[DataProvider('configurationOptionProvider')]
	public function testHasConfigurationOption(bool $file, bool $update, bool $expected): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, $file, $update));
		$this->assertSame($expected, $controller->hasConfigurationOptionImpl(self::ID));
		$response = $controller->hasConfigurationOption(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame($expected, $response->getData());
	}

	public function testHasDatabaseFileLocation(): void {
		foreach ([true, false] as $value) {
			$controller = $this->createController($this->createFactory($this->createFullService(), false, $value, false));
			$response = $controller->hasDatabaseFileLocation(self::ID);
			$this->assertInstanceOf(DataResponse::class, $response);
			$this->assertSame($value, $response->getData());
		}
	}

	public function testGetDatabaseFileLocationAvailable(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, true, false));
		$response = $controller->getDatabaseFileLocation(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('/path/to/db', $response->getData());
	}

	public function testGetDatabaseFileLocationNotAvailable(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, false, false));
		$response = $controller->getDatabaseFileLocation(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('Database file location not available!', $response->getData());
	}

	public function testGetUniqueServiceString(): void {
		$dummy = new Dummy($this->createStub(IL10N::class));
		$controller = $this->createController($this->createFactory($dummy, false, false, false));
		$response = $controller->getUniqueServiceString(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('Dummy', $response->getData());
	}

	public function testHasDatabaseUpdate(): void {
		foreach ([true, false] as $value) {
			$controller = $this->createController($this->createFactory($this->createFullService(), false, false, $value));
			$response = $controller->hasDatabaseUpdate(self::ID);
			$this->assertInstanceOf(DataResponse::class, $response);
			$this->assertSame($value, $response->getData());
		}
	}

	public function testUpdateDatabase(): void {
		foreach ([true, false] as $value) {
			$factory = $this->createMock(LocalizationServiceFactory::class);
			$factory->expects($this->once())->method('updateDatabaseByID')->with(self::ID)->willReturn($value);
			$response = $this->createController($factory)->updateDatabase(self::ID);
			$this->assertInstanceOf(DataResponse::class, $response);
			$this->assertSame($value, $response->getData());
		}
	}

	public function testGetDatabaseUpdateStatusAvailable(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, false, true));
		$response = $controller->getDatabaseUpdateStatus(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame(1, $response->getData());
	}

	public function testGetDatabaseUpdateStatusNotAvailable(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, false, false));
		$response = $controller->getDatabaseUpdateStatus(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('Update Status not available!', $response->getData());
	}

	public function testGetDatabaseUpdateStatusStringAvailable(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, false, true));
		$response = $controller->getDatabaseUpdateStatusString(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('update-text', $response->getData());
	}

	public function testGetDatabaseUpdateStatusStringNotAvailable(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, false, false));
		$response = $controller->getDatabaseUpdateStatusString(self::ID);
		$this->assertInstanceOf(DataResponse::class, $response);
		$this->assertSame('Update Status not available!', $response->getData());
	}

	public function testGetAllServiceDataNoCapabilities(): void {
		$dummy = new Dummy($this->createStub(IL10N::class));
		$controller = $this->createController($this->createFactory($dummy, false, false, false));
		$response = $controller->getAllServiceData(self::ID);
		$this->assertInstanceOf(JSONResponse::class, $response);
		$this->assertSame([
			'status' => $dummy->getStatusString(),
			'hasDatabaseDate' => false,
			'hasConfigurationOption' => false,
		], $response->getData());
	}

	public function testGetAllServiceDataAllCapabilities(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), true, true, true));
		$response = $controller->getAllServiceData(self::ID);
		$this->assertInstanceOf(JSONResponse::class, $response);
		$this->assertSame([
			'status' => 'status-text',
			'hasDatabaseDate' => true,
			'getDatabaseDate' => '2026-01-02',
			'hasConfigurationOption' => true,
			'hasDatabaseFileLocation' => true,
			'getDatabaseFileLocation' => '/path/to/db',
			'hasDatabaseUpdate' => true,
			'getDatabaseUpdateStatus' => 1,
			'getDatabaseUpdateStatusString' => 'update-text',
		], $response->getData());
	}

	public function testGetAllServiceDataFileLocationOnly(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, true, false));
		$data = $controller->getAllServiceData(self::ID)->getData();
		$this->assertSame([
			'status' => 'status-text',
			'hasDatabaseDate' => false,
			'hasConfigurationOption' => true,
			'hasDatabaseFileLocation' => true,
			'getDatabaseFileLocation' => '/path/to/db',
			'hasDatabaseUpdate' => false,
		], $data);
	}

	public function testGetAllServiceDataUpdateOnly(): void {
		$controller = $this->createController($this->createFactory($this->createFullService(), false, false, true));
		$data = $controller->getAllServiceData(self::ID)->getData();
		$this->assertSame([
			'status' => 'status-text',
			'hasDatabaseDate' => false,
			'hasConfigurationOption' => true,
			'hasDatabaseFileLocation' => false,
			'hasDatabaseUpdate' => true,
			'getDatabaseUpdateStatus' => 1,
			'getDatabaseUpdateStatusString' => 'update-text',
		], $data);
	}
}
