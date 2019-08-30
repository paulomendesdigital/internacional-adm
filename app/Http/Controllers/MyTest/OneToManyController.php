<?php

namespace App\Http\Controllers\MyTest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Modality;
use App\Models\Panel\Operadora;
use App\Models\Panel\Elegibilidade;
use App\Models\Panel\Plan;

class OneToManyController extends Controller
{
    public function oneToMany()
    {
        // $modality = Modality::where('name', 'Coletivo por Adesão')->get()->first();
        $keySearch = 'a';
        $modalities = Modality::where('name', 'LIKE', "%{$keySearch}%")->with('plans')->get();

        foreach ($modalities as $modality) {
            echo "<b>{$modality->name}</b>";

            $plans = $modality->plans;
    
            foreach ($plans as $plan) {
                echo "<br>Plano: {$plan->name}";
            }

            echo '<hr>';
        }
    }

    public function manyToOne()
    {
        $planName = 'Classico QC';
        $plan = Plan::where('id', '>=', 1)->with('modality')->paginate();

        dd($plan);

        echo "<b>{$plan->name}</b>";

        $modality = $plan->modality;

        echo "<br>País: {$modality->name}";
    }

    public function oneToManyInsert()
    {
        $data = [
            'name' => 'Ideal QP'
        ];

        $modality = Modality::find(1);

        $insertPlan = $modality->plans()->create($data);
    }

    public function oneToManyInsertTwo()
    {
        $data = [
            'name' => 'Ideal QP',
            'modality_id' => '1',
            'operadora_id' => '1',
            'elegibilidade_id' => '1'
        ];

        $insertPlan = Plan::create($data);
    }
}
