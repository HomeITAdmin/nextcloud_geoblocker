<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use OCP\IL10N;

class GeoIPLookup implements ILocalizationService, IDatabaseDate {
	private $cmd_wrapper;
	private $l;

	public function __construct(GeoIPLookupCmdWrapper $cmd_wrapper, IL10N $l) {
		$this->cmd_wrapper = $cmd_wrapper;
		$this->l = $l;
	}

	public function getStatus(): bool {
		$output = [];
		$return_val = 0;
		$return_val2 = 0;
		$location_raw1 = $this->cmd_wrapper->geoiplookup('127.0.0.1', $output,
				$return_val);
		$location_raw2 = $this->cmd_wrapper->geoiplookup6('fe80::', $output,
				$return_val2);
		if ($return_val == 0 && $return_val2 == 0) {
			if (strpos($location_raw1, 'IP Address not found') !== false &&
					strpos($location_raw2, 'IP Address not found') !== false) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getStatusString(): string {
		$service_string = '"Geoiplookup": ';
		if ($this->getStatus() === true) {
			return $service_string . $this->l->t('OK.');
		} else {
			return $service_string .
					$this->l->t(
							'ERROR: Service seem to be not installed on the host of the Nextcloud server or not reachable for the web server or is wrongly configured (is the database for IPv4 and IPv6 available?!). Maybe the use of the php function exec() is disabled in the php.ini.');
		}
	}

	public function getCountryCodeFromIP($ip_address): string {
		$output = [];
		$return_val = 0;
		$location = "";

		if (! $this->getStatus()) {
			return 'UNAVAILABLE';
		}

		if (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			$location_raw = $this->cmd_wrapper->geoiplookup($ip_address, $output,
					$return_val);
		} elseif (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
			$location_raw = $this->cmd_wrapper->geoiplookup6($ip_address,
					$output, $return_val);
		} else {
			return 'INVALID_IP';
		}

		if ($return_val != 0) {
			$location = 'UNAVAILABLE';
		} elseif (strpos($location_raw, 'IP Address not found') !== false) {
			$location = 'AA'; // Country not found
		} else {
			$matches = [];
			foreach ($output as $line) {
				$match = [];
				$count_matches = preg_match('/^GeoIP Country .*Edition: (..),.*/',
					$line, $match);
				if ($count_matches > 0) {
					$matches[] = $match[1];
				}
			}
			if (count($matches) != 1) {
				$location = 'UNAVAILABLE';
			} else {
				$location = $matches[0];
			}
		}
		return $location;
	}

	public function getDatabaseDate(): string {
		$output = [];
		$return_val = 0;
		$date_string = $this->l->t("Date of the database cannot be determined!");

		$this->cmd_wrapper->getFullDateString($output, $return_val);

		if ($return_val == 0) {
			$matches = [];
			foreach ($output as $line) {
				$match = [];
				$count_matches = preg_match(
						'/^GeoIP .*Edition: GEO-.*FREE (\d{8}) Build/', $line,
						$match);
				if ($count_matches > 0) {
					$matches[] = $match[1];
				}
			}
			if (count($matches) > 0) {
				$split = str_split(min($matches), 2);
				$date_string = $split[0] . $split[1] . '-' . $split[2] . '-' .
						$split[3];
			}
		}
		return $date_string;
	}
}
