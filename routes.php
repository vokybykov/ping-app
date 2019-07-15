<?php
	$routes = [
		'servers/create' => 'ServerController@create',
		'' => 'GroupController@index',
		'groups/create' => 'GroupController@create',
		'history' => 'HistoryController@index',
		'history/export' => 'HistoryController@export',
		'groups/ping' => 'GroupController@ping',
		
	];
	
	return $routes;