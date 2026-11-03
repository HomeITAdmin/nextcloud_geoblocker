<?php
/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Migration;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Migration\Version000501Date20210709171637;
use OCP\DB\ISchemaWrapper;
use OCP\DB\Schema\IColumn;
use OCP\DB\Schema\ITable;
use OCP\Migration\IOutput;

class Version000501Date20210709171637Test extends TestCase {
	private $output;
	private $migration;

	public function setUp(): void {
		parent::setUp();
		$this->output = $this->createStub(IOutput::class);
		$this->migration = new Version000501Date20210709171637();
	}

	public function testIsChangeSchemaColumnNotNullValid() {
		$column = $this->createMock(IColumn::class);
		$column->method('getNotnull')->willReturn(true);
		$column->expects($this->once())->method('setNotnull')->with(
				$this->equalTo(false));

		$table = $this->createMock(ITable::class);
		$table->expects($this->once())->method('getColumn')->with(
				$this->equalTo('is_ip_v6'))->willReturn($column);

		$schema = $this->createMock(ISchemaWrapper::class);
		$schema->expects($this->once())->method('getTable')->with(
				$this->equalTo('geoblocker_ls_rir'))->willReturn($table);

		$result = $this->migration->changeSchema($this->output,
				fn () => $schema, []);
		$this->assertSame($schema, $result);
	}

	public function testIsChangeSchemaColumnAlreadyNullableValid() {
		$column = $this->createMock(IColumn::class);
		$column->method('getNotnull')->willReturn(false);
		$column->expects($this->never())->method('setNotnull');

		$table = $this->createStub(ITable::class);
		$table->method('getColumn')->willReturn($column);

		$schema = $this->createMock(ISchemaWrapper::class);
		$schema->expects($this->once())->method('getTable')->with(
				$this->equalTo('geoblocker_ls_rir'))->willReturn($table);

		$result = $this->migration->changeSchema($this->output,
				fn () => $schema, []);
		$this->assertNull($result);
	}
}
