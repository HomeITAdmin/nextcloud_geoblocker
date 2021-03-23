<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\IL10N;
use GeoIp2\Database\Reader;
use MaxMind\Db\Reader\InvalidDatabaseException;
use InvalidArgumentException;
use GeoIp2\Exception\AddressNotFoundException;
use OCP\ILogger;

class DatabaseReaderNotFoundException extends \Exception {
}

class MaxMindGeoLite2 implements
	ILocalizationService,
	IDatabaseDate,
		IDatabaseFileLocation {
	/** @var IL10N */
	private $l;
	/** @var GeoBlockerConfig */
	private $config;
	/** @var ILogger */
	private $logger;
	/** @var String */
	private $database_file_location;
	/** @var String */
	private $unique_service_string;

	public function __construct(GeoBlockerConfig $config, IL10N $l, ILogger $logger) {
		$this->l = $l;
		$this->config = $config;
		$this->logger = $logger;
		$this->unique_service_string = (new \ReflectionClass($this))->getShortName();
		$this->database_file_location = $this->config->getDatabaseFileLocation(
				$this->unique_service_string);
		if ($this->database_file_location == '') {
			$this->database_file_location = '/var/lib/GeoIP/GeoLite2-Country.mmdb';
		}
	}

	public function getStatus(): bool {
		return $this->getCountryCodeFromIP('1.1.1.1') == 'AU';
	}

	public function getStatusString(): string {
		$service_string = '"MaxMind GeoLite2": ';
		try {
			if ($this->getCountryCodeFromIPImpl('1.1.1.1') == 'AU') {
				return $service_string . $this->l->t('OK.');
			} else {
				return $service_string .
					$this->l->t('ERROR: There is an unknown problem with the service.');
			}
		} catch (AddressNotFoundException $e) {
			return $service_string .
				$this->l->t('ERROR: Country cannot be found.');
		} catch (InvalidDatabaseException $e) {
			return $service_string .
				$this->l->t(
						'ERROR: Database is not valid, does not have the correct access rights or is not placed at %s.',
						$this->database_file_location);
		} catch (InvalidArgumentException $e) {
			return $service_string .
				$this->l->t('ERROR: Invalid Argument.');
		} catch (DatabaseReaderNotFoundException $e) {
			return $service_string .
				$this->l->t('ERROR: "geoip2.phar" does not seem to be place correctly or do not have the correct access rights.');
		}
	}

	private function logError(string $log_string): void {
		$this->logger->error('Geoblocker: MaxMindGeoLite2: ' . $log_string, ['app' => 'geoblocker']);
	}
	
	private function getCountryCodeFromIPImpl($ip_address): string {
		if (!@include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '3rdparty'
				. DIRECTORY_SEPARATOR . 'maxmind_geolite2' . DIRECTORY_SEPARATOR . 'geoip2.phar') {
			@include_once \pathinfo($this->database_file_location)['dirname'] . DIRECTORY_SEPARATOR . 'geoip2.phar';
		}
		if (!class_exists('GeoIp2\Database\Reader')) {
			throw new DatabaseReaderNotFoundException('Test');
		}
		$reader = new Reader($this->database_file_location);
		$record = $reader->country($ip_address);
		return $record->country->isoCode;
	}

	public function getCountryCodeFromIP($ip_address): string {
		try {
			return $this->getCountryCodeFromIPImpl($ip_address);
		} catch (AddressNotFoundException $e) {
			$this->logError('Address No Found: ' . $e->getMessage());
			return 'AA';
		} catch (InvalidDatabaseException $e) {
			$this->logError('Invalid Database Exception: ' . $e->getMessage());
			return 'UNAVAILABLE';
		} catch (InvalidArgumentException $e) {
			$this->logError('Invalid Argument Exception: ' . $e->getMessage());
			return 'UNAVAILABLE';
		} catch (DatabaseReaderNotFoundException $e) {
			$this->logError('Database Reader is not available.');
			return 'UNAVAILABLE';
		}
	}

	public function getDatabaseDate(): string {
		$db_file_date = false;
		if (file_exists($this->database_file_location)) {
			$db_file_date = filemtime($this->database_file_location);
		}
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
