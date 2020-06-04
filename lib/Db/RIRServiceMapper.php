<?php

namespace OCA\GeoBlocker\Db;

use Exception;
use OCP\IDbConnection;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\QBMapper;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

class RIRServiceMapper extends QBMapper {

	public function __construct(IDbConnection $db) {
		parent::__construct($db, 'geoblocker_ls_rir', RIRServiceDBEntity::class);
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

	public function eraseAllDatabaseEntries() {
		$qb = $this->db->getQueryBuilder();
		try {
			$qb->delete($this->getTableName());
			$qb->execute();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function getCountryCodeFromIpv4(int $ip): string {
		return $this->getCountryCodeIpImpl($ip, '0');
	}

	public function getCountryCodeFromIpv6(int $ip): string {
		return $this->getCountryCodeIpImpl($ip, '1');
	}

	public function getCountryCodeIpImpl(int $ip, string $is_ip_v6): string {
		$qb = $this->db->getQueryBuilder();

		$expr1 = $qb->expr()->lte('begin_ip_range', strval($ip));
		$expr2 = $qb->expr()->eq('is_ip_v6', $is_ip_v6);

		$qb->select('*')->from($this->getTableName())->where(
				$qb->expr()->andX($expr1, $expr2));

		$qb->setMaxResults(1);
		$qb->orderBy('begin_ip_range', 'DESC');

		try {
			$db_entry = $this->findEntity($qb);
			if ($ip <
					$db_entry->getBeginIpRange() + $db_entry->getLengthIpRange()) {
				return $db_entry->getCountryCode();
			}
			return GeoBlocker::$country_not_found_code;
		} catch (DoesNotExistException $e) {
			return GeoBlocker::$country_not_found_code;
		}
	}
}