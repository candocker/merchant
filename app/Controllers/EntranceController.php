<?php

declare(strict_types = 1);

namespace ModuleMerchant\Controllers;

class EntranceController extends AbstractController
{
    public function myRoutes()
    {
        $request = $this->request;
        $rolePermissions = $request->getAttribute('rolePermissions');
        return $this->success($rolePermissions);
    }
}
