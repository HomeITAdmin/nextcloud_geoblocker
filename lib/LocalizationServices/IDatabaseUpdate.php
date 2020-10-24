<?php

namespace OCA\GeoBlocker\LocalizationServices;

interface IDatabaseUpdate {

	/**
	 * Start the update of the database.
	 * Returns true, if the update were started successfully otherwise false
	 * (is basically not used at the moment but will maybe in the future)
	 *
	 * @return bool
	 */
	public function updateDatabase(): bool;

	/**
	 * Returns the status of the update functionality of the location service
	 *
	 * @return int (LocationServiceUpdateStatus)
	 */
	public function getDatabaseUpdateStatus(): int;

	/**
	 * Returns a status string describing the current status of the update.
	 * If:
	 * - Status == kUpdateNotPossible: Why is the update not possible and what needs to be done to change this.
	 * - Status == kUpdatePossible: Not relevant, string will we ignored.
	 * - Status == kUpdating: If wanted additional information about what is currently happening can be provided otherwise return "".
	 *
	 * @return string
	 */
	public function getDatabaseUpdateStatusString(): string;

	/**
	 * Resets the Database and the service to an uninitialiced condition as if newly installed.
	 * Returns true, if the reset was successful, otherwise false
	 * After a succesful reset the service status must be false and the update status must not be kUdating.
	 *
	 * @return bool
	 */
	public function resetDatabase(): bool;
}
abstract class LocationServiceUpdateStatus {
	public const kUpdateNotPossible = 0;
	public const kUpdatePossible = 1;
	public const kUpdating = 2;
}
