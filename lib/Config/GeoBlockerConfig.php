<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\Config;

use OCP\IConfig;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;

/**
 * Class GeoBlockerConfig
 *
 * read/write config of the GeoBlocker
 *
 * @package OCA\GeoBlocker\Config
 */
class GeoBlockerConfig {

	/** @var IConfig */
	private $config;

	/**
	 * Config constructor.
	 *
	 * @param IConfig $config
	 */
	public function __construct(IConfig $config) {
		$this->config = $config;
	}

	/**
	 * Whether IP address should appear in the logging
	 *
	 * @return bool
	 */
	public function getLogWithIpAddress(): bool {
		$logWithIpAddress = $this->config->getAppValue ( 'geoblocker',
				'logWithIpAddress', '0' );
		return $logWithIpAddress === '1';
	}

	/**
	 * Set or unset if the IP adress should appear in the logging
	 *
	 * @param bool $logWithIpAddress
	 */
	public function setLogWithIpAddress(bool $logWithIpAddress) {
		$value = $logWithIpAddress === true ? '1' : '0';
		$this->config->setAppValue ( 'geoblocker', 'logWithIpAddress', $value );
	}

	/**
	 * Whether Country Code should appear in the logging
	 *
	 * @return bool
	 */
	public function getLogWithCountryCode(): bool {
		$logWithCountryCode = $this->config->getAppValue ( 'geoblocker',
				'logWithCountryCode', '0' );
		return $logWithCountryCode === '1';
	}

	/**
	 * Set or unset if the country code should appear in the logging
	 *
	 * @param bool $logWithCountryCode
	 */
	public function setLogWithCountryCode(bool $logWithCountryCode) {
		$value = $logWithCountryCode === true ? '1' : '0';
		$this->config->setAppValue ( 'geoblocker', 'logWithCountryCode', $value );
	}

	/**
	 * Whether the user name should appear in the logging
	 *
	 * @return bool
	 */
	public function getLogWithUserName(): bool {
		$logWithUserName = $this->config->getAppValue ( 'geoblocker',
				'logWithUserName', '0' );
		return $logWithUserName === '1';
	}

	/**
	 * Set or unset if the user name should appear in the logging
	 *
	 * @param bool $logWithUserName
	 */
	public function setLogWithUserName(bool $logWithUserName) {
		$value = $logWithUserName === true ? '1' : '0';
		$this->config->setAppValue ( 'geoblocker', 'logWithUserName', $value );
	}
	/**
	 * Whether whitelisting should be used instead of blacklisting
	 *
	 * @return bool
	 */
	public function getUseWhiteListing(): bool {
		$logWithUserName = $this->config->getAppValue ( 'geoblocker',
				'choosenWhiteBlackList', '0' );
		return $logWithUserName === '1';
	}
	/**
	 * Set or unset if whitelisting should be used instead of blacklisting
	 *
	 * @param bool $useWhiteListing
	 */
	public function setUseWhiteListing(bool $useWhiteListing) {
		$value = $useWhiteListing === true ? '1' : '0';
		$this->config->setAppValue ( 'geoblocker', 'choosenWhiteBlackList',
				$value );
	}
	
	/**
	 * Returns whichs location service is chosen.
	 *
	 * @return string
	 */
	public function getChosenService(): string {
		$chosenService = $this->config->getAppValue ( 'geoblocker',
				'chosenService', '0' );
		return $chosenService;
	}
	/**
	 * Sets the chosen service.
	 *
	 * @param bool $chosenService
	 */
	public function setChosenService(string $chosenService) {
		$this->config->setAppValue ( 'geoblocker', 'chosenService',
				$chosenService );
	}

	/**
	 * Provide a string with all countries that are selected
	 * (2 letters per country, comma seperated)
	 *
	 * @return string
	 */
	public function getChoosenCountriesByString(): string {
		$countries = $this->config->getAppValue ( 'geoblocker',
				'choosenCountries', '' );
		return $countries;
	}

	/**
	 * Checks, if a given two letter country code (first two letter of the
	 * input string) is in the list of choosen countries.
	 *
	 * @param string $cc:
	 *        	Country Code to look for
	 * @return bool
	 */
	public function isCountryCodeInListOfChoosenCountries(string $cc): bool {
		$countries = $this->config->getAppValue ( 'geoblocker',
				'choosenCountries', '' );
		$cc_short = substr ( $cc, 0, 2 );
		if (strpos ( $countries, $cc_short ) !== FALSE) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Whether the user name should appear in the logging
	 *
	 * @return bool
	 */
	public function getDoFakeAddress(): bool {
		$doFakeAddress = $this->config->getAppValue ( 'geoblocker',
				'doFakeAddress', '0' );
		return $doFakeAddress === '1';
	}
	
	/**
	 * Set or unset if the user name should appear in the logging
	 *
	 * @param bool $logWithUserName
	 */
	public function setDoFakeAddress(bool $doFakeAddress) {
		$value = $doFakeAddress === true ? '1' : '0';
		$this->config->setAppValue ( 'geoblocker', 'doFakeAddress', $value );
	}
	
	/**
	 * Provides the fake IP address to be used for testing the blocking/logging
	 *
	 * @return string 
	 */
	public function getFakeAddress(): string {
		$defaultFakeAddress = '127.0.0.1';
		$fakeAddress = $this->config->getAppValue ( 'geoblocker',
				'fakeAddress', $defaultFakeAddress );
		if (! GeoBlocker::isIPAddressValid($fakeAddress)) {
			$fakeAddress = $defaultFakeAddress;
			$this->config->setAppValue ( 'geoblocker',
					'fakeAddress', $defaultFakeAddress );
		}
		return $fakeAddress;
	}
}
