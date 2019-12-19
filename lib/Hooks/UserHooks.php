<?php

namespace OCA\GeoBlocker\Hooks;

use OCA\GeoBlocker\Config\GeoBlockerConfig;
use OCP\IConfig;
use OCP\IUserSession;
use OCP\ILogger;
use OCP\IRequest;
use OCA\GeoBlocker\GeoBlocker\GeoBlocker;
use OCP\IL10N;

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
			$address = $this->request->getRemoteAddress ();
			// TODO: For testing reasons override the address!!!
			//$address = '24.165.23.67';
			//$address = '2a02:2e0:3fe:1001:302::';

			$geoblocker = new GeoBlocker ( $user, $address, $this->logger,
					$this->config, $this->l );
			$geoblocker->check ();
		};
		$this->userSession->listen ( '\OC\User', 'preLogin', $callback );
	}
}
