<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\GeoBlocker;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\ILogger;
use OCP\IL10N;
use OCA\GeoBlocker\LocalizationServices\ILocalizationService;

class GeoBlocker {
	private $user;
	private $logger;
	private $config;
	private $l;
	private $location_service;
	public function __construct(String $user, ILogger $logger,
			GeoBlockerConfig $config, IL10N $l,
			ILocalizationService $location_service) {
		$this->user = $user;
		$this->logger = $logger;
		$this->config = $config;
		$this->l = $l;
		$this->location_service = $location_service;
	}
	public function check(String $ip_address): void {
		// TODO: How can I be sure, that the localization service is using the same country list then I do?
		if (! $this->isIPAdressLocal ( $ip_address )) {

			$location = $this->location_service->getCountryCodeFromIP ( 
					$ip_address );

			$log_user = $this->config->getLogWithUserName () ? $this->user : 'NOT_SHOWN_IN_LOG';
			$log_location = $this->config->getLogWithCountryCode () ? $location : 'NOT_SHOWN_IN_LOG';
			$log_address = $this->config->getLogWithIpAddress () ? $ip_address : 'NOT_SHOWN_IN_LOG';

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
						'The login of user "%s" with IP address "%s" could not be checked due to problems with location service.',
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
	private function isIPAdressLocal(String $ip_address): bool {
		// TODO: Is this exactly what I want?
		if (filter_var ( $ip_address, FILTER_VALIDATE_IP )) {
			if (filter_var ( $ip_address, FILTER_VALIDATE_IP,
					FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE )) {
				return FALSE;
			} else {
				return TRUE;
			}
		} else  {
			return FALSE;
		}
	}
}
