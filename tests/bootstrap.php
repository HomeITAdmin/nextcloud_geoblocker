<?php

declare(strict_types=1);

use OCP\App\IAppManager;
use OCP\Server;

require_once __DIR__ . '/../../../lib/base.php';
require_once __DIR__ . '/../../../tests/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

Server::get(IAppManager::class)->loadApp('geoblocker');
