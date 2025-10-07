<?php

use App\Models\Database;

session_start();

require_once __DIR__ . '/../config/constants.php';

require APP_ROOT . '/vendor/autoload.php';

new Database();

// show all errors for now
error_reporting(E_ALL);

date_default_timezone_set('Africa/Lagos');

$GLOBALS['config'] = [
    'session' => [
        'user' => 'mvc_dicer.user',
        'user_token' => 'mvc_dicer.token',
        'user_token_expiry' => time() + (1 * 365 * 24 * 60 * 60),
    ],
    'app' => [
        'timer' => time() + (1 * 365 * 24 * 60 * 60),
    ],
];
