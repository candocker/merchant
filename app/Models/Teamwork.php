<?php

declare(strict_types = 1);

namespace ModuleMerchant\Models;

class Teamwork extends AbstractModel
{
    protected $table = 'teamwork';
    protected $fillable = ['name'];

    public function checkEnable()
    {
        return $this->status == 'confirm';
    }

    public function roleManagers()
    {
        return $this->hasMany(RoleManager::class, 'manager_id', 'id');
    }
}
