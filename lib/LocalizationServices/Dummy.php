<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

use OCP\IL10N;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

class Dummy implements ILocalizationService {
	private $l;

	public function __construct(IL10N $l) {
		$this->l = $l;
	}

	public function getStatus(): bool {
		return true;
	}

	public function getStatusString(): string {
		return '"Dummy": ' . $this->l->t('OK. This service always returns "%s" for "Country not found".', GeoBlocker::kCountryNotFoundCode);
	}

	public function getCountryCodeFromIP($ip_address): string {
		return GeoBlocker::kCountryNotFoundCode;
	}
}
