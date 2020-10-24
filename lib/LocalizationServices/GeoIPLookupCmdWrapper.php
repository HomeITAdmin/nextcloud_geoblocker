<?php

declare(strict_types = 1)
;

namespace OCA\GeoBlocker\LocalizationServices;

class GeoIPLookupCmdWrapper {
	public function geoiplookup(string $ip_address , array &$output , int &$return_var):String {
		$ret = exec('geoiplookup ' . $ip_address , $output, $return_var);
		if ($ret == null) {
			$ret = "Null";
		}
		return $ret;
	}
	public function geoiplookup6(string $ip_address , array &$output , int &$return_var):String {
		$ret = exec('geoiplookup6 ' . $ip_address , $output, $return_var);
		if ($ret == null) {
			$ret = "Null";
		}
		return $ret;
	}
	public function getFullDateString(array &$output , int &$return_var):String {
		$ret = exec('geoiplookup -v 0.0.0.0', $output, $return_var);
		if ($ret == null) {
			$ret = 'Null';
		}
		return $ret;
	}
}
