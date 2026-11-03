<?php
/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Db;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Db\RIRServiceDBEntity;

class RIRServiceDBEntityTest extends TestCase {
	private $entity;

	public function setUp(): void {
		parent::setUp();
		$this->entity = new RIRServiceDBEntity();
		$this->entity->setId(7);
		$this->entity->setBeginIpRange(16909056);
		$this->entity->setLengthIpRange(256);
		$this->entity->setIsIpV6(false);
		$this->entity->setCountryCode('AU');
		$this->entity->setVersion(3);
	}

	public function testIsGettersReturnSetValues() {
		$this->assertEquals(7, $this->entity->getId());
		$this->assertEquals(16909056, $this->entity->getBeginIpRange());
		$this->assertEquals(256, $this->entity->getLengthIpRange());
		$this->assertFalse($this->entity->getIsIpV6());
		$this->assertEquals('AU', $this->entity->getCountryCode());
		$this->assertEquals(3, $this->entity->getVersion());
	}

	public function testIsJsonSerializeValid() {
		$this->assertEquals(
				['id' => 7, 'beginIpRange' => 16909056, 'lengthIpRange' => 256,
					'isIpV6' => false, 'countryCode' => 'AU', 'version' => 3],
				$this->entity->jsonSerialize());
	}

	public function testIsJsonSerializeIpV6Valid() {
		$this->entity->setIsIpV6(true);
		$this->entity->setCountryCode('DE');
		$this->assertTrue($this->entity->getIsIpV6());
		$this->assertEquals(
				['id' => 7, 'beginIpRange' => 16909056, 'lengthIpRange' => 256,
					'isIpV6' => true, 'countryCode' => 'DE', 'version' => 3],
				$this->entity->jsonSerialize());
	}
}
