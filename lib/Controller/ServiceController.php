<?php

namespace OCA\GeoBlocker\Controller;

use OCP\IRequest;
use OCP\IConfig;
use OCP\IL10N;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class ServiceController extends Controller {
	private $config;
	private $l;
	private $location_service_factory;

	public function __construct(string $AppName, IRequest $request,
			IConfig $config, IL10N $l) {
		parent::__construct($AppName, $request);
		$this->config = new GeoBlockerConfig($config);
		$this->l = $l;
		$this->location_service_factory = new LocalizationServiceFactory(
				$this->config, $this->l);
	}

	/**
	 *
	 * @NoAdminRequired
	 *
	 * @param int $id
	 */
	public function status(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID(
				$id);
		return new DataResponse($location_service->getStatusString());
	}

	public function hasDatabaseDate(int $id) {
		return new DataResponse(
				$this->location_service_factory->hasDatabaseDateByID($id));
	}

	public function getDatabaseDate(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID(
				$id);
		if ($this->hasDatabaseDate($id)) {
			return new DataResponse($location_service->getDatabaseDate());
		} else {
			return new DataResponse($this->l->t("No database date available."));
		}
	}

	public function hasConfigurationOption(int $id) {
		return new DataResponse(
				$this->location_service_factory->hasDatabaseFileLocationByID(
						$id));
	}

	public function hasDatabaseFileLocation(int $id) {
		return new DataResponse(
				$this->location_service_factory->hasDatabaseFileLocationByID(
						$id));
	}

	public function getDatabaseFileLocation(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID(
				$id);
		if ($this->hasDatabaseFileLocation($id)) {
			return new DataResponse(
					$location_service->getDatabaseFileLocation());
		} else {
			return new DataResponse(
					$this->l->t("Database file location not available!"));
		}
	}
	
	public function getUniqueServiceString(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID(
				$id);
		return new DataResponse((new \ReflectionClass($location_service))->getShortName());
// 		return new DataResponse('MaxMindGeoLite2');
	}
}
