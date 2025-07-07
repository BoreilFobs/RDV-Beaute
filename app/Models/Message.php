<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "message",
        "email",
        "name",
        "read_at",
    ];
}
