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
use OCA\GeoBlocker\Command\LocalizationService\ResetCountries;
use OCA\GeoBlocker\Config\GeoBlockerConfig;

class ResetCountriesTest extends TestCase {
	public function testIsNameAndDescriptionValid() {
		$command = new ResetCountries($this->createStub(GeoBlockerConfig::class));
		$this->assertSame('geoblocker:country-selection:reset', $command->getName());
		$this->assertSame('Resets the country selection, so that no country is blocked.',
				$command->getDescription());
	}

	public function testIsResetCallingConfigValid() {
		$config = $this->createMock(GeoBlockerConfig::class);
		$config->expects($this->once())->method('setUseWhiteListing')->with(false);
		$config->expects($this->once())->method('setChoosenCountriesByString')->with('');
		$tester = new CommandTester(new ResetCountries($config));
		$this->assertSame(0, $tester->execute([]));
		$this->assertSame('', $tester->getDisplay());
	}
}
