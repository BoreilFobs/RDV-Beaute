<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'unit_price',
        'usage_type',
    ];
}
