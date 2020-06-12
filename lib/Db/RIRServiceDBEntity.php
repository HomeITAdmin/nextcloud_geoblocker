<?php

namespace OCA\GeoBlocker\Db;

use JsonSerializable;
use OCP\AppFramework\Db\Entity;

class RIRServiceDBEntity extends Entity implements JsonSerializable {
	protected $beginIpRange;
	protected $lengthIpRange;
	protected $isIpV6;
	protected $countryCode;
	protected $version;

	public function jsonSerialize() {
		return ['id' => $this->id,'beginIpRange' => $this->beginIpRange,
			'lengthIpRange' => $this->lengthIpRange,'isIpV6' => $this->isIpV6,
			'countryCode' => $this->countryCode,'version' => $this->version];
	}

	public function __construct() {
		$this->addType('beginIpRange', 'integer');
		$this->addType('lengthIpRange', 'integer');
		$this->addType('isIpV6', 'boolean');
		$this->addType('version', 'integer');
	}
}