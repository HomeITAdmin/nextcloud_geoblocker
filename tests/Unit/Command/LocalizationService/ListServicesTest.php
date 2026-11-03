<?php

/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Command\LocalizationService;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use OCA\GeoBlocker\Command\LocalizationService\ListServices;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class ListServicesTest extends TestCase {
	private function run_command(array $overview): CommandTester {
		$factory = $this->createStub(LocalizationServiceFactory::class);
		$factory->method('getLocationServiceOverview')->willReturn($overview);
		$tester = new CommandTester(new ListServices($factory));
		$this->assertSame(0, $tester->execute([]));
		return $tester;
	}

	public function testIsNameAndDescriptionValid() {
		$command = new ListServices($this->createStub(LocalizationServiceFactory::class));
		$this->assertSame('geoblocker:localization-service:list-services', $command->getName());
		$this->assertSame('List the IDs of the localization services.', $command->getDescription());
	}

	public function testIsOutputWithActiveServiceValid() {
		$tester = $this->run_command(['Service A' => false, 'Service B' => true, 'Service C' => false]);
		$this->assertSame("\n0: Service A\n1: Service B [Active]\n2: Service C\n\n", $tester->getDisplay());
	}

	public function testIsOutputEmptyOverviewValid() {
		$tester = $this->run_command([]);
		$this->assertSame("\n\n", $tester->getDisplay());
	}
}
