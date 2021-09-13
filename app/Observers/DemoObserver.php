<?php

declare(strict_types = 1);

namespace ModuleMerchant\Observers;

use ModuleMerchant\Models\Demo;

class DemoObserver
{
    public function deleting(Demo $model)
    {
        //return $model->canDelete();
    }
}
