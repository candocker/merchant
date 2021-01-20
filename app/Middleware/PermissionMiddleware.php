<?php

declare(strict_types = 1);

namespace App\Middleware;

use Hyperf\Di\Annotation\Inject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\Contract\ConfigInterface;
use App\Services\UserPermissionService;

class PermissionMiddleware implements MiddlewareInterface
{
    /**
     * @Inject
     * @var UserPermissionService
     */
    protected $userPermissionService;

    /**
     * @Inject
     * @var ConfigInterface
     */
    protected $config;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $service = $this->userPermissionService;
        //去掉路由参数
        $dispatcher = $request->getAttribute('Hyperf\HttpServer\Router\Dispatched');
        $routeCode = $dispatcher->handler->options['routeCode'];
        //$app = $this->config->get('app_name');
        //$method = $request->getMethod();
        $permission = $service->getPointPermission($routeCode);//$app, $route, $method);
        if (empty($permission)) {
            $service->throwException(400, '操作不存在');
        }
        $rolePermissions = $request->getAttribute('rolePermissions');

        $check = $service->checkPermissionTo($permission, $rolePermissions);
        if (empty($check)) {
            $service->throwException(403, '无权进行该操作');
        }
        return $handler->handle($request);
    }
}
