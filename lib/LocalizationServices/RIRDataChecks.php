<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\LocalizationServices;

class RIRDataChecks {
	public function checkAllowURLFOpen(): bool {
		return ini_get('allow_url_fopen') === '1';
	}

	public function checkGMP(): bool {
		return function_exists('gmp_import') && function_exists('gmp_intval');
	}

	public function checkInternetConnection(): bool {
		$connected = @fsockopen("www.example.com", 80);
		if ($connected) {
			$is_conn = true;
			fclose($connected);
		} else {
			$is_conn = false;
		}
		return $is_conn;
	}

	public function checkAll(): bool {
		return $this->checkAllowURLFOpen() && $this->checkGMP() &&
				$this->checkInternetConnection();
	}
}
