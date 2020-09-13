<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

@include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
		DIRECTORY_SEPARATOR . '3rdparty' . DIRECTORY_SEPARATOR .
		'maxmind_geolite2' . DIRECTORY_SEPARATOR . '' . 'geoip2.phar';

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\IL10N;
use GeoIp2\Database\Reader;
use MaxMind\Db\Reader\InvalidDatabaseException;
use InvalidArgumentException;
use GeoIp2\Exception\AddressNotFoundException;

class MaxMindGeoLite2 implements ILocalizationService, IDatabaseDate,
		IDatabaseFileLocation {
	private $l;
	private $config;
	private $database_file_location;
	private $unique_service_string;

	public function __construct(GeoBlockerConfig $config, IL10N $l) {
		$this->l = $l;
		$this->config = $config;
		$this->unique_service_string = (new \ReflectionClass($this))->getShortName();
		$this->database_file_location = $this->config->getDatabaseFileLocation(
				$this->unique_service_string);
		if ($this->database_file_location == '')
			$this->database_file_location = '/var/lib/GeoIP/GeoLite2-Country.mmdb';
	}

	public function getStatus(): bool {
		if (class_exists('GeoIp2\Database\Reader')) {
			try {
				$reader = new Reader($this->database_file_location);
			} catch (InvalidDatabaseException | InvalidArgumentException $e) {
				return FALSE;
			}

			try {
				$reader->country('1.1.1.1');
			} catch (AddressNotFoundException $e) {
				return FALSE;
			}
			return TRUE;
		}
		return FALSE;
	}

	public function getStatusString(): string {
		$service_string = '"MaxMind GeoLite2": ';
		if ($this->getStatus()) {
			return $service_string . $this->l->t('OK.');
		}
		return $service_string .
				$this->l->t(
						'ERROR: Service does not seem to be installed correctly or database is not available at %s.',
						$this->database_file_location);
	}

	public function getCountryCodeFromIP($ip_address): string {
		if ($this->getStatus()) {
			try {
				$reader = new Reader($this->database_file_location);
				try {
					$record = $reader->country($ip_address);
				} catch (AddressNotFoundException $e) {
					return 'AA';
				}
				return $record->country->isoCode;
			} catch (InvalidDatabaseException | InvalidArgumentException $e) {
				return 'UNAVAILABLE';
			}
		} else {
			return 'UNAVAILABLE';
		}
	}

	public function getDatabaseDate(): string {
		$db_file_date = filemtime($this->database_file_location);
		if ($db_file_date == null || $db_file_date === false) {
			return $this->l->t('Date of the database cannot be determined!');
		} else {
			return date('Y-m-d', $db_file_date);
		}
	}

	public function getDatabaseFileLocation(): string {
		return $this->database_file_location;
	}

	public function setDatabaseFileLocation(string $database_file_location) {
		$this->database_file_location = $database_file_location;
		$this->config->setDatabaseFileLocation($database_file_location,
				$this->unique_service_string);
	}
}