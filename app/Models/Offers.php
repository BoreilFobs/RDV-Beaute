<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = [
        "name",
        "cost",
        "description",
        "duration",
        "category_id",
        "img_path",
    ];

    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointments::class, 'offer_id');
    }
}
