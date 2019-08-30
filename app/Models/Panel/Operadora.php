<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;

class Operadora extends Model
{
    protected $fillable = ['name'];
    
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
