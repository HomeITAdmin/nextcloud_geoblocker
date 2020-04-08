<?php

namespace OCA\GeoBlocker\LocalizationServices;

interface IDatabasePath {
	/**
	 * return the Path, where the database is stored.
	 *
	 * @return string
	 */
	public function getDatabasePath(): string;

	/**
	 * set the Path, where the database is stored
	 *
	 * @param
	 *        	string
	 */
	public function setDatabasePath(string $path);
}
