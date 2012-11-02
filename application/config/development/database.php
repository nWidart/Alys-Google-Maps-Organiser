<?php

return array(
	'profile' => false,


	/*
	|--------------------------------------------------------------------------
	| Default Database Connection
	|--------------------------------------------------------------------------
	|
	| The name of your default database connection. This connection will be used
	| as the default for all database operations unless a different name is
	| given when performing said operation. This connection name should be
	| listed in the array of connections below.
	|
	*/

	'default' => 'mysql',


	'connections' => array(
		'mysql' => array(
			'driver'   => 'mysql',
			'host'     => $_SERVER["DB1_HOST"],
			'database' => $_SERVER["DB1_NAME"],
			'username' => $_SERVER["DB1_USER"],
			'password' => $_SERVER["DB1_PASS"],
			'charset'  => 'utf8',
			'prefix'   => 'gmaps_',
		)

	),


);