<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'title', 'image', 'status'
    ];
}
