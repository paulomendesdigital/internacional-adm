<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Plan;
use App\Models\Panel\Modality;
use App\Models\Panel\Operadora;
use App\Models\Panel\Elegibilidade;
use App\Models\Panel\Age;
use App\Http\Requests\Panel\PlanFormRequest;
use App\Models\Panel\State;
use App\Traits\Price;

class PlanController extends Controller
{
    use Price;

    private $plan;
    private $totalPage = 15;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Planos';

        $plans = $this->plan::with('modality', 'operadora', 'elegibilidade', 'state')->orderBy('name')->paginate($this->totalPage);

        return view('panel.plans.index', compact('plans', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar um novo plano";

        $modalities = Modality::all();

        $operadoras = Operadora::all();

        $elegibilidades = Elegibilidade::all();

        $ages = Age::orderBy('name')->get();

        return view('panel.plans.create-edit', compact('title', 'modalities', 'operadoras', 'elegibilidades', 'ages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanFormRequest $request)
    {
        $data = $request->all();

        $plan = $this->plan->create($data);

        $agesPrices = $this->formatPriceToDB($data['price']);

        $plan->ages()->sync($agesPrices);

        if (!empty($data['cities']))
            $plan->cities()->sync($data['cities']);

        if ($plan)
            return redirect()->route('plans.index')->withSuccess('Plano cadastrado com sucesso');

        else
            return redirect()->route('plans.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('panel.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->plan->where('id', $id)->with('modality', 'elegibilidade', 'operadora', 'ages', 'state', 'cities')->get()->first();

        if (!$plan) {

            return redirect()->route('plans.index')->withErrors(['O plano informado não está no sistema']);

        } else {

            $state = [];
            $cities = '';

            if (count($plan->cities) > 0) {

                $state = State::where('id', $plan->state->id)->with('cities')->get()->first();

                $cities = $this->getCitiesCheckedAndUnchecked($state, $plan);

            }

            $prices = $this->getPricesFromPlanAges($plan->ages);

            $prices = $this->formatPriceToView($prices);

            $title = "Editar Plano: {$plan->name}";

            $titlePage = "Editar Plano";

            $modalities = Modality::all();

            $elegibilidades = Elegibilidade::all();

            $operadoras = Operadora::all();

            $ages = Age::orderBy('name')->get();

            return view('panel.plans.create-edit', compact('title', 'titlePage', 'plan', 'modalities', 'elegibilidades', 'operadoras', 'ages', 'prices','cities', 'state'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanFormRequest $request, $id)
    {
        $data = $request->all();

        $plan = $this->plan->find($id);

        $agesPrices = $this->formatPriceToDB($data['price']);

        if ($data['abrangencia'] == '1') {

            $data['state_id'] = NULL;

            $data['cities'] = [];
        }

        $update = $plan->update($data);

        $plan->ages()->sync($agesPrices);

        $plan->cities()->sync($data['cities']);

        if ($update)
            return redirect()->route('plans.index')->withSuccess('Plano editado com sucesso');

        else
            return redirect()->route('plans.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $delete = $plan->delete();

        if ($delete)
            return redirect()->route('plans.index')->withSuccess('Plano deletado com sucesso');

        else
            return redirect()->route('plan.index')->with(['errors' => 'Falha ao deletar']);

    }

    private function getCitiesCheckedAndUnchecked($state, $plan)
    {
        $cities = [];
        $i = 0;

        foreach ($state->cities as $city) {
            $cities[$i] = ['id' => $city->id, 'name' => $city->name, 'check' => ''];

            foreach ($plan->cities as $planCity) {

                if ($city->id == $planCity->id)
                    $cities[$i] = ['id' => $city->id, 'name' => $city->name, 'check' => 'checked'];

            }

            $i++;
        }

        return $cities = json_encode($cities);
    }

    private function getPricesFromPlanAges($ages)
    {
        $prices = [];

        foreach ($ages as $age) {

            $prices[$age->pivot->age_id] = $age->pivot->price;

        }

        return $prices;
    }
}
