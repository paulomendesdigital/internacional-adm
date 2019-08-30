<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\State;
use App\Http\Requests\Panel\StateFormRequest;
use App\Models\Panel\Plan;

class StateController extends Controller
{
    private $state;
    private $totalPage = 15;

    public function __construct(State $state)
    {
        $this->state = $state;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Estados';

        $states = $this->state::orderBy('name')->paginate($this->totalPage);

        return view('panel.states.index', compact('states', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar um novo estado";

        return view('panel.states.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateFormRequest $request)
    {
        $data = $request->all();

        $insert = $this->state->create($data);

        if ($insert)
            return redirect()->route('states.index')->withSuccess('Estado cadastrado com sucesso');

        else
            return redirect()->route('states.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $state = $this->state->find($id);

        return view('panel.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = $this->state->find($id);

        $title = "Editar Estado: {$state->name}";

        $titlePage = "Editar Estado";

        return view('panel.states.create-edit', compact('title', 'titlePage', 'state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateFormRequest $request, $id)
    {
        $data = $request->all();

        $state = $this->state->find($id);

        $update = $state->update($data);

        if ($update)
            return redirect()->route('states.index')->withSuccess('Estado editado com sucesso');

        else
            return redirect()->route('states.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = $this->state->find($id);

        $delete = $state->delete();

        if ($delete)
            return redirect()->route('states.index')->withSuccess('Estado deletado com sucesso');

        else
            return redirect()->route('state.index')->with(['errors' => 'Falha ao deletar']);

    }

    public function getStates()
    {
        $states = $this->state::orderBy('name')->get();

        foreach ($states as $state) {

            $statesClient[$state->id] = $state->name;
        }

        return $statesClient;
    }

    public function getCitiesByState($id)
    {
        $stateCities = $this->state::where('id', $id)->with('cities')->get()->first();

        return $stateCities->cities;
    }

    public function getCitiesByStateClient($id)
    {
        $stateCities = $this->state::where('id', $id)->with('cities')->get()->first();

        $cities = [];

        foreach ($stateCities->cities as $city) {

            $cities[$city->id] = $city->name;
        }

        return $cities;
    }

    public function getStatesWithPlans()
    {
        $states = $this->state::with('plans')->orderBy('name')->get();

        $statesPlans = [];

        foreach ($states as $state) {

            if (count($state->plans) > 0) {

                $statesPlans[$state->id] = $state->name;

            }
        }

        return $statesPlans;
    }

    public function getCitiesByStateWithPlans($id)
    {
        $plansCities = Plan::with('cities')->where('state_id', $id)->get();

        $cities = [];

        if (!$plansCities)
            return $cities;


        foreach ($plansCities as $planCity) {

            foreach ($planCity->cities as $city) {

                $cities[$city->id] = $city->name;

            }
        }

        return $cities;
    }
}
