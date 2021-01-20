<?php

declare(strict_types = 1);

namespace App\Models;

class Company extends AbstractModel
{
    protected $table = 'company';
    protected $fillable = ['name'];

}
