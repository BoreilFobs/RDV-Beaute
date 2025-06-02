<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferMaterial extends Model
{
    protected $fillable = [
        "offer_id",
        "material_id",
        "quantity",
    ];
}
