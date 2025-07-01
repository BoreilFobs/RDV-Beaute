<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = [
        "user_id",
        "offer_id",
        "date",
        "time",
        "name",
        "phone",
        "special_requests",
        "status",
    ];

    public function offer()
    {
        return $this->belongsTo(\App\Models\Offers::class, 'offer_id');
    }
}
