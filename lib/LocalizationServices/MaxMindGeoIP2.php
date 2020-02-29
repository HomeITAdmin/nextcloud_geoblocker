<?php
declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;
use OCP\IL10N;

class MaxMindGeoIP2 implements ILocalizationService {
	private $l;
	public function __construct(IL10N $l) {
		$this->l = $l;
	}
	public function getStatus(): bool {		
			return FALSE;
	}
	public function getStatusString(): string {		
			return $this->l->t('ERROR: "MaxMind GeoIP2" Service is not implemented yet.');		
	}
	public function getCountryCodeFromIP($ip_address): string {
		if (! $this->getStatus ()) {
			return 'UNAVAILABLE';
		}
	}
}