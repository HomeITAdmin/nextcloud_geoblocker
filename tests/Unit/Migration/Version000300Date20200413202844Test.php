<?php
/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Tests\Unit\Migration;

use PHPUnit\Framework\TestCase;
use OCA\GeoBlocker\Migration\Version000300Date20200413202844;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;

class Version000300Date20200413202844Test extends TestCase {
	use SchemaMockTypes;

	private $output;
	private $migration;

	public function setUp(): void {
		parent::setUp();
		$this->output = $this->createStub(IOutput::class);
		$this->migration = new Version000300Date20200413202844();
	}

	public function testIsChangeSchemaTableExistsValid() {
		$schema = $this->createMock(ISchemaWrapper::class);
		$schema->expects($this->once())->method('hasTable')->with(
				$this->equalTo('geoblocker_ls_rir'))->willReturn(true);
		$schema->expects($this->never())->method('createTable');

		$result = $this->migration->changeSchema($this->output,
				fn () => $schema, []);
		$this->assertSame($schema, $result);
	}

	public function testIsChangeSchemaTableMissingValid() {
		$table = $this->createMock(self::tableType());
		$table->expects($this->exactly(6))->method('addColumn');
		$table->expects($this->once())->method('setPrimaryKey')->with(
				$this->equalTo(['id']));

		$schema = $this->createMock(ISchemaWrapper::class);
		$schema->expects($this->once())->method('hasTable')->with(
				$this->equalTo('geoblocker_ls_rir'))->willReturn(false);
		$schema->expects($this->once())->method('createTable')->with(
				$this->equalTo('geoblocker_ls_rir'))->willReturn($table);

		$result = $this->migration->changeSchema($this->output,
				fn () => $schema, []);
		$this->assertSame($schema, $result);
	}

	public function testIsPreSchemaChangeValid() {
		$schema = $this->createStub(ISchemaWrapper::class);
		$this->assertNull($this->migration->preSchemaChange($this->output,
				fn () => $schema, []));
	}

	public function testIsPostSchemaChangeValid() {
		$schema = $this->createStub(ISchemaWrapper::class);
		$this->assertNull($this->migration->postSchemaChange($this->output,
				fn () => $schema, []));
	}
}
