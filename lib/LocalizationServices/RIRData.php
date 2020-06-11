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

abstract class RIRStatus {
	public const kDbNotInitialized = 0;
	public const kDbInitilazing = 1;
	public const kDbError = 2;
	public const kDbOk = 3;
	public const kDbUpdating = 4;
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
		if ($this->getStatusId() == RIRStatus::kDbOk && $this->checkGMP()) {
			return true;
		}
		return false;
	}

	public function getStatusString(): string {
		$service_string = '"RIR Data": ';
		$service_string_error = $service_string . $this->l->t('ERROR: ');
		$status_id = $this->getStatusId();

		if ($status_id == RIRStatus::kDbOk) {
			if ($this->checkGMP()) {
				return $service_string . $this->l->t('OK.');
			} else {
				return $service_string_error .
						$this->l->t('PHP GMP Extension needs to be installed.');
			}
		} elseif ($status_id == RIRStatus::kDbNotInitialized) {
			return $service_string_error .
					$this->l->t(
							'The database is not initialized. Please run update.');
		} elseif ($status_id == RIRStatus::kDbInitilazing) {
			return $service_string_error .
					$this->l->t(
							'The database is currently initializing. Please wait until update is finished. This may take several minutes.');
		} elseif ($status_id == RIRStatus::kDbError) {
			return $service_string_error .
					$this->l->t(
							'The database is corrupted. Please run update again.');
		} elseif ($status_id == RIRStatus::kDbUpdating) {
			return $service_string_error .
					$this->l->t(
							'The database is currently updating. Please wait until update is finished. This may take several minutes.');
		}
		return $service_string . $this->l->t('ERROR: Something is missing.');
	}

	public function getCountryCodeFromIP(string $ip_address): string {
		if (! $this->getStatus()) {
			return 'UNAVAILABLE';
		}

		if (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			$cc = $this->rir_service_mapper->getCountryCodeFromIpv4(
					RIRServiceMapper::ipv4String2Int64($ip_address));
			return $cc;
		} elseif (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
			$cc = $this->rir_service_mapper->getCountryCodeFromIpv6(
					RIRServiceMapper::ipv6String2Int64($ip_address));
			return $cc;
		} else {
			return 'INVALID_IP';
		}
	}

	public function getDatabaseDate(): string {
		$db_date = $this->getDatabaseDateImpl();
		if ($db_date == '') {
			$status_id = $this->getStatusId();
			if ($status_id == RIRStatus::kDbOk) {
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
					$this->setStatusId(RIRStatus::kDbError);
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
			$this->setStatusId(RIRStatus::kDbError);
			return false;
		} else {
			$this->resetDatabaseDateImpl();
			return true;
		}
	}

	private function checkAllowURLFOpen(): bool {
		return ini_get('allow_url_fopen') === '1';
	}

	private function checkGMP(): bool {
		return function_exists('gmp_import') && function_exists('gmp_intval');
	}

	public function updateDatabase(): bool {
		// TODO: Availability of the service during Update
		$status_id = $this->getStatusId();

		if ($status_id == RIRStatus::kDbNotInitialized ||
				$status_id == RIRStatus::kDbError) {
			$this->setStatusId(RIRStatus::kDbInitilazing);
			if (! $this->eraseDatabase()) {
				return false;
			}
			if (! $this->fillDatabase()) {
				return false;
			}
			$this->setStatusId(RIRStatus::kDbOk);
			return true;
		} elseif ($status_id == RIRStatus::kDbOk) {
			$this->setStatusId(RIRStatus::kDbUpdating);
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
			$this->setStatusId(RIRStatus::kDbOk);
			return true;
		}
		return false;
	}

	public function getDatabaseUpdateStatus(): int {
		if ($this->checkAllowURLFOpen() && $this->checkGMP()) {
			$status_id = $this->getStatusId();
			if ($status_id == RIRStatus::kDbInitilazing ||
					$status_id == RIRStatus::kDbUpdating) {
				return LocationServiceUpdateStatus::kUpdating;
			} else {
				return LocationServiceUpdateStatus::kUpdatePossible;
			}
		} else {
			return LocationServiceUpdateStatus::kUpdateNotPossible;
		}
	}

	public function getDatabaseUpdateStatusString(): string {
		switch ($this->getDatabaseUpdateStatus()) {
			case LocationServiceUpdateStatus::kUpdateNotPossible:
				if (! $this->checkAllowURLFOpen()) {
					return $this->l->t(
							'"allow_url_fopen" needs to be allowed in php.ini.');
				}
				if (! $this->checkGMP()) {
					return $this->l->t(
							'PHP GMP Extension needs to be installed.');
				}
				break;
			case LocationServiceUpdateStatus::kUpdatePossible:
				return '';
				break;
			case LocationServiceUpdateStatus::kUpdating:
				return '';
				break;
			default:
				return $this->l->t(
						'Update in undefined state. Please complain to the developer.');
				break;
		}
	}
}
