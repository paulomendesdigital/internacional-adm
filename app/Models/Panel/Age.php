<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Model;
use App\Models\Panel\Plan;

class Age extends Model
{
    protected $fillable = ['name', 'initial_age', 'final_age'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
