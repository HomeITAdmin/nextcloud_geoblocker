<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use OCP\IL10N;
use OCP\IDbConnection;
// use OCA\GeoBlocker\Db\ServiceMapper;
use OCA\GeoBlocker\Db\RIRServiceMapper;
use OCA\GeoBlocker\Db\RIRServiceDBEntity;
use OCA\GeoBlocker\Config\GeoBlockerConfig;
use Exception;

// use OCA\GeoBlocker\Db\RIRServiceDBEntity;
abstract class RIRStatus {
	const DB_Not_Initialized = 0;
	const DB_Initilazing = 1;
	const DB_Error = 2;
	const DB_OK = 3;
	const DB_Updating = 4;
}
class RIRData implements ILocalizationService, IDatabaseDate, IDatabaseUpdate {
	private $l;
	private $rir_service_mapper;
	private $db;
	private $service_name = 'rir_data';
	private $config;
	private $rir_ftps = array(
		'ripencc' => 'ftp://ftp.ripe.net/pub/stats/ripencc/delegated-ripencc-latest',
		'arin' => 'ftp://ftp.arin.net/pub/stats/arin/delegated-arin-extended-latest',
		'afrinic' => 'ftp://ftp.afrinic.net/pub/stats/afrinic/delegated-afrinic-latest',
		'apnic' => 'ftp://ftp.apnic.net/pub/stats/apnic/delegated-apnic-latest',
		'lacnic' => 'ftp://ftp.lacnic.net/pub/stats/lacnic/delegated-lacnic-latest');

	// TODO: Change order
	public function __construct(IL10N $l, IDbConnection $db,
			GeoBlockerConfig $config) {
		$this->l = $l;
		$this->db = $db;
		$this->rir_service_mapper = new RIRServiceMapper($db);
		$this->config = $config;
	}

	private function getStatusId(): int {
		// TODO: Typo in name
		return intval(
				$this->config->config->getAppValue('geoblocker',
						'rir_datat_service_status', '0'));
	}

	private function setStatusId(int $id) {
		// TODO: Typo in name
		$this->config->config->setAppValue('geoblocker',
				'rir_datat_service_status', $id);
	}

	private function getDatabaseDateImpl(): string {
		return $this->config->config->getAppValue('geoblocker',
				'rir_data_db_date', '');
	}

	private function setDatabaseDateImpl() {
		$this->config->config->setAppValue('geoblocker', 'rir_data_db_date',
				date("Y-m-d"));
	}

	private function resetDatabaseDateImpl() {
		$this->config->config->setAppValue('geoblocker', 'rir_data_db_date', '');
	}

	public function getStatus(): bool {
		if ($this->getStatusId() == RIRStatus::DB_OK) {
			return true;
		}
		return false;
	}

	public function getStatusString(): string {
		$service_string = '"RIR Data": ';
		$status_id = $this->getStatusId();

		if ($status_id == RIRStatus::DB_OK) {
			return $service_string . $this->l->t('OK.');
		} elseif ($status_id == RIRStatus::DB_Not_Initialized) {
			return $service_string .
					$this->l->t(
							'ERROR: The database is not initialized. Please run update.');
		} elseif ($status_id == RIRStatus::DB_Initilazing) {
			return $service_string .
					$this->l->t(
							'ERROR: The database is currently initializing. Please wait until update is finished. This may take several minutes.');
		} elseif ($status_id == RIRStatus::DB_Error) {
			return $service_string .
					$this->l->t(
							'ERROR: The database is corrupted. Please run update again.');
		} elseif ($status_id == RIRStatus::DB_Updating) {
			return $service_string .
					$this->l->t(
							'ERROR: The database is currently updating. Please wait until update is finished. This may take several minutes.');
		}
		return $service_string . $this->l->t('ERROR: Something is missing.');
	}

	public function getCountryCodeFromIP($ip_address): string {
		if (! $this->getStatus()) {
			return 'UNAVAILABLE';
		}

		if (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			$db_entry = $this->rir_service_mapper->getCountryCodeFromIpv4(
					RIRServiceMapper::ipv4String2Int64($ip_address));
			return $db_entry->getCountryCode();
		} elseif (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
			$db_entry = $this->rir_service_mapper->getCountryCodeFromIpv6(
					RIRServiceMapper::ipv6String2Int64($ip_address));
			return $db_entry->getCountryCode();
		} else {
			return 'INVALID_IP';
		}
	}

	public function getDatabaseDate(): string {
		$db_date = $this->getDatabaseDateImpl();
		if ($db_date == '') {
			$status_id = $this->getStatusId();
			if ($status_id == RIRStatus::DB_OK) {
				return $this->l->t('Date of the database cannot be determined!');
			} else {
				return $this->l->t('No database available!');
			}
		}
		return $db_date;
	}

	private function fillDatabase(): bool {
		foreach ($this->rir_ftps as $rir_name => $rir_url) {
			$rir_data_handle = fopen($rir_url, 'r');
			if ($rir_data_handle != FALSE) {
				try {
					while (($line = fgets($rir_data_handle))) {
						$parts = explode('|', $line);
						if ($parts[0] == $rir_name && count($parts) >= 7) {
							if ($parts[2] == 'ipv4' && $parts[1] != '') {
								$db_entry = new RIRServiceDBEntity();
								$db_entry->setBeginIpRange(
										RIRServiceMapper::ipv4String2Int64(
												$parts[3]));
								$db_entry->setCountryCode($parts[1]);
								$db_entry->setLengthIpRange($parts[4]);
								$db_entry->setIsIpV6(false);
								$this->rir_service_mapper->insert($db_entry);
							} elseif ($parts[2] == 'ipv6' && $parts[1] != '') {
								$db_entry = new RIRServiceDBEntity();
								$db_entry->setBeginIpRange(
										RIRServiceMapper::ipv6String2Int64(
												$parts[3]));
								$db_entry->setCountryCode($parts[1]);
								$db_entry->setLengthIpRange(
										pow(2, 64 - intval($parts[4])));
								$db_entry->setIsIpV6(true);
								$this->rir_service_mapper->insert($db_entry);
							}
						}
					}
				} catch (Exception $e) {
					$this->setStatusId(RIRStatus::DB_Error);
					return false;
				} finally {
					fclose($rir_data_handle);
				}
			}
		}
		$this->setDatabaseDateImpl();
		return true;
	}

	private function eraseDatabase() {
		if (! $this->rir_service_mapper->eraseAllDatabaseEntries()) {
			$this->setStatusId(RIRStatus::DB_Error);
			return false;
		} else {
			$this->resetDatabaseDateImpl();
			return true;
		}
	}

	private function checkAllowURLFOpen() {
		return ini_get('allow_url_fopen');
	}

	private function checkGMP() {
		if (function_exists('gmp_import') && function_exists('gmp_intval')) {
			return true;
		}
		return false;
	}

	public function updateDatabase(): bool {
		error_log('Enter updateDatabase');
		$status_id = $this->getStatusId();

		error_log('Status: ' . strval($status_id));

		// $this->eraseDatabase();
		// $this->setStatusId(RIRStatus::DB_Not_Initialized);
		// return false;

		// error_log('URL: ' . strval($this->checkAllowURLFOpen()));
		// error_log('GMP: ' . strval($this->checkGMP()));

		// return false;

		if ($status_id == RIRStatus::DB_Not_Initialized ||
				$status_id == RIRStatus::DB_Error) {
			$this->setStatusId(RIRStatus::DB_Initilazing);
			if (! $this->eraseDatabase()) {
				return false;
			}
			if (! $this->fillDatabase()) {
				return false;
			}
			$this->setStatusId(RIRStatus::DB_OK);
			return true;
		} elseif ($status_id == RIRStatus::DB_OK) {
			$this->setStatusId(RIRStatus::DB_Updating);
			error_log('Erasing the database!');
			if (! $this->eraseDatabase()) {
				error_log('Error during erasing the database!');
				return false;
			}
			error_log('Filling the database!');
			if (! $this->fillDatabase()) {
				error_log('Error during filling the database!');
				return false;
			}
			$this->setStatusId(RIRStatus::DB_OK);
			return true;
		}
		return false;
	}
}
