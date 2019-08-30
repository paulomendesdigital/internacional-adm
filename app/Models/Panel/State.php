<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\City;
use App\Models\Panel\Plan;
use App\Models\All\Client;

class State extends Model
{
    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
