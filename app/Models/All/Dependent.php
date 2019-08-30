<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;
use App\Models\All\Client;

class Dependent extends Model
{
    protected $fillable = ['birth', 'client_id'];

    public function client()
    {
        return $this->belongsToMany(Client::class);
    }
}
