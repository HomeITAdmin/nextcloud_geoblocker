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

	// TODO: refactor: Not working correctly, Return CC directly?
	public function getEntityFromIPv4(int $ip): RIRServiceDBEntity {
		$qb = $this->db->getQueryBuilder();

		$expr1 = $qb->expr()->lte('begin_ip_range', strval($ip));
		$expr2 = $qb->expr()->eq('is_ip_v6', strval(false));
		
		$qb->select('*')->from($this->getTableName())->where(
				$qb->expr()->andX($expr1, $expr2));
		
		$qb->setMaxResults(1);
		$qb->orderBy('begin_ip_range','DESC');
		
		try {			
			return $this->findEntity($qb);
		} catch (DoesNotExistException $e) {
			error_log('In Catch');
			$entity = new RIRServiceDBEntity();
			$entity->setId(0);
			$entity->setBeginIpRange($ip);
			$entity->setLengthIpRange(1);
			$entity->setIsIpV6(false);
			$entity->setCountryCode(GeoBlocker::$country_not_found_code);
			return $entity;
		}	
	}
	
	// TODO: refactor: Return CC directly?
	public function getEntityFromIPv6(int $ip): RIRServiceDBEntity {
		$qb = $this->db->getQueryBuilder();
		
		$expr1 = $qb->expr()->lte('begin_ip_range', strval($ip));
		$expr2 = $qb->expr()->eq('is_ip_v6', strval(true));
		
		$qb->select('*')->from($this->getTableName())->where(
				$qb->expr()->andX($expr1, $expr2));
		
		$qb->setMaxResults(1);
		$qb->orderBy('begin_ip_range','DESC');
		
		try {
			return $this->findEntity($qb);
		} catch (DoesNotExistException $e) {
			error_log('In Catch');
			$entity = new RIRServiceDBEntity();
			$entity->setId(0);
			$entity->setBeginIpRange($ip);
			$entity->setLengthIpRange(1);
			$entity->setIsIpV6(true);
			$entity->setCountryCode(GeoBlocker::$country_not_found_code);
			return $entity;
		}
	}
}