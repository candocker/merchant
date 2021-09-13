<?php

declare(strict_types = 1);

namespace ModuleMerchant\Controllers;

use Framework\Baseapp\Controllers\AbstractController as AbstractControllerBase;

abstract class AbstractController extends AbstractControllerBase
{
    protected function getAppcode()
    {
        return 'merchant';
    }
}
