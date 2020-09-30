<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use Exception;
use OCP\IL10N;
use OCA\GeoBlocker\Db\RIRServiceMapper;
use OCA\GeoBlocker\Db\RIRServiceDBEntity;
use OCA\GeoBlocker\Config\GeoBlockerConfig;

class RIRData implements ILocalizationService, IDatabaseDate, IDatabaseUpdate {
	private $l;
	private $rir_service_mapper;
	private $rir_data_checks;
	private $service_name = 'rir_data';
	private $config;
	private $rir_ftps = array(
		'ripencc' => 'ftp://ftp.ripe.net/pub/stats/ripencc/delegated-ripencc-latest',
		'arin' => 'ftp://ftp.arin.net/pub/stats/arin/delegated-arin-extended-latest',
		'afrinic' => 'ftp://ftp.afrinic.net/pub/stats/afrinic/delegated-afrinic-latest',
		'apnic' => 'ftp://ftp.apnic.net/pub/stats/apnic/delegated-apnic-latest',
		'lacnic' => 'ftp://ftp.lacnic.net/pub/stats/lacnic/delegated-lacnic-latest');
	public const kServiceStatusName = 'rir_data_service_status';
	public const kDatabaseDateName = 'rir_data_db_date';
	public const kErrorMessageName = 'rir_data_error_message';

	public function __construct(RIRDataChecks $rir_data_checks,
			RIRServiceMapper $rir_service_mapper, GeoBlockerConfig $config,
			IL10N $l) {
		$this->rir_data_checks = $rir_data_checks;
		$this->l = $l;
		$this->rir_service_mapper = $rir_service_mapper;
		$this->config = $config;
	}

	private function getStatusId(): int {
		return intval(
				$this->config->getServiceSpecificConfigValue(
						RIRData::kServiceStatusName, '0'));
	}

	private function setStatusId(int $id) {
		$this->config->setServiceSpecificConfigValue(
				RIRData::kServiceStatusName, strval($id));
	}

	private function getDatabaseDateImpl(): string {
		return $this->config->getServiceSpecificConfigValue(
				RIRData::kDatabaseDateName, '');
	}

	private function setDatabaseDateImpl() {
		$this->config->setServiceSpecificConfigValue(RIRData::kDatabaseDateName,
				date("Y-m-d"));
	}

	private function resetDatabaseDateImpl() {
		$this->config->setServiceSpecificConfigValue(RIRData::kDatabaseDateName,
				'');
	}

	private function getErrorMessage(): string {
		return $this->config->getServiceSpecificConfigValue(
				RIRData::kErrorMessageName, '');
	}

	private function setErrorMessage(string $error_message) {
		$this->config->setServiceSpecificConfigValue(RIRData::kErrorMessageName,
				$error_message);
	}

	private function checkDBPlausibleAndSetToError(): bool {
		if ($this->rir_service_mapper->getNumberOfEntries() > 0) {
			return true;
		} else {
			$this->setDBToErrorStatus(
					$this->l->t(
							'No entries in the database. Please run update.'));
			return false;
		}
	}

	public function getStatus(): bool {
		if ($this->getStatusId() == RIRStatus::kDbOk &&
				$this->rir_data_checks->checkGMP() &&
				$this->checkDBPlausibleAndSetToError()) {
			return true;
		}
		return false;
	}

	public function getStatusString(): string {
		$service_string = '"RIR Data":';
		$service_string_error = $service_string . ' ' . $this->l->t('ERROR:');
		$status_id = $this->getStatusId();

		if ($status_id == RIRStatus::kDbOk &&
				! $this->checkDBPlausibleAndSetToError()) {
			$status_id = RIRStatus::kDbError;
		}

		if ($status_id == RIRStatus::kDbOk) {
			if ($this->rir_data_checks->checkGMP()) {
				return $service_string . ' ' . $this->l->t('OK.');
			} else {
				return $service_string_error . ' ' .
						$this->l->t('PHP GMP Extension needs to be installed.');
			}
		} elseif ($status_id == RIRStatus::kDbNotInitialized) {
			return $service_string_error . ' ' .
					$this->l->t(
							'The database is not initialized. Please run update.');
		} elseif ($status_id == RIRStatus::kDbInitilazing) {
			return $service_string_error . ' ' .
					$this->l->t(
							'The database is currently initializing. Please wait until update is finished. This may take several minutes.');
		} elseif ($status_id == RIRStatus::kDbError) {
			return $service_string_error . ' ' .
					$this->l->t(
							'The database is corrupted. Please run update again.') .
					' ' . $this->l->t('Last error message:') . ' ' .
					$this->getErrorMessage();
		} elseif ($status_id == RIRStatus::kDbUpdating) {
			return $service_string_error . ' ' .
					$this->l->t(
							'The database is currently updating. Please wait until update is finished. This may take several minutes.');
		}
		return $service_string_error . ' ' .
				$this->l->t('Something is missing.');
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
		$status_id = $this->getStatusId();
		$db_date = $this->getDatabaseDateImpl();		
		if ($db_date == '') {
			if ($status_id == RIRStatus::kDbOk) {
				return $this->l->t('Date of the database cannot be determined!');
			} else {
				return $this->l->t('No database available!');
			}
		} else {
			if ($status_id == RIRStatus::kDbOk &&
					$this->rir_service_mapper->getNumberOfEntries() > 0) {
				return $db_date;
			} else {
				return $this->l->t('No database available!');
			}
		}
		return $this->l->t('No database available!');
	}

	private function setDBToErrorStatus(string $error_message) {
		$this->setStatusId(RIRStatus::kDbError);
		$this->setErrorMessage($error_message);
		$this->resetDatabaseDateImpl();
	}

	private function fillDatabase(): bool {
		foreach ($this->rir_ftps as $rir_name => $rir_url) {
			$rir_data_handle = fopen($rir_url, 'r');
			if ($rir_data_handle != FALSE) {
				try {
					$at_least_one_entry = false;
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
								$db_entry->setVersion(0);
								$this->rir_service_mapper->insert($db_entry);
								$at_least_one_entry = true;
							} elseif ($parts[2] == 'ipv6' && $parts[1] != '') {
								$db_entry = new RIRServiceDBEntity();
								$db_entry->setBeginIpRange(
										RIRServiceMapper::ipv6String2Int64(
												$parts[3]));
								$db_entry->setCountryCode($parts[1]);
								$db_entry->setLengthIpRange(
										pow(2, 64 - intval($parts[4])));
								$db_entry->setIsIpV6(true);
								$db_entry->setVersion(0);
								$this->rir_service_mapper->insert($db_entry);
								$at_least_one_entry = true;
							}
						}
					}
					if (! $at_least_one_entry) {
						$this->setDBToErrorStatus(
								$this->l->t(
										'RIR seems to have changed the file format.'));
						return false;
					}
				} catch (Exception $e) {
					$this->setDBToErrorStatus(
							$this->l->t('Exception caught during Update.'));
					return false;
				} finally {
					fclose($rir_data_handle);
				}
			} else {
				$this->setDBToErrorStatus(
						$this->l->t(
								'Invalid file handle. Probably the internet connection got lost during the update.'));
				return false;
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

	public function updateDatabase(): bool {
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
			if (! $this->eraseDatabase()) {
				return false;
			}
			if (! $this->fillDatabase()) {
				return false;
			}
			$this->setStatusId(RIRStatus::kDbOk);
			return true;
		}
		return false;
	}

	public function getDatabaseUpdateStatus(): int {
		$status_id = $this->getStatusId();
		if ($status_id == RIRStatus::kDbInitilazing ||
				$status_id == RIRStatus::kDbUpdating) {
			return LocationServiceUpdateStatus::kUpdating;
		} else {
			if ($this->rir_data_checks->checkAll()) {
				return LocationServiceUpdateStatus::kUpdatePossible;
			} else {
				return LocationServiceUpdateStatus::kUpdateNotPossible;
			}
		}
	}

	public function getDatabaseUpdateStatusString(): string {
		switch ($this->getDatabaseUpdateStatus()) {
			case LocationServiceUpdateStatus::kUpdateNotPossible:
				if (! $this->rir_data_checks->checkAllowURLFOpen()) {
					return $this->l->t(
							'"allow_url_fopen" needs to be allowed in php.ini.');
				}
				if (! $this->rir_data_checks->checkGMP()) {
					return $this->l->t(
							'PHP GMP Extension needs to be installed.');
				}
				if (! $this->rir_data_checks->checkInternetConnection()) {
					return $this->l->t(
							'Internet connection needs to be available.');
				}
				break;
			case LocationServiceUpdateStatus::kUpdatePossible:
				return '';
				break;
			case LocationServiceUpdateStatus::kUpdating:
				return $this->l->t('Current number of entries:') . ' ' .
						strval($this->rir_service_mapper->getNumberOfEntries());
				break;
			default:
				return $this->l->t(
						'Update in undefined state. Please complain to the developer.');
				break;
		}
	}

	public function resetDatabase(): bool {
		if (! $this->eraseDatabase()) {
			return false;
		}
		$this->setStatusId(RIRStatus::kDbNotInitialized);
		return true;
	}
}
