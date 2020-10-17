<?php

namespace OCA\GeoBlocker\Hooks;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\IConfig;
use OCP\IUserSession;
use OCP\ILogger;
use OCP\IRequest;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;
use OCP\IL10N;
use OCP\IDbConnection;
use OCA\GeoBlocker\LocalizationServices\LocalizationServiceFactory;

class UserHooks {
	private $userSession;
	private $logger;
	private $request;
	private $config;
	private $l;
	private $db;
	private $is_ip_address_blocked = false;

	public function __construct(IUserSession $userSession, ILogger $logger,
			IRequest $request, IConfig $config, IL10N $l, IDbConnection $db) {
		$this->userSession = $userSession;
		$this->logger = $logger;
		$this->request = $request;
		$this->config = new GeoBlockerConfig($config);
		$this->l = $l;
		$this->db = $db;
	}

	public function register() {
		$callback_pre_login = function (string $user) {
			$this->checkGeoIpBlocking($user);
		};
		$this->userSession->listen('\OC\User', 'preLogin', $callback_pre_login);
		
		$callback_post_login = function (\OC\User\User $user, string $password) {
			if ($this->is_ip_address_blocked) {
				$this->userSession->logout();
			}
		};
		$this->userSession->listen('\OC\User', 'postLogin', $callback_post_login);
	}

	private function checkGeoIpBlocking($user) {
		if ($this->config->getDoFakeAddress() && $this->config->getFakeAddressUser() == $user) {
			$ip_address = $this->config->getFakeAddress();
			$this->config->setDoFakeAddress(false);
		} else {
			$ip_address = $this->request->getRemoteAddress();
		}

		$location_service_factory = new LocalizationServiceFactory(
				$this->config, $this->l, $this->db);
		$location_service = $location_service_factory->getLocationService();
		$geoblocker = new GeoBlocker($user, $this->logger, $this->config,
				$this->l, $location_service);
		$this->is_ip_address_blocked = $geoblocker->isIpAddressBlocked($ip_address);
	}
}
