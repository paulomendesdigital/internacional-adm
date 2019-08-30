<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\Profission;
use App\Models\Panel\Plan;

class Elegibilidade extends Model
{
    protected $fillable = ['name'];

    public function profissions()
    {
        return $this->belongsToMany(Profission::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
