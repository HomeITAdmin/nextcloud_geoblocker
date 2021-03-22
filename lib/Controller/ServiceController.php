<?php

namespace OCA\GeoBlocker\Controller;

use OCP\IRequest;
use OCP\IConfig;
use OCP\IL10N;
use OCP\IDBConnection;
use OCP\ILogger;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class ServiceController extends Controller {
	/** @var GeoBlockerConfig */
	private $config;
	/** @var IL10N */
	private $l;
	/** @var IDBConnection */
	private $db;
	/** @var ILogger */
	private $logger;
	/** @var LocalizationServiceFactory */
	private $location_service_factory;

	public function __construct(string $AppName, IRequest $request,
			IConfig $config, IL10N $l, IDBConnection $db, ILogger $logger) {
		parent::__construct($AppName, $request);
		$this->config = new GeoBlockerConfig($config);
		$this->l = $l;
		$this->db = $db;
		$this->logger = $logger;
		$this->location_service_factory = new LocalizationServiceFactory(
				$this->config, $this->l, $this->db, $this->logger);
	}

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
		if ($this->location_service_factory->hasDatabaseDateByID($id)) {
			return new DataResponse($location_service->getDatabaseDate());
		} else {
			return new DataResponse($this->l->t("No database date available."));
		}
	}

	public function hasConfigurationOptionImpl(int $id) {
		return $this->location_service_factory->hasDatabaseFileLocationByID($id) ||
				$this->location_service_factory->hasDatabaseUpdateByID($id);
	}

	public function hasConfigurationOption(int $id) {
		return new DataResponse($this->hasConfigurationOptionImpl($id));
	}

	public function hasDatabaseFileLocation(int $id) {
		return new DataResponse(
				$this->location_service_factory->hasDatabaseFileLocationByID($id));
	}

	public function getDatabaseFileLocation(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID(
				$id);
		if ($this->location_service_factory->hasDatabaseFileLocationByID($id)) {
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
		return new DataResponse(
				(new \ReflectionClass($location_service))->getShortName());
	}

	public function hasDatabaseUpdate(int $id) {
		return new DataResponse(
				$this->location_service_factory->hasDatabaseUpdateByID($id));
		;
	}

	public function updateDatabase(int $id) {
		return new DataResponse(
				$this->location_service_factory->updateDatabaseByID($id));
		;
	}

	public function getDatabaseUpdateStatus(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID(
				$id);
		if ($this->location_service_factory->hasDatabaseUpdateByID($id)) {
			return new DataResponse(
					$location_service->getDatabaseUpdateStatus());
		} else {
			return new DataResponse($this->l->t("Update Status not available!"));
		}
	}

	public function getDatabaseUpdateStatusString(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID(
				$id);
		if ($this->location_service_factory->hasDatabaseUpdateByID($id)) {
			return new DataResponse(
					$location_service->getDatabaseUpdateStatusString());
		} else {
			return new DataResponse($this->l->t("Update Status not available!"));
		}
	}

	public function getAllServiceData(int $id) {
		$location_service = $this->location_service_factory->getLocationServiceByID($id);
		$ret = [];
		$ret['status'] = $location_service->getStatusString();
		$ret['hasDatabaseDate'] = $this->location_service_factory->hasDatabaseDateByID($id);
		if ($ret['hasDatabaseDate']) {
			$ret['getDatabaseDate'] = $location_service->getDatabaseDate();
		}
		$ret['hasConfigurationOption'] = $this->hasConfigurationOptionImpl($id);
		if ($ret['hasConfigurationOption']) {
			$ret['hasDatabaseFileLocation'] = $this->location_service_factory->hasDatabaseFileLocationByID($id);
			if ($ret['hasDatabaseFileLocation']) {
				$ret['getDatabaseFileLocation'] = $location_service->getDatabaseFileLocation();
			}
			$ret['hasDatabaseUpdate'] = $this->location_service_factory->hasDatabaseUpdateByID($id);
			if ($ret['hasDatabaseUpdate']) {
				$ret['getDatabaseUpdateStatus'] = $location_service->getDatabaseUpdateStatus();
				$ret['getDatabaseUpdateStatusString'] = $location_service->getDatabaseUpdateStatusString();
			}
		}
		return new JSONResponse($ret);
	}
}
