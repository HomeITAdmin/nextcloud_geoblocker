<?php
/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Settings;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Settings\AdminSection;
use OCP\IL10N;
use OCP\IURLGenerator;

class AdminSectionTest extends TestCase {
	private $url;
	private $l;
	private $admin_section;

	public function setUp(): void {
		parent::setUp();
		$this->url = $this->createStub(IURLGenerator::class);
		$this->l = $this->createStub(IL10N::class);
		$this->l->method('t')->willReturnCallback(
				fn (string $text) => $text);
		$this->admin_section = new AdminSection($this->url, $this->l);
	}

	public function testIsGetIDValid() {
		$this->assertEquals('geoblocker', $this->admin_section->getID());
	}

	public function testIsGetNameValid() {
		$this->assertEquals('GeoBlocker', $this->admin_section->getName());
	}

	public function testIsGetPriorityValid() {
		$this->assertEquals(50, $this->admin_section->getPriority());
	}

	public function testIsGetIconValid() {
		$url = $this->createMock(IURLGenerator::class);
		$url->expects($this->once())->method('imagePath')->with(
				$this->equalTo('geoblocker'),
				$this->equalTo('blocking-dark.svg'))->willReturn(
				'/apps/geoblocker/img/blocking-dark.svg');
		$admin_section = new AdminSection($url, $this->l);
		$this->assertEquals('/apps/geoblocker/img/blocking-dark.svg',
				$admin_section->getIcon());
	}
}
