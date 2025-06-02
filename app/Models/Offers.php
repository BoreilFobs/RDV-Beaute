<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = [
        "name",
        "cost",
        "duration",
        "category",
        "img_path",
    ];
}
