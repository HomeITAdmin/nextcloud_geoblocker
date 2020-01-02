<?php declare(strict_types = 1)
;

namespace OCA\GeoBlocker\LocalizationServices;

class GeoIPLookupCmdWrapper {
	
	public function geoiplookup(string $ip_address , array &$output , int &$return_var ):String {
		return exec ( 'geoiplookup ' . $ip_address , $output, $return_var);
	}
	public function geoiplookup6(string $ip_address , array &$output , int &$return_var ):String {
		return exec ( 'geoiplookup6 ' . $ip_address , $output, $return_var);
	}
}