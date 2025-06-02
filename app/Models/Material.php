<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        "name",
        "arrival_date",
        "arrival_quantity",
        "total_quantity",
        "leftover",
    ];
}
