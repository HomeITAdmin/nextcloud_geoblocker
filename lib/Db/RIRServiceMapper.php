<?php

namespace OCA\GeoBlocker\Db;

use OCP\IDbConnection;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\QBMapper;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

class RIRServiceMapper extends QBMapper {

	public function __construct(IDbConnection $db) {
		parent::__construct($db, 'geoblocker_ls_rir', RIRServiceDBEntity::class);
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