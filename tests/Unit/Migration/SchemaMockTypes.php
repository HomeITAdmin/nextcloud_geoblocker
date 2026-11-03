<?php

/**
 * SPDX-FileCopyrightText: 2026 HomeITAdmin
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

declare(strict_types = 1);

namespace OCA\GeoBlocker\Tests\Unit\Migration;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use OCP\DB\ISchemaWrapper;
use ReflectionMethod;
use ReflectionNamedType;

/**
 * Resolves the table and column types to mock for the running Nextcloud version:
 * newer versions return OCP\DB\Schema interfaces, older ones the untyped Doctrine classes.
 */
trait SchemaMockTypes {
	private static function tableType(): string {
		return self::returnTypeOf(ISchemaWrapper::class, 'getTable', Table::class);
	}

	private static function columnType(): string {
		return self::returnTypeOf(self::tableType(), 'getColumn', Column::class);
	}

	private static function returnTypeOf(string $class, string $method, string $fallback): string {
		$type = (new ReflectionMethod($class, $method))->getReturnType();
		if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
			return $type->getName();
		}
		return $fallback;
	}
}
