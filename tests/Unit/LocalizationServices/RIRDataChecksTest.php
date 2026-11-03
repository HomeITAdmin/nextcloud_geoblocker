<?php

/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1);

namespace OCA\GeoBlocker\Tests\Unit\LocalizationServices;

use OCA\GeoBlocker\LocalizationServices\RIRDataChecks;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RIRDataChecksTest extends TestCase {
	private $checks;

	public function setUp(): void {
		parent::setUp();
		$this->checks = new RIRDataChecks();
	}

	public function testIsCheckAllowURLFOpenMatchingIniSetting() {
		$this->assertSame(ini_get('allow_url_fopen') === '1',
			$this->checks->checkAllowURLFOpen());
	}

	public function testIsCheckGMPMatchingAvailableFunctions() {
		$this->assertSame(
			function_exists('gmp_import') && function_exists('gmp_intval'),
			$this->checks->checkGMP());
	}

	public function testIsCheck64BitMatchingIntSize() {
		$this->assertSame(PHP_INT_SIZE >= 8, $this->checks->check64Bit());
	}

	public static function checkAllProvider(): array {
		return [
			[true, true, true, true],
			[false, true, true, false],
			[true, false, true, false],
			[true, true, false, false],
			[false, false, false, false],
		];
	}

	#[DataProvider('checkAllProvider')]
	public function testIsCheckAllCombiningAllChecks(bool $url_fopen, bool $gmp,
		bool $internet, bool $expected) {
		$checks = $this->getMockBuilder(RIRDataChecks::class)
			->onlyMethods(['checkAllowURLFOpen', 'checkGMP', 'checkInternetConnection'])
			->getMock();
		$checks->expects($this->once())->method('checkAllowURLFOpen')->willReturn($url_fopen);
		$checks->method('checkGMP')->willReturn($gmp);
		$checks->method('checkInternetConnection')->willReturn($internet);
		$this->assertSame($expected, $checks->checkAll());
	}
}
