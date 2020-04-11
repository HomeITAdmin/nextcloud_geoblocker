<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use OCP\IL10N;
use OCA\GeoBlocker\Config\GeoBlockerConfig;

class LocalizationServiceFactory {
	private $l;
	private $config;

	public function __construct(GeoBlockerConfig $config, IL10N $l) {
		$this->l = $l;
		$this->config = $config;
	}

	public function getLocationService() {
		return $this->getLocationServiceByID(
				intval($this->config->getChosenService()));
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
			default:
				$location_service = new GeoIPLookup(new GeoIPLookupCmdWrapper(),
						$this->l);
		}
		return $location_service;
	}

	public function getLocationServiceOverview(): array {
		$current_service = $this->config->getChosenService();
		$geoiplookup = 'Geoiplookup (' . $this->l->t('local') . ') (' .
				$this->l->t('default') . ')';
		$maxmind_geolite2 = 'MaxMind GeoLite2 (' . $this->l->t('local') . ')';
		$overview = array($geoiplookup => ($current_service == 0),
			$maxmind_geolite2 => ($current_service == 1));
		return $overview;
	}

	public function hasDatabaseDate(): bool {
		$location_service = $this->getLocationService();
		return $location_service instanceof IDatabaseDate;
	}

	public function hasDatabaseDateByID(int $id): bool {
		$location_service = $this->getLocationServiceByID($id);
		return $location_service instanceof IDatabaseDate;
	}

	public function hasDatabaseFileLocation(): bool {
		$location_service = $this->getLocationService();
		return $location_service instanceof IDatabaseFileLocation;
	}

	public function hasDatabaseFileLocationByID(int $id): bool {
		$location_service = $this->getLocationServiceByID($id);
		return $location_service instanceof IDatabaseFileLocation;
	}
}
