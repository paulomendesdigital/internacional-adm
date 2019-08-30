<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\State;
use App\Models\Panel\City;
use App\Models\Panel\Modality;
use App\Models\Panel\Profission;
use App\Models\All\Dependent;

class Client extends Model
{
    protected $fillable = ['state_id', 'city_id', 'modality_id', 'profission_id', 'name', 'phone', 'email', 'birth', 'abrangencia'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function profission()
    {
        return $this->belongsTo(Profission::class);
    }

    public function dependents()
    {
        return $this->hasMany(Dependent::class);
    }
}
