<?php

namespace OCA\GeoBlocker\LocalizationServices;

interface IDatabaseUpdate {
	
	/**
	 * Start the update of the database.
	 * Returns true, if the update were started successfully otherwise false
	 *
	 * @return bool
	 */
	public function updateDatabase() : bool;
	
// 	/**
// 	 * Returns true, if the update can be started otherwise false
// 	 *
// 	 * @return bool
// 	 */
// 	public function isDatabaseUpdatePossible() : bool;
	
// 	/**
// 	 * Returns true, if the update is currently ongoing otherwise false
// 	 *
// 	 * @return bool
// 	 */
// 	public function isDatabaseUpdateRunning() : bool;
	
// 	/**
// 	 * Returns a status string descibing the current status of the update
// 	 *
// 	 * @return string
// 	 */
// 	public function getDatabaseStatusString() : string;
	
	
}