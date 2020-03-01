<?php

namespace OCA\GeoBlocker\Controller;

use OCP\IRequest;
use OCP\IConfig;
use OCP\IL10N;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookupCmdWrapper;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;

class ServiceController extends Controller {
	private $config;
	private $l;
	public function __construct(string $AppName, IRequest $request,
			IConfig $config, IL10N $l) {
		parent::__construct ( $AppName, $request );
		$this->config = new GeoBlockerConfig ( $config );
		$this->l = $l;
	}

	/**
	 *
	 * @NoAdminRequired
	 * 
	 * @param int $id
	 */
	public function status(int $id) {
		switch ($id) {
			case '0' :
				$location_service = new GeoIPLookup ( 
						new GeoIPLookupCmdWrapper (), $this->l );
				break;
			case '1' :
				$location_service = new MaxMindGeoLite2 ( $this->l );
				break;
			default :
				$location_service = new GeoIPLookup ( 
						new GeoIPLookupCmdWrapper (), $this->l );
		}
		return new DataResponse ( $location_service->getStatusString () );
	}
}