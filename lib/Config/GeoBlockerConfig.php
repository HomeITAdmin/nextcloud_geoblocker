<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Config;

use OCP\IConfig;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

class GeoBlockerConfig {

	/** @var IConfig */
	private $config;

	public function __construct(IConfig $config) {
		$this->config = $config;
	}

	public function getLogWithIpAddress(): bool {
		$log_with_ip_address = $this->config->getAppValue('geoblocker',
				'logWithIpAddress', '0');
		return $log_with_ip_address === '1';
	}

	public function setLogWithIpAddress(bool $log_with_ip_address) {
		$value = $log_with_ip_address === true ? '1' : '0';
		$this->config->setAppValue('geoblocker', 'logWithIpAddress', $value);
	}

	public function getLogWithCountryCode(): bool {
		$log_with_country_code = $this->config->getAppValue('geoblocker',
				'logWithCountryCode', '0');
		return $log_with_country_code === '1';
	}

	public function setLogWithCountryCode(bool $log_with_country_code) {
		$value = $log_with_country_code === true ? '1' : '0';
		$this->config->setAppValue('geoblocker', 'logWithCountryCode', $value);
	}

	public function getLogWithUserName(): bool {
		$log_with_user_name = $this->config->getAppValue('geoblocker',
				'logWithUserName', '0');
		return $log_with_user_name === '1';
	}

	public function setLogWithUserName(bool $log_with_user_name) {
		$value = $log_with_user_name === true ? '1' : '0';
		$this->config->setAppValue('geoblocker', 'logWithUserName', $value);
	}

	public function getDelayIpAddress(): bool {
		$delay_ip_address = $this->config->getAppValue('geoblocker',
				'delayIpAddress', '0');
		return $delay_ip_address === '1';
	}

	public function setDelayIpAddress(bool $delay_ip_address) {
		$value = $delay_ip_address === true ? '1' : '0';
		$this->config->setAppValue('geoblocker', 'delayIpAddress', $value);
	}

	public function getBlockIpAddress(): bool {
		$block_ip_address = $this->config->getAppValue('geoblocker',
				'blockIpAddress', '0');
		return $block_ip_address === '1';
	}

	public function setBlockIpAddress(bool $block_ip_address) {
		$value = $block_ip_address === true ? '1' : '0';
		$this->config->setAppValue('geoblocker', 'blockIpAddress', $value);
	}

	public function getUseWhiteListing(): bool {
		$log_with_user_name = $this->config->getAppValue('geoblocker',
				'choosenWhiteBlackList', '0');
		return $log_with_user_name === '1';
	}

	public function setUseWhiteListing(bool $use_white_listing) {
		$value = $use_white_listing === true ? '1' : '0';
		$this->config->setAppValue('geoblocker', 'choosenWhiteBlackList', $value);
	}

	public function getChosenService(): string {
		$chosen_service = $this->config->getAppValue('geoblocker',
				'chosenService', '0');
		return $chosen_service;
	}

	public function setChosenService(string $chosen_service) {
		$this->config->setAppValue('geoblocker', 'chosenService',
				$chosen_service);
	}

	public function getChoosenCountriesByString(): string {
		$countries = $this->config->getAppValue('geoblocker', 'choosenCountries',
				'');
		return $countries;
	}

	public function isCountryCodeInListOfChoosenCountries(string $cc): bool {
		$countries = $this->config->getAppValue('geoblocker', 'choosenCountries',
				'');
		$cc_short = substr($cc, 0, 2);
		if (strpos($countries, $cc_short) !== false) {
			return true;
		} else {
			return false;
		}
	}

	public function getDoFakeAddress(): bool {
		$do_fake_address = $this->config->getAppValue('geoblocker',
				'doFakeAddress', '0');
		return $do_fake_address === '1';
	}

	public function setDoFakeAddress(bool $do_fake_address) {
		$value = $do_fake_address === true ? '1' : '0';
		$this->config->setAppValue('geoblocker', 'doFakeAddress', $value);
	}

	public function getFakeAddress(): string {
		$default_fake_address = '127.0.0.1';
		$fake_address = $this->config->getAppValue('geoblocker', 'fakeAddress',
				$default_fake_address);
		if (! GeoBlocker::isIPAddressValid($fake_address)) {
			$fake_address = $default_fake_address;
			$this->config->setAppValue('geoblocker', 'fakeAddress',
					$default_fake_address);
		}
		return $fake_address;
	}

	public function getFakeAddressUser(): string {
		$user = $this->config->getAppValue('geoblocker', 'fakeAddressUser', '');
		return $user;
	}

	public function setFakeAddressUser(string $user) {
		$this->config->setAppValue('geoblocker', 'fakeAddressUser', $user);
	}

	public function getDatabaseFileLocation(string $unique_service_string): string {
		$database_file_location = $this->config->getAppValue('geoblocker',
				$unique_service_string . '_DatabaseFileLocation', '');
		return $database_file_location;
	}

	public function setDatabaseFileLocation(string $database_file_location,
			string $unique_service_string) {
		$this->config->setAppValue('geoblocker',
				$unique_service_string . '_DatabaseFileLocation',
				$database_file_location);
	}

	public function getServiceSpecificConfigValue(string $name,
			string $default_value): string {
		return $this->config->getAppValue('geoblocker', $name, $default_value);
	}

	public function setServiceSpecificConfigValue(string $name, string $value) {
		$this->config->setAppValue('geoblocker', $name, $value);
	}
}
