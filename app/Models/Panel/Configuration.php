<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'phone', 'whatsapp', 'email', 'facebook', 'instagram', 'youtube', 'twitter'
    ];
}
