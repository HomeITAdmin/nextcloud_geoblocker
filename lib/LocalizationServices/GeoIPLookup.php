<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

class GeoIPLookup implements ILocalizationService {
	private $cmd_wrapper;
	public function __construct(GeoIPLookupCmdWrapper $cmd_wrapper) {
		$this->cmd_wrapper = $cmd_wrapper;
	}
	public function getStatus(): bool {
		$output = array();
		$return_val = 0;
		$return_val2 = 0;
		$location_raw1 = $this->cmd_wrapper->geoiplookup ( '127.0.0.1', $output,
				$return_val );
		$location_raw2 = $this->cmd_wrapper->geoiplookup6 ( 'fe80::', $output,
				$return_val2 );
		if ($return_val == 0 && $return_val2 == 0) {
			if ((strpos ( $location_raw1, 'IP Address not found' ) !== FALSE) &&
					(strpos ( $location_raw2, 'IP Address not found' ) !== FALSE)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	public function getStatusString(): string {
		if ($this->getStatus () === TRUE) {
			return 'OK.  (Please make sure the databases are up to date. This is currently not checked here.)';
		} else {
			return 'ERROR: "geoiplookup" seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini.';
		}
	}
	public function getCountryCodeFromIP($ip_address): string {
		$output = array();
		$return_val = 0;
		$location = "";

		if (! $this->getStatus ()) {
			return 'UNAVAILABLE';
		}

		if (filter_var ( $ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )) {
			$location_raw = $this->cmd_wrapper->geoiplookup ( $ip_address,
					$output, $return_val );
		} else if (filter_var ( $ip_address, FILTER_VALIDATE_IP,
				FILTER_FLAG_IPV6 )) {
			$location_raw = $this->cmd_wrapper->geoiplookup6 ( $ip_address,
					$output, $return_val );
		} else {
			return 'INVALID_IP';
		}

		if ($return_val != 0) {
			$location = 'UNAVAILABLE';
		} else if (strpos ( $location_raw, 'IP Address not found' ) !== FALSE) {
			$location = 'AA'; // Country not found
		} else {
			$matches = ARRAY ();
			preg_match ( '/^GeoIP .*Edition: (..),.*/', $location_raw, $matches );
			if ($matches [1] === "") {
				$location = 'INVALID';
			} else {
				$location = $matches [1];
			}
		}
		return $location;
	}
}