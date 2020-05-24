<?php

namespace OCA\GeoBlocker\LocalizationServices;

interface IDatabaseDate {
	
	/**
	 * return the date of the databse
	 * If the service is not usable, it returns "Date of the database cannot be determined!"
	 *
	 * @return string
	 */
	public function getDatabaseDate(): string;
}
