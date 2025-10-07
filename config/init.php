<?php

use Models\Database;

session_start();

require_once('site_constants.php');
require APP_ROOT . '/vendor/autoload.php';

new Database();

// show all errors for now
error_reporting(E_ALL);

// Using African time zone
date_default_timezone_set('Africa/Lagos');

// global configuration array
$GLOBALS['config'] = array(
	'session' => array(
		'user' => 'mvc_dicer.user',
		'user_token' => 'mvc_dicer.token',
		'user_token_expiry' => time() + (1 * 365 * 24 * 60 * 60) // 1 Year
	),

	'app' => array(
		'timer' => time() + (1 * 365 * 24 * 60 * 60),
	)
);
