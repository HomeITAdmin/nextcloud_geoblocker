<?php

namespace OCA\GeoBlocker\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCA\GeoBlocker\Hooks\UserHooks;

class Application extends App implements IBootstrap {
	public function __construct(array $urlParams = []) {
		parent::__construct('geoblocker', $urlParams);
	}
	
	public function register(IRegistrationContext $context): void {
	}

	public function boot(IBootContext $context): void {
		$context->getAppContainer()->get(UserHooks::class)->register();
	}
}
