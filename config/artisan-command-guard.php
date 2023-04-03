<?php

/**
 * An array of environments with the commands that you want to prevent running on
 */ 
return [
	'environments' => [
		'production' => [
			'migrate:refresh',
			'migrate:fresh',
			'migrate:reset',
		],
	],

	'enable_log_user' => true,
];
