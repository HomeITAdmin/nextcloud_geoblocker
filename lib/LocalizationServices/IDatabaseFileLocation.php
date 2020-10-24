<?php

namespace OCA\GeoBlocker\LocalizationServices;

interface IDatabaseFileLocation {
	/**
	 * return the Path, where the database is stored.
	 *
	 * @return string
	 *
	 */
	public function getDatabaseFileLocation(): string;

	/**
	 * set the Path, where the database is stored
	 *
	 * @param string
	 *
	 */
	public function setDatabaseFileLocation(string $path);
}
