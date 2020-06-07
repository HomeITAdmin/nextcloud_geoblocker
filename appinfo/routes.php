<?php
return [
	'routes' => [
		['name' => 'service#status','url' => '/service/status/{id}',
			'verb' => 'GET'],
		['name' => 'service#hasDatabaseDate',
			'url' => '/service/hasDatabaseDate/{id}','verb' => 'GET'],
		['name' => 'service#getDatabaseDate',
			'url' => '/service/getDatabaseDate/{id}','verb' => 'GET'],
		['name' => 'service#hasConfigurationOption',
			'url' => '/service/hasConfigurationOption/{id}','verb' => 'GET'],
		['name' => 'service#hasDatabaseFileLocation',
			'url' => '/service/hasDatabaseFileLocation/{id}','verb' => 'GET'],
		['name' => 'service#getDatabaseFileLocation',
			'url' => '/service/getDatabaseFileLocation/{id}','verb' => 'GET'],
		['name' => 'service#getUniqueServiceString',
			'url' => '/service/getUniqueServiceString/{id}','verb' => 'GET'],
		['name' => 'service#hasDatabaseUpdate',
			'url' => '/service/hasDatabaseUpdate/{id}','verb' => 'GET'],
		['name' => 'service#updateDatabase',
			'url' => '/service/updateDatabase/{id}','verb' => 'GET'],
		['name' => 'service#getDatabaseUpdateStatus',
			'url' => '/service/getDatabaseUpdateStatus/{id}','verb' => 'GET'],
		['name' => 'service#getDatabaseUpdateStatusString',
			'url' => '/service/getDatabaseUpdateStatusString/{id}',
			'verb' => 'GET']]];
		
		