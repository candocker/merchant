<?php

declare(strict_types = 1);

namespace App\Middleware;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\Contract\ConfigInterface;
use App\Services\UserPermissionService;

class MerchantMiddleware implements MiddlewareInterface
{
    /**
     * @Inject
     * @var UserPermissionService
     */
    protected $userPermissionService;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $request->getAttribute('user');
        $service = $this->userPermissionService;
        $teamworks = $service->getTeamworks($user);
        if (empty($teamworks)) {
            $service->throwException(403, '您没有管理员权限');
        }
        $rolePermissions = $this->userPermissionService->getRolePermissions($teamworks);
        if (empty($rolePermissions)) {
            $service->throwException(403, '您没有操作权限');
        }
        $request = $request->withAttribute('teamworks', $teamworks);
        $request = $request->withAttribute('rolePermissions', $rolePermissions);
        Context::set(ServerRequestInterface::class, $request);

        return $handler->handle($request);
    }

}
