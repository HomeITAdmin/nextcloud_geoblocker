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
				$location_service = new MaxMindGeoLite2($this->l);
				break;
			default:
				$location_service = new GeoIPLookup(new GeoIPLookupCmdWrapper(),
						$this->l);
		}
		return $location_service;
	}
}
