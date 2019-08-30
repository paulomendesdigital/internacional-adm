<?php

namespace App\Http\Controllers\MyTest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Age;
use App\Models\Panel\Plan;

class ManyToMany extends Controller
{
    public function manyToMany()
    {
        $age = Age::Where('name', '19 - 23')->get()->first();

        echo "<b>{$age->name}</b>";
        
        $plans = $age->plans()->get();

        foreach ($plans as $plan) {
            echo "<br>{$plan->name}";
        }
    }

    public function manyToManyInverse()
    {
        $plan = Plan::Where('name', 'Ideal QC')->get()->first();

        echo "<b>{$plan->name}</b>";
        
        $ages = $plan->ages()->get();

        foreach ($ages as $age) {
            echo "<br>{$age->name}";
        }
    }

    public function manyToManyInsert()
    {
        $data = ['1', '2'];

        $plan = Plan::find(3);

        echo "<b>{$plan->name}</b>";

        $plan->ages()->sync($data);

        $ages = $plan->ages()->get();

        foreach ($ages as $age) {
            echo "<br>{$age->name}";
        }
    }
}
