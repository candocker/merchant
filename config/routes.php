<?php

declare(strict_types = 1);

use Hyperf\HttpServer\Router\Router;
use Swoolecan\Baseapp\Helpers\SysOperation;
use Swoolecan\Baseapp\Helpers\ResourceContainer;
$resource = make(ResourceContainer::class);

$middlewareAuth = [
    App\Middleware\JWTAuthMiddleware::class,
];
$middlewareBackend = array_merge($middlewareAuth, [
    App\Middleware\BackendMiddleware::class,
    App\Middleware\PermissionMiddleware::class,
]);

//Router::get('/myinfo', 'App\Controllers\UserController@myinfo', ['middleware' => $middlewareAuth]);
//Router::post('/refresh_token', 'App\Controllers\EntranceController@refreshToken', ['middleware' => $middlewareAuth]);

$routes = $resource->initRouteDatas();
Router::addGroup('', function () use ($middlewareBackend, $routes) {
    foreach ($routes as $rCode => $rMethods) {
        foreach ($rMethods as $action => $data) {
            echo implode(',', $data['method']) . '==' . $data['path'] . '==' . $data['callback'] . "\n";
            Router::addRoute($data['method'], $data['path'], $data['callback'], ['middleware' => $middlewareBackend, 'routeCode' => $data['code']]);
        }
    }
});
