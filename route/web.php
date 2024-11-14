<?php
require_once('config/init.php');

use Buki\Router\Router;
use Controllers\AuthController;
use Controllers\IndexController;
use Controllers\TestController;
use Symfony\Component\HttpFoundation\Request;

$router = new Router([
	'base_folder' => APP_ROOT,
	'main_method' => 'home',
	'paths' => [
		'controllers' => 'app/controllers',
		'middlewares' => 'app/middlewares',
	],
	'namespaces' => [
		'controllers' => 'Controllers',
		'middlewares' => 'Models',
	]
]);

$router->controller('/test', TestController::class);
$router->controller('/', IndexController::class);

$router->notFound(function () {
	// your codes.
	return 'Error! not found!';
});

$router->error(function (Request $request, Exception $e) {
	// your codes.
	return $e->getMessage();
});

$router->run();

// Alerts::displayError();