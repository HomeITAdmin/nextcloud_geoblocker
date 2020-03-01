<?php

namespace OCA\GeoBlocker\Hooks;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\IConfig;
use OCP\IUserSession;
use OCP\ILogger;
use OCP\IRequest;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;
use OCP\IL10N;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookup;
use OCA\GeoBlocker\LocalizationServices\GeoIPLookupCmdWrapper;
use OCA\GeoBlocker\LocalizationServices\MaxMindGeoLite2;

class UserHooks {
	private $userSession;
	private $logger;
	private $request;
	private $config;
	private $l;
	public function __construct(IUserSession $userSession, ILogger $logger,
			IRequest $request, IConfig $config, IL10N $l) {
		$this->userSession = $userSession;
		$this->logger = $logger;
		$this->request = $request;
		$this->config = new GeoBlockerConfig ( $config );
		$this->l = $l;
	}
	public function register() {
		$callback = function ($user) {
			if ($this->config->getDoFakeAddress()) {
				$ip_address = $this->config->getFakeAddress();
				$this->config->setDoFakeAddress(false);
			} else {
				$ip_address = $this->request->getRemoteAddress ();
			}

			switch ($this->config->getChosenService()) {
				case '0':
					$location_service = new GeoIPLookup ( new GeoIPLookupCmdWrapper () , $this->l);
					break;
				case '1':
					$location_service = new MaxMindGeoLite2 ($this->l);
					break;
				default:
					$location_service = new GeoIPLookup ( new GeoIPLookupCmdWrapper () , $this->l);
			}

			$geoblocker = new GeoBlocker ( $user, $this->logger, $this->config,
					$this->l, $location_service );
			$geoblocker->check ( $ip_address );
		};
		$this->userSession->listen ( '\OC\User', 'preLogin', $callback );
	}
}
