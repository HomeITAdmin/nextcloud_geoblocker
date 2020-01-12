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
			$ip_address = $this->request->getRemoteAddress ();
			// TODO: Only for testing reasons override the address to fake access from different countries! In future give admin a better tool then that.
			// $ip_address = '24.165.23.67'; //US
			// $ip_address = '2a02:2e0:3fe:1001:302::'; //DE

			// TODO: Create depending on the configurated service the right service
			$location_service = new GeoIPLookup ( new GeoIPLookupCmdWrapper () );

			$geoblocker = new GeoBlocker ( $user, $this->logger, $this->config,
					$this->l, $location_service );
			$geoblocker->check ( $ip_address );
		};
		$this->userSession->listen ( '\OC\User', 'preLogin', $callback );
	}
}
