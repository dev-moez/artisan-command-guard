<?php

/**
 * An array of environments with the commands that you want to prevent running on
 */ 
return [
	'production' => [
		'migrate:refresh',
		'migrate:fresh',
		'migrate:reset',
	],
];
