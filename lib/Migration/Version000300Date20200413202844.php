<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version000300Date20200413202844 extends SimpleMigrationStep {

	/**
	 *
	 * @param IOutput $output
	 * @param Closure $schemaClosure
	 *        	The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function preSchemaChange(IOutput $output, Closure $schemaClosure,
			array $options) {
	}

	/**
	 *
	 * @param IOutput $output
	 * @param Closure $schemaClosure
	 *        	The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure,
			array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		if (! $schema->hasTable('geoblocker_ls_rir')) {
			$table = $schema->createTable('geoblocker_ls_rir');
			$table->addColumn('id', 'integer',
					['autoincrement' => true,'notnull' => true]);
			$table->addColumn('begin_ip_range', 'bigint', ['notnull' => true]);
			$table->addColumn('length_ip_range', 'bigint', ['notnull' => true]);
			$table->addColumn('is_ip_v6', 'boolean', ['notnull' => true]);
			$table->addColumn('country_code', 'string',
					['notnull' => true,'length' => 2]);
			$table->addColumn('version', 'integer', ['notnull' => true]);

			$table->setPrimaryKey(['id']);
		}
		return $schema;
	}

	/**
	 *
	 * @param IOutput $output
	 * @param Closure $schemaClosure
	 *        	The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function postSchemaChange(IOutput $output, Closure $schemaClosure,
			array $options) {
	}
}
