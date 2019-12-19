<?php
namespace OCA\GeoBlocker\AppInfo;

$app = new Application();
$app->getContainer()->query('UserHooks')->register();
