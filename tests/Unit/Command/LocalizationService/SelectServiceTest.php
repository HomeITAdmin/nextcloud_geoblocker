<?php

/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Command\LocalizationService;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Tester\CommandTester;
use OCA\GeoBlocker\Command\LocalizationService\SelectService;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class SelectServiceTest extends TestCase {
	public function testIsNameAndDescriptionValid() {
		$command = new SelectService($this->createStub(LocalizationServiceFactory::class));
		$this->assertSame('geoblocker:localization-service:select-service', $command->getName());
		$this->assertSame(
				'Select the location service, that is used to determine the country code.',
				$command->getDescription());
		$this->assertTrue($command->getDefinition()->getArgument('service_id')->isRequired());
	}

	public function testIsSelectingServiceValid() {
		$factory = $this->createMock(LocalizationServiceFactory::class);
		$factory->expects($this->once())->method('setCurrentLocationServiceID')->with(2);
		$tester = new CommandTester(new SelectService($factory));
		$this->assertSame(0, $tester->execute(['service_id' => '2']));
	}

	public function testIsNonNumericArgumentConvertedToZero() {
		$factory = $this->createMock(LocalizationServiceFactory::class);
		$factory->expects($this->once())->method('setCurrentLocationServiceID')->with(0);
		$tester = new CommandTester(new SelectService($factory));
		$this->assertSame(0, $tester->execute(['service_id' => 'abc']));
	}

	public function testIsMissingArgumentThrowing() {
		$factory = $this->createMock(LocalizationServiceFactory::class);
		$factory->expects($this->never())->method('setCurrentLocationServiceID');
		$tester = new CommandTester(new SelectService($factory));
		$this->expectException(RuntimeException::class);
		$tester->execute([]);
	}

	public function testIsFactoryExceptionPropagated() {
		$factory = $this->createStub(LocalizationServiceFactory::class);
		$factory->method('setCurrentLocationServiceID')->willThrowException(
				new \OutOfRangeException('bad id'));
		$tester = new CommandTester(new SelectService($factory));
		$this->expectException(\OutOfRangeException::class);
		$tester->execute(['service_id' => '99']);
	}
}
