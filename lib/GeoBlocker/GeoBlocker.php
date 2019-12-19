<?php

namespace OCA\GeoBlocker\GeoBlocker;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCP\ILogger;
use OCP\IL10N;

class GeoBlocker {
	private $user;
	private $address;
	private $logger;
	private $config;
	private $l;
	public function __construct(String $user, String $address, ILogger $logger,
			GeoBlockerConfig $config, IL10N $l) {
		$this->user = $user;
		$this->address = $address;
		$this->logger = $logger;
		$this->config = $config;
		$this->l = $l;
	}
	public function check() {
		// TODO: Create depending on the configurated service the right service
		// TODO: Do special treatment for internal IP Adresses?
		$location_service = new GeoIPLookup ();

		$location = $location_service->getCountryCodeFromIP ( $this->address );

		if ($location !== "INVALID") {
			// TODO: Check if blocked country
			if ($this->config->isCountryCodeInListOfChoosenCountries ( 
					$location ) xor $this->config->getUseWhiteListing ()) {
				$log_user = $this->config->getLogWithUserName () ? $this->user : 'NOT_SHOWN_IN_LOG';
				$log_location = $this->config->getLogWithCountryCode () ? $location : 'NOT_SHOWN_IN_LOG';
				$log_address = $this->config->getLogWithIpAddress () ? $this->address : 'NOT_SHOWN_IN_LOG';

				$log_string = $this->l->t ( 
						'The user "%s" logged in with IP address "%s" from blocked country "%s".',
						array ($log_user,$log_address,$log_location
						) );
				$this->logger->warning ( $log_string,
						array ('app' => 'geoblocker'
						) );
			}
		} else {
			$this->logger->warning ( 
					"Login of user could not be checked due to problems with the location service.",
					array ('app' => 'geoblocker'
					) );
		}
	}
}