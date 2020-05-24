<?php

namespace OCA\GeoBlocker\AppInfo;

use OCP\AppFramework\App;
use OCA\GeoBlocker\Hooks\UserHooks;

class Application extends App {

	public function __construct(array $urlParams = array()) {
		parent::__construct('geoblocker', $urlParams);

		$container = $this->getContainer();

		/**
		 * Controllers
		 */
		$container->registerService('UserHooks',
				function ($c) {
					return new UserHooks(
							$c->query('ServerContainer')->getUserSession(),
							$c->query('ServerContainer')->getLogger(),
							$c->query('ServerContainer')->getRequest(),
							$c->query('ServerContainer')->getConfig(),
							$c->query('ServerContainer')->getL10N('geoblocker'),
							$c->query('ServerContainer')->getDatabaseConnection());
				});
	}
}
