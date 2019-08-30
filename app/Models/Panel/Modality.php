<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\Plan;
use App\Models\All\Client;

class Modality extends Model
{
    protected $fillable = ['name', 'elegibilidade', 'pj'];
    
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
