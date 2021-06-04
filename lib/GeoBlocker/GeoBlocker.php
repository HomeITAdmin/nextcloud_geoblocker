<?php

declare(strict_types = 1)
	;

namespace OCA\GeoBlocker\GeoBlocker;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\ILogger;
use OCP\IL10N;
use OCA\GeoBlocker\LocalizationServices\ILocalizationService;
use OC\User\LoginException;

class GeoBlocker {
	/** @var String */
	private $user;
	/** @var ILogger */
	private $logger;
	/** @var GeoBlockerConfig */
	private $config;
	/** @var IL10N */
	private $l;
	/** @var ILocalizationService */
	private $location_service;
	public const kCountryNotFoundCode = 'AA';
	public const kUnavailableCode = 'UNAVAILABLE';
	public const kInvalidIPCode = 'INVALID_IP';
	private const kNotShownString = 'NOT_SHOWN_IN_LOG';

	public function __construct(String $user, ILogger $logger,
			GeoBlockerConfig $config, IL10N $l,
			ILocalizationService $location_service) {
		$this->user = $user;
		$this->logger = $logger;
		$this->config = $config;
		$this->l = $l;
		$this->location_service = $location_service;
	}

	private function createInvalidIPLogString(string $log_user,
			string $log_address): string {
		return sprintf(
				'The user "%s" attempt to login with an invalid IP address "%s".',
				$log_user, $log_address);
	}

	private function logEvent(string $log_string): void {
		$this->logger->warning($log_string, ['app' => 'geoblocker']);
	}

	private function logError(string $log_string): void {
		$this->logger->error($log_string, ['app' => 'geoblocker']);
	}

	public function blockIpAddress(String $ip_address): void {
		$block_ip_address = false;
		if ($this->isIPAddressValid($ip_address)) {
			if (! $this->isIPAddressLocal($ip_address)) {
				$location = $this->location_service->getCountryCodeFromIP(
						$ip_address);

				$log_user = $this->config->getLogWithUserName() ? $this->user : $this::kNotShownString;
				$log_location = $this->config->getLogWithCountryCode() ? $location : $this::kNotShownString;
				$log_address = $this->config->getLogWithIpAddress() ? $ip_address : $this::kNotShownString;

				if ($location !== 'INVALID_IP' && $location !== 'UNAVAILABLE') {
					if ($this->config->isCountryCodeInListOfChoosenCountries(
							$location) xor $this->config->getUseWhiteListing()) {
						$log_string = sprintf(
								'The user "%s" attempt to login with IP address "%s" from blocked country "%s".',
								$log_user, $log_address, $log_location);
						$any_reaction = false;
						if ($this->config->getDelayIpAddress()) {
							usleep(30 * 1000000);
							$log_string .= ' Login is delayed.';
							$any_reaction = true;
						}
						$should_be_blocked = $this->config->getBlockIpAddress();
						if ($should_be_blocked|| $this->config->getBlockIpAddressBefore()) {
							//Make sure this one is also set, too. Want to get rid of "getBlockIpAddressBefore" soon.
							if (!$should_be_blocked) {
								$this->config->setBlockIpAddress(true);
							}

							$block_ip_address = true;
							$log_string .= ' Login is blocked.';
							$any_reaction = true;
						}
						if (! $any_reaction) {
							$log_string .= ' No reaction is activated.';
						}
						$this->logEvent($log_string);
					}
				} elseif ($location === 'UNAVAILABLE') {
					$log_string = sprintf(
							'The login of user "%s" with IP address "%s" could not be checked due to problems with location service.',
							$log_user, $log_address);
					$this->logEvent($log_string);
				} elseif ($location === 'INVALID_IP') {
					$log_string = $this->createInvalidIPLogString($log_user,
							$log_address);
					$this->logEvent($log_string);
				} else {
					$this->logger->error(
							"This shouldn't have happen. This line should never be reached.",
							['app' => 'geoblocker']);
				}
			}
		} else {
			$log_user = $this->config->getLogWithUserName() ? $this->user : 'NOT_SHOWN_IN_LOG';
			$log_address = $this->config->getLogWithIpAddress() ? $ip_address : 'NOT_SHOWN_IN_LOG';

			$log_string = $this->createInvalidIPLogString($log_user,
					$log_address);
			$this->logEvent($log_string);
		}
		if ($block_ip_address) {
			throw new LoginException($this->l->t('Your attempt to login from country "%s" is blocked by the Nextcloud GeoBlocker App. '
			. 'If this is a problem for you, please contact your administrator.', [$location]));
		}
	}

	public static function isIPAddressValid(String $ip_address): bool {
		if (filter_var($ip_address, FILTER_VALIDATE_IP)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Returns if the IP address is an local IP address.
	 * This implicitly also confirms, that it is a valid IP address, if it is local.
	 * If it is not local it could also be a not valid IP address.
	 *
	 * @param string $IPAdress
	 *        	The IP Adress to check.
	 * @return bool
	 */
	public static function isIPAddressLocal(String $ip_address): bool {
		if (GeoBlocker::isIPAddressValid($ip_address)) {
			if (filter_var($ip_address, FILTER_VALIDATE_IP,
					FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
}
