<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use Exception;
use OCP\IL10N;
use OCP\ILogger;
use OCA\GeoBlocker\Db\RIRServiceMapper;
use OCA\GeoBlocker\Db\RIRServiceDBEntity;
use OCA\GeoBlocker\Config\GeoBlockerConfig;

class RIRData implements ILocalizationService, IDatabaseDate, IDatabaseUpdate {
	private $l;
	/** @var RIRServiceMapper */
	private $rir_service_mapper;
	private $rir_data_checks;
	private $service_name = 'rir_data';
	/** @var GeoBlockerConfig */
	private $config;
	/** @var ILogger */
	private $logger;

	private $rir_ftps = [
		'ripencc' => 'https://ftp.ripe.net/pub/stats/ripencc/delegated-ripencc-latest',
		'arin' => 'https://ftp.arin.net/pub/stats/arin/delegated-arin-extended-latest',
		'afrinic' => 'https://ftp.afrinic.net/pub/stats/afrinic/delegated-afrinic-latest',
		'apnic' => 'https://ftp.apnic.net/stats/apnic/delegated-apnic-latest',
		'lacnic' => 'https://ftp.lacnic.net/pub/stats/lacnic/delegated-lacnic-latest'];
	public const kServiceStatusName = 'rir_data_service_status';
	public const kDatabaseDateName = 'rir_data_db_date';
	public const kErrorMessageName = 'rir_data_error_message';
	public const kDbVersionName = 'rir_data_db_version';

	public function __construct(RIRDataChecks $rir_data_checks,
			RIRServiceMapper $rir_service_mapper, GeoBlockerConfig $config,
			IL10N $l, ILogger $logger) {
		$this->rir_data_checks = $rir_data_checks;
		$this->l = $l;
		$this->rir_service_mapper = $rir_service_mapper;
		$this->config = $config;
		$this->logger = $logger;
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

	private function getCurrentDbVersion():int {
		return intval($this->config->getServiceSpecificConfigValue(RIRData::kDbVersionName, '0'));
	}

	private function getOtherDbVersion():int {
		return (intval($this->config->getServiceSpecificConfigValue(RIRData::kDbVersionName, '0')) + 1) % 2;
	}

	private function setCurrentDbVersion(int $version) {
		$this->config->setServiceSpecificConfigValue(RIRData::kDbVersionName, strval($version));
	}

	private function checkDBPlausibleAndSetToError(): bool {
		if ($this->checkIfEntriesForVersionExists($this->getCurrentDbVersion())) {
			return true;
		} else {
			$this->setDBToErrorStatus(
					$this->l->t(
							'No entries in the database. Please run update.'));
			return false;
		}
	}
	
	public function setDataSource($rir_ftps) {
		$this->rir_ftps = $rir_ftps;
	}

	private function isOKStatus(int $status_id):bool {
		return $status_id == RIRStatus::kDbOk || $status_id == RIRStatus::kDbUpdating || $status_id == RIRStatus::kDbOkButError;
	}

	public function getStatus(): bool {
		$status_id = $this->getStatusId();
		if ($this->isOKStatus($status_id) &&
				$this->rir_data_checks->checkGMP() &&
				$this->checkDBPlausibleAndSetToError()) {
			return true;
		}
		return false;
	}

	public function getStatusString(): string {
		$service_string = '"RIR Data":';
		$service_string_error = $service_string . ' ' . $this->l->t('ERROR:');
		$service_string_ok = $service_string . ' ' . $this->l->t('OK');
		$status_id = $this->getStatusId();

		if ($this->isOKStatus($status_id) &&
				! $this->checkDBPlausibleAndSetToError()) {
			$status_id = RIRStatus::kDbError;
		}

		if ($this->isOKStatus($status_id)) {
			if ($this->rir_data_checks->checkGMP()) {
				if ($status_id == RIRStatus::kDbOk) {
					return $service_string_ok . '.';
				} elseif ($status_id == RIRStatus::kDbUpdating) {
					return $service_string_ok . ': ' .
					$this->l->t(
							'The database is currently updating, but the service can be used during the update with the last valid data.');
				} elseif ($status_id == RIRStatus::kDbOkButError) {
					return $service_string_ok . ': ' .
					$this->l->t(
							'The last update try ended in an error but the service can be used with the last valid data. ').
							' ' . $this->l->t('Last error message:') . ' ' .
							$this->getErrorMessage();
				}
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
		}
		return $service_string_error . ' ' .
				$this->l->t('Something is missing.');
	}

	public function getCountryCodeFromIP(string $ip_address): string {
		if (! $this->getStatus()) {
			return 'UNAVAILABLE';
		}

		$version = $this->getCurrentDbVersion();

		if (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			$cc = $this->rir_service_mapper->getCountryCodeFromIpv4(
					RIRServiceMapper::ipv4String2Int64($ip_address), $version);
			return $cc;
		} elseif (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
			$cc = $this->rir_service_mapper->getCountryCodeFromIpv6(
					RIRServiceMapper::ipv6String2Int64($ip_address), $version);
			return $cc;
		} else {
			return 'INVALID_IP';
		}
	}

	public function getDatabaseDate(): string {
		$status_id = $this->getStatusId();
		$db_date = $this->getDatabaseDateImpl();
		if ($db_date == '') {
			if ($this->isOKStatus($status_id)) {
				return $this->l->t('Date of the database cannot be determined!');
			} else {
				return $this->l->t('No database available!');
			}
		} else {
			if ($this->isOKStatus($status_id) &&
					$this->checkIfEntriesForVersionExists($this->getCurrentDbVersion())) {
				return $db_date;
			} else {
				return $this->l->t('No database available!');
			}
		}
		return $this->l->t('No database available!');
	}

	private function setDBToErrorStatus(string $error_message, bool $dbOKOnError = false) {
		if ($dbOKOnError) {
			$this->setStatusId(RIRStatus::kDbOkButError);
		} else {
			$this->setStatusId(RIRStatus::kDbError);
		}
		$this->setErrorMessage($error_message);
		$this->logger->error('There was a problem to add data to the DB: ' . $error_message, ['app' => 'geoblocker']);
		if (!$dbOKOnError) {
			$this->resetDatabaseDateImpl();
		}
	}

	private function fillDatabase(int $version, bool $dbOKOnError = false): bool {
		foreach ($this->rir_ftps as $rir_name => $rir_url) {
			try {
				$rir_data_handle = fopen($rir_url, 'r');
			} catch (Exception $e) {
				$rir_data_handle = false;
			}
			if ($rir_data_handle != false) {
				try {
					$number_of_ipv4_entries_target = 0;
					$number_of_ipv4_entries_actual = 0;
					$number_of_ipv6_entries_target = 0;
					$number_of_ipv6_entries_actual = 0;
					while (($line = fgets($rir_data_handle)) !== false) {
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
								$db_entry->setVersion($version);
								$this->rir_service_mapper->insert($db_entry);
								++$number_of_ipv4_entries_actual;
							} elseif ($parts[2] == 'ipv6' && $parts[1] != '') {
								$db_entry = new RIRServiceDBEntity();
								$db_entry->setBeginIpRange(
										RIRServiceMapper::ipv6String2Int64(
												$parts[3]));
								$db_entry->setCountryCode($parts[1]);
								$db_entry->setLengthIpRange(
										pow(2, 64 - intval($parts[4])));
								$db_entry->setIsIpV6(true);
								$db_entry->setVersion($version);
								$this->rir_service_mapper->insert($db_entry);
								++$number_of_ipv6_entries_actual;
							}
						} elseif ($parts[0] == $rir_name && count($parts) == 6 && str_starts_with($parts[5],'summary')) {
							if ($parts[2] == 'ipv4') {
								$number_of_ipv4_entries_target = intval($parts[4]);
							} elseif ($parts[2] == 'ipv6') {
								$number_of_ipv6_entries_target = intval($parts[4]);
							}
						}
					}
					if (($number_of_ipv4_entries_actual + $number_of_ipv6_entries_actual) == 0
							|| ($number_of_ipv4_entries_target + $number_of_ipv6_entries_target) == 0) {
						$this->setDBToErrorStatus(
								$this->l->t(
										'No valid entries could be read for region "%s". Maybe the RIR has changed the file format.', [$rir_name]), $dbOKOnError);
						return false;
					} elseif ($number_of_ipv4_entries_actual != $number_of_ipv4_entries_target) {
						$this->setDBToErrorStatus(
							$this->l->t(
									'Not the right number of entries read for ipv4 in region "%s". Should have been %d but was %d.',
									 [$rir_name,  $number_of_ipv4_entries_target, $number_of_ipv4_entries_actual]), $dbOKOnError);
						return false;
					} elseif ($number_of_ipv6_entries_actual != $number_of_ipv6_entries_target) {
						$this->setDBToErrorStatus(
							$this->l->t(
									'Not the right number of entries read for ipv6 in region "%s". Should have been %d but was %d.',
									 [$rir_name,  $number_of_ipv6_entries_target, $number_of_ipv6_entries_actual]), $dbOKOnError);
						return false;
					}
				} catch (Exception $e) {
					$this->setDBToErrorStatus(
							$this->l->t('Exception caught during Update for region "%s": %s', [$rir_name, $e->getMessage()]), $dbOKOnError);
					return false;
				} finally {
					fclose($rir_data_handle);
				}
			} else {
				$this->setDBToErrorStatus(
						$this->l->t(
								'Invalid file handle for region "%s". Probably the internet connection got lost during the update.', [$rir_name]), $dbOKOnError);
				return false;
			}
		}
		$this->setDatabaseDateImpl();
		return true;
	}

	private function eraseDatabase(int $version) {
		if (! $this->rir_service_mapper->eraseAllDatabaseEntries($version)) {
			$this->setDBToErrorStatus('Problem during erasing the whole or part of the database occured. Reset the database using the command line tool.');
			return false;
		} else {
			if (($version == -1) || ($version == $this->getCurrentDbVersion())) {
				$this->resetDatabaseDateImpl();
			}
			return true;
		}
	}

	private function checkIfEntriesForVersionExists(int $version): bool {
		return $this->rir_service_mapper->getNumberOfEntries($version) > 0;
	}

	public function updateDatabase(): bool {
		$status_id = $this->getStatusId();
		if ($status_id == RIRStatus::kDbNotInitialized ||
				$status_id == RIRStatus::kDbError) {
			$this->setStatusId(RIRStatus::kDbInitilazing);
			if (! $this->eraseDatabase(-1)) {
				return false;
			}
			$use_version = 0;
			$this->setCurrentDbVersion($use_version);
			if (! $this->fillDatabase($use_version)) {
				return false;
			}
			$this->setStatusId(RIRStatus::kDbOk);
			return true;
		} elseif ($status_id == RIRStatus::kDbOk ||
				$status_id == RIRStatus::kDbOkButError) {
			$this->setStatusId(RIRStatus::kDbUpdating);
			$before_version = $this->getCurrentDbVersion();
			$after_version = $this->getOtherDbVersion();
			if ($this->checkIfEntriesForVersionExists($after_version)) {
				if (! $this->eraseDatabase($after_version)) {
					return false;
				}
			}
			if (! $this->fillDatabase($after_version, true)) {
				$this->eraseDatabase($after_version);
				return false;
			}
			$this->setCurrentDbVersion($after_version);
			if (! $this->eraseDatabase($before_version)) {
				return false;
			}
			$this->setStatusId(RIRStatus::kDbOk);
			return true;
		}
		return false;
	}

	public function getDatabaseUpdateStatusImpl(): int {
		$status_id = $this->getStatusId();
		if ($status_id == RIRStatus::kDbInitilazing) {
			return LocationServiceUpdateStatus::kUpdating+10;
		} elseif ($status_id == RIRStatus::kDbUpdating) {
			return LocationServiceUpdateStatus::kUpdating;
		} else {
			if ($this->rir_data_checks->checkAll()) {
				return LocationServiceUpdateStatus::kUpdatePossible;
			} else {
				return LocationServiceUpdateStatus::kUpdateNotPossible;
			}
		}
	}
	public function getDatabaseUpdateStatus(): int {
		$ret = $this->getDatabaseUpdateStatusImpl();
		if ($ret <= LocationServiceUpdateStatus::kUpdating) {
			return $ret;
		} else {
			return LocationServiceUpdateStatus::kUpdating;
		}
	}

	public function getDatabaseUpdateStatusString(): string {
		switch ($this->getDatabaseUpdateStatusImpl()) {
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
				return '';
			case LocationServiceUpdateStatus::kUpdatePossible:
				return '';
				break;
			case LocationServiceUpdateStatus::kUpdating:
				return $this->l->t('Current number of entries:') . ' ' .
						strval($this->rir_service_mapper->getNumberOfEntries($this->getOtherDbVersion()));
				break;
			case LocationServiceUpdateStatus::kUpdating+10:
				return $this->l->t('Current number of entries:') . ' ' .
						strval($this->rir_service_mapper->getNumberOfEntries($this->getCurrentDbVersion()));
				break;
			default:
				// @codeCoverageIgnoreStart
				return $this->l->t(
						'Update in undefined state. Please complain to the developer.');
				break;
				// @codeCoverageIgnoreEnd
		}
	}

	public function resetDatabase(): bool {
		if (! $this->eraseDatabase(-1)) {
			return false;
		}
		$this->setStatusId(RIRStatus::kDbNotInitialized);
		return true;
	}
}
