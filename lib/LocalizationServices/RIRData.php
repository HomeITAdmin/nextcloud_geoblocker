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

// use OCA\GeoBlocker\Db\RIRServiceDBEntity;
abstract class RIRStatus {
	const DB_Not_Initialized = 0;
	const DB_Initilazing = 1;
	const DB_OK = 2;
	const DB_Updating = 3;
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

	static public function ipv4String2Int64(string $ip): int {
		return ip2long($ip);
	}

	static public function ipv6String2Int64(string $ip): int {
		$gmp_ip = gmp_import(substr(inet_pton($ip), 0, 8));
		return gmp_intval($gmp_ip + PHP_INT_MIN);
	}

	// TODO: Not correct, but correct enough for the momemt;
	static public function ipv6Int642String(int $ip): string {
		$gmp_ip = gmp_init($ip);
		// $gmp_ip = ($gmp_ip - PHP_INT_MIN) * 2 * -PHP_INT_MIN;
		$gmp_ip = $gmp_ip - PHP_INT_MIN;

		return inet_ntop(pack('A16', gmp_export($gmp_ip)));
	}

	public function getStatus(): bool {
		if ($this->getStatusId() == RIRStatus::DB_OK) {
			return true;
		}
		return false;
	}

	public function getStatusString(): string {
		$service_string = '"RIR Data": ';
		if ($this->getStatus()) {
			return $service_string . $this->l->t('OK.');
		}
		return $service_string . $this->l->t('ERROR: Something is missing.');
	}

	public function getCountryCodeFromIP($ip_address): string {
		if (! $this->getStatus()) {
			return 'UNAVAILABLE';
		}

		if (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			$db_entry = $this->rir_service_mapper->getCountryCodeFromIpv4(
					$this->ipv4String2Int64($ip_address));
			return $db_entry->getCountryCode();
		} elseif (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
			$db_entry = $this->rir_service_mapper->getCountryCodeFromIpv6(
					$this->ipv6String2Int64($ip_address));
			return $db_entry->getCountryCode();
		} else {
			return 'INVALID_IP';
		}

		return 'AA';
	}

	public function getDatabaseDate(): string {
		$db_date = $this->getDatabaseDateImpl();
		if ($db_date == '') {
			return $this->l->t('Date of the database cannot be determined!');
		}
		return $db_date;
	}

	public function updateDatabase(): bool {
		error_log('Enter updateDatabase');
		$status_id = $this->getStatusId();

		// TODO: all RIPEs, Refactor
		if ($status_id == RIRStatus::DB_Not_Initialized) {
			$this->setStatusId(RIRStatus::DB_Initilazing);
			$rir_data_handle = fopen(
					'ftp://ftp.ripe.net/pub/stats/ripencc/delegated-ripencc-latest',
					'r');
			if ($rir_data_handle != FALSE) {
				$i = 0;
				while (($line = fgets($rir_data_handle))) { // && $i < 100 ) {
					$parts = explode('|', $line);
					if ($parts[0] == 'ripencc' && count($parts) >= 7) {
						if ($parts[2] == 'ipv4' && $parts[1] != '') {
							$db_entry = new RIRServiceDBEntity();
							$db_entry->setBeginIpRange(
									$this->ipv4String2Int64($parts[3]));
							$db_entry->setCountryCode($parts[1]);
							$db_entry->setLengthIpRange($parts[4]);
							$db_entry->setIsIpV6(false);
							$this->rir_service_mapper->insert($db_entry);
						} elseif ($parts[2] == 'ipv6' && $parts[1] != '') {
							$db_entry = new RIRServiceDBEntity();
							$db_entry->setBeginIpRange(
									$this->ipv6String2Int64($parts[3]));
							$db_entry->setCountryCode($parts[1]);
							$db_entry->setLengthIpRange(
									pow(2, 64 - intval($parts[4])));
							$db_entry->setIsIpV6(true);
							$this->rir_service_mapper->insert($db_entry);
						} else {
							error_log('Nothing to insert!');
						}
						if ($i % 10000 == 0) {
							error_log(strval($i));
						}
						$i ++;
					}
				}
				fclose($rir_data_handle);
			}
			$this->setStatusId(RIRStatus::DB_OK);
			return true;
		}
		return false;
	}
}
