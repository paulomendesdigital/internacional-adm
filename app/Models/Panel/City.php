<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\State;
use App\Models\Panel\Plan;
use App\Models\All\Client;

class City extends Model
{
    protected $fillable = ['state_id', 'name'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
