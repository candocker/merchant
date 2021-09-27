<?php
declare(strict_types = 1);

namespace ModuleMerchant\Repositories;

class CompanyRepository extends AbstractRepository
{

    protected function _sceneFields()
    {
        return [
            'list' => ['id', 'name', 'code', 'region_code'],
        ];
    }
}
