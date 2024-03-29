<?php

declare(strict_types = 1);

namespace ModuleMerchant\Models;

class Merchant extends AbstractModel
{
    protected $table = 'merchant';
    protected $fillable = ['name', 'code'];

}
