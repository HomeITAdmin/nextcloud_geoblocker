<?php

namespace OCA\GeoBlocker\LocalizationServices;

abstract class LocationServiceUpdateStatus {
	const kUpdateNotPossible = 0;
	const kUpdatePossible = 1;
	const kUpdating = 2;
}
interface IDatabaseUpdate {
	
	/**
	 * Start the update of the database.
	 * Returns true, if the update were started successfully otherwise false
	 *
	 * @return bool
	 */
	public function updateDatabase() : bool;
		
	/**
	 * Returns the status of the update functionality of the location service
	 *
	 * @return LocationServiceUpdateStatus
	 */
	public function getDatabaseUpdateStatus() : LocationServiceUpdateStatus;
	
	/**
	 * Returns a status string describing the current status of the update. If:
	 *  - Status == kUpdateNotPossible: Why is the update not possible and what needs to be done to change this.
	 *  - Status == kUpdatePossible: "Update possible.".
	 *  - Status == kUpdating: "Update running.". If wanted additional information about what is currently happening can be provided. 
	 *
	 * @return string
	 */
	public function getDatabaseUpdateStatusString() : string;
	
	
}