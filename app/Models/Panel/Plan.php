<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\Modality;
use App\Models\Panel\Operadora;
use App\Models\Panel\Elegibilidade;
use App\Models\Panel\Age;
use App\Models\Panel\State;
use App\Models\Panel\City;

class Plan extends Model
{
    protected $fillable = ['modality_id', 'operadora_id', 'elegibilidade_id', 'state_id', 'name', 'abrangencia'];

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function operadora()
    {
        return $this->belongsTo(Operadora::class);
    }

    public function elegibilidade()
    {
        return $this->belongsTo(Elegibilidade::class);
    }

    public function ages()
    {
        return $this->belongsToMany(Age::class)->withPivot('price');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
}
