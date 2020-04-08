<?php
return [
		'routes' => [
			['name' => 'service#status', 'url' => '/service/status/{id}', 'verb' => 'GET'],
			['name' => 'service#hasDBDate', 'url' => '/service/hasDBDate/{id}', 'verb' => 'GET'],
			['name' => 'service#getDBDate', 'url' => '/service/getDBDate/{id}', 'verb' => 'GET'],
		]
];