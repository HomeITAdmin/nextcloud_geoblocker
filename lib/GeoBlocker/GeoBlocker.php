<?php

namespace OCA\GeoBlocker\GeoBlocker;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCP\ILogger;
use OCP\IL10N;

class GeoBlocker {
	private $user;
	private $ip_address;
	private $logger;
	private $config;
	private $l;
	public function __construct(String $user, String $ip_address, ILogger $logger,
			GeoBlockerConfig $config, IL10N $l) {
		$this->user = $user;
		$this->ip_address = $ip_address;
		$this->logger = $logger;
		$this->config = $config;
		$this->l = $l;
	}
	public function check() {
		// TODO: Create depending on the configurated service the right service
		// TODO: Wrong configuration of Nextcloud in Container can lead to that all access come from local container IP.
		if (! $this->isIPAdressLocal ()) {
			$location_service = new GeoIPLookup ();

			$location = $location_service->getCountryCodeFromIP ( 
					$this->ip_address );

			$log_user = $this->config->getLogWithUserName () ? $this->user : 'NOT_SHOWN_IN_LOG';
			$log_location = $this->config->getLogWithCountryCode () ? $location : 'NOT_SHOWN_IN_LOG';
			$log_address = $this->config->getLogWithIpAddress () ? $this->ip_address : 'NOT_SHOWN_IN_LOG';

			if ($location !== 'INVALID_IP' && $location !== 'UNAVAILABLE') {
				if ($this->config->isCountryCodeInListOfChoosenCountries ( 
						$location ) xor $this->config->getUseWhiteListing ()) {
					$log_string = $this->l->t ( 
							'The user "%s" logged in with IP address "%s" from blocked country "%s".',
							array ($log_user,$log_address,$log_location
							) );
					$this->logger->warning ( $log_string,
							array ('app' => 'geoblocker'
							) );
				}
			} elseif ($location === 'UNAVAILABLE') {
				$log_string = $this->l->t ( 
						'The login of user "%s" with IP address "%s" could not be checked due to problems with location serverive.',
						array ($log_user,$log_address
						) );
				$this->logger->warning ( $log_string,
						array ('app' => 'geoblocker'
						) );
			} elseif ($location === 'INVALID_IP') {
				$log_string = $this->l->t ( 
						'The user "%s" logged in with an invalid IP address "%s".',
						array ($log_user,$log_address
						) );
				$this->logger->warning ( $log_string,
						array ('app' => 'geoblocker'
						) );
			} else {
				$this->logger->error ( 
						"This shouldn't have happen. This line should never be reached.",
						array ('app' => 'geoblocker'
						) );
			}
		}
	}
	private function isIPAdressLocal(): bool {
		//TODO: Is this exactly what I want?
		if (filter_var ( $this->ip_address, FILTER_VALIDATE_IP,
				FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE )) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
