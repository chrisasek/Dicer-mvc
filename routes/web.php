<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Test\TestController;
use Buki\Router\Router;
use Symfony\Component\HttpFoundation\Request;

$router = new Router([
    'base_folder' => APP_ROOT,
    'main_method' => 'home',
    'paths' => [
        'controllers' => 'app/Http/Controllers',
        'middlewares' => 'app/Http/Middleware',
    ],
    'namespaces' => [
        'controllers' => 'App\\Http\\Controllers',
        'middlewares' => 'App\\Http\\Middleware',
    ],
]);

$router->controller('/test', TestController::class);
$router->controller('/', IndexController::class);

$router->notFound(function () {
    return 'Error! not found!';
});

$router->error(function (Request $request, Exception $e) {
    return $e->getMessage();
});

$router->run();
