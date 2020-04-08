<?php

namespace OCA\GeoBlocker\LocalizationServices;

interface IDatabaseDate {
	/**
	 * return the date of the databse
	 *
	 * @return string
	 */
	public function getDatabaseDate(): string;
}
