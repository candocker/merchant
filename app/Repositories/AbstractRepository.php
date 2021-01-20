<?php
declare(strict_types = 1);

namespace App\Repositories;

use Swoolecan\Baseapp\Repositories\AbstractRepository as AbstractRepositoryBase;

/**
 * Class AbstractRepository
 */
class AbstractRepository extends AbstractRepositoryBase
{
    public function getDefaultShowFields()
    {
        return array_merge(parent::getDefaultShowFields(), [
            //'user_id' => ['valueType' => 'common'],
        ]);
    }

}
