<?php

namespace OCA\GeoBlocker\Db;

use JsonSerializable;
use OCP\AppFramework\Db\Entity;

class RIRServiceDBEntity extends Entity implements JsonSerializable {

	// protected $begin_ip_range;
	// protected $length_ip_range;
	// protected $is_ip_v6;
	// protected $country_code;
	protected $beginIpRange;
	protected $lengthIpRange;
	protected $isIpV6;
	protected $countryCode;

	public function jsonSerialize() {
		// return [
		// 'id' => $this->id,
		// 'begin_ip_range' => $this->beginIpRange,
		// 'length_ip_range' => $this->lengthIpRange,
		// 'is_ip_v6' => $this->isIpV6,
		// 'country_code' => $this->countryCode
		// ];
		return ['id' => $this->id,'beginIpRange' => $this->beginIpRange,
			'lengthIpRange' => $this->lengthIpRange,'isIpV6' => $this->isIpV6,
			'countryCode' => $this->countryCode];
	}

	public function __construct() {
		// add types in constructor
		// $this->addType('begin_ip_range', 'integer');
		// $this->addType('length_ip_range', 'integer');
		// $this->addType('is_ip_v6', 'boolean');
		$this->addType('beginIpRange', 'integer');
		$this->addType('lengthIpRange', 'integer');
		$this->addType('isIpV6', 'boolean');
	}
}