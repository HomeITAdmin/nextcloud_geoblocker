<?php

namespace OCA\GeoBlocker\Db;

use Exception;
use OCP\IDBConnection;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\QBMapper;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

class RIRServiceMapper extends QBMapper {
	public const kIPv6OffsetForSQL = '-9223372036854775808';

	public function __construct(IDBConnection $db) {
		parent::__construct($db, 'geoblocker_ls_rir', RIRServiceDBEntity::class);
	}

	public static function ipv4String2Int64(string $ip): int {
		return ip2long($ip);
	}

	public static function ipv6String2Int64(string $ip): int {
		$gmp_ip = gmp_import(substr(inet_pton($ip), 0, 8));
		return gmp_intval(gmp_add($gmp_ip, RIRServiceMapper::kIPv6OffsetForSQL));
	}

	public function eraseAllDatabaseEntries(int $version = -1) {
		$qb = $this->db->getQueryBuilder();
		try {
			$qb->delete($this->getTableName());
			if ($version >= 0) {
				$qb->where($qb->expr()->eq('version', $qb->createNamedParameter(strval($version))));
			}
			$qb->execute();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function getCountryCodeFromIpv4(int $ip, int $version): string {
		return $this->getCountryCodeIpImpl($ip, '0', $version);
	}

	public function getCountryCodeFromIpv6(int $ip, int $version): string {
		return $this->getCountryCodeIpImpl($ip, '1', $version);
	}

	public function getCountryCodeIpImpl(int $ip, string $is_ip_v6, int $version): string {
		$qb = $this->db->getQueryBuilder();

		$expr1 = $qb->expr()->lte('begin_ip_range',
				$qb->createNamedParameter($ip));
		$expr2 = $qb->expr()->eq('is_ip_v6',
				$qb->createNamedParameter($is_ip_v6));
		$expr3 = $qb->expr()->eq('version',
				$qb->createNamedParameter($version));

		$qb->select('*')->from($this->getTableName())->where(
			$qb->expr()->andX($expr1, $expr2, $expr3));
		

		$qb->setMaxResults(1);
		$qb->orderBy('begin_ip_range', 'DESC');

		try {
			$db_entry = $this->findEntity($qb);
			if ($ip <
					$db_entry->getBeginIpRange() + $db_entry->getLengthIpRange()) {
				return $db_entry->getCountryCode();
			}
			return GeoBlocker::kCountryNotFoundCode;
		} catch (DoesNotExistException $e) {
			return GeoBlocker::kCountryNotFoundCode;
		}
	}

	public function getNumberOfEntries(int $version = -1): int {
		$qb = $this->db->getQueryBuilder();
		$qb->select($qb->func()->count('*'))->from($this->getTableName());
		if ($version >= 0) {
			$qb->where($qb->expr()->eq('version', $qb->createNamedParameter(strval($version))));
		}
		$res = $this->findOneQuery($qb);
		return intval($res['COUNT(*)']);
	}
}
