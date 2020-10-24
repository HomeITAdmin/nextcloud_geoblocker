<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use OCP\IL10N;
use OCP\IDbConnection;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\Db\RIRServiceMapper;

class LocalizationServiceFactory {
	private $l;
	private $config;
	private $count_ids = 3;
	private $db;

	public function __construct(GeoBlockerConfig $config, IL10N $l,
			IDbConnection $db) {
		$this->l = $l;
		$this->config = $config;
		$this->db = $db;
	}

	public function getCurrentLocationServiceID() {
		return intval($this->config->getChosenService());
	}

	public function getLocationService() {
		return $this->getLocationServiceByID(
				$this->getCurrentLocationServiceID());
	}

	public function getLocationServiceByID(int $id) {
		switch ($id) {
			case '0':
				$location_service = new GeoIPLookup(new GeoIPLookupCmdWrapper(),
						$this->l);
				break;
			case '1':
				$location_service = new MaxMindGeoLite2($this->config, $this->l);
				break;
			case '2':
				$location_service = new RIRData(new RIRDataChecks(),  new RIRServiceMapper($this->db), $this->config,
						$this->l);
				break;
			// Add new location Service here and increase $count_ids
			default:
				$location_service = new GeoIPLookup(new GeoIPLookupCmdWrapper(),
						$this->l);
		}
		return $location_service;
	}

	public function getLocationServiceOverview(): array {
		$current_service = $this->config->getChosenService();
		$overview = [];
		for ($i = 0; $i < $this->count_ids; $i ++) {
			$location_service = $this->getLocationServiceByID($i);
			$service_string = (new \ReflectionClass($location_service))->getShortName();
			if ($location_service instanceof IDatabaseDate ||
					$location_service instanceof IDatabaseFileLocation) {
				$service_string .= ' (' . $this->l->t('local') . ')';
			}
			if ($i == 0) {
				$service_string .= '  (' . $this->l->t('default') . ')';
			}
			$overview[$service_string] = ($current_service == $i);
		}

		return $overview;
	}

	public function hasDatabaseDate(): bool {
		$id = $this->getCurrentLocationServiceID();
		return $this->hasDatabaseDateByID($id);
	}

	public function hasDatabaseDateByID(int $id): bool {
		$location_service = $this->getLocationServiceByID($id);
		return $location_service instanceof IDatabaseDate;
	}

	public function hasDatabaseFileLocation(): bool {
		$id = $this->getCurrentLocationServiceID();
		return $this->hasDatabaseFileLocationByID($id);
	}

	public function hasDatabaseFileLocationByID(int $id): bool {
		$location_service = $this->getLocationServiceByID($id);
		return $location_service instanceof IDatabaseFileLocation;
	}

	public function hasDatabaseUpdate(): bool {
		$id = $this->getCurrentLocationServiceID();
		return $this->hasDatabaseUpdateByID($id);
	}

	public function hasDatabaseUpdateByID(int $id): bool {
		$location_service = $this->getLocationServiceByID($id);
		return $location_service instanceof IDatabaseUpdate;
	}

	public function updateDatabase(): bool {
		$id = $this->getCurrentLocationServiceID();
		return $this->updateDatabaseByID($id);
	}

	public function updateDatabaseByID(int $id): bool {
		if ($this->hasDatabaseUpdateByID($id)) {
			$location_service = $this->getLocationServiceByID($id);
			return $location_service->updateDatabase();
		}
		return true;
	}
	
	public function resetDatabase(): bool {
		$id = $this->getCurrentLocationServiceID();
		return $this->resetDatabaseByID($id);
	}
	
	public function resetDatabaseByID(int $id): bool {
		if ($this->hasDatabaseUpdateByID($id)) {
			$location_service = $this->getLocationServiceByID($id);
			return $location_service->resetDatabase();
		}
		return true;
	}
}
