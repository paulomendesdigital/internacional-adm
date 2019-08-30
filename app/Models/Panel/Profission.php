<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\Elegibilidade;
use App\Models\All\Client;

class Profission extends Model
{
    protected $fillable = ['name'];

    public function elegibilidades()
    {
        return $this->belongsToMany(Elegibilidade::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
