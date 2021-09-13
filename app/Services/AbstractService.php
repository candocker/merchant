<?php
declare(strict_types = 1);

namespace ModuleMerchant\Services;

use Framework\Baseapp\Services\AbstractService as AbstractServiceBase;

abstract class AbstractService extends AbstractServiceBase
{
    protected function getAppcode()
    {
        return 'merchant';
    }
}
