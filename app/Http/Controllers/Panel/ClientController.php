<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\All\Client;
use App\Models\Panel\State;
use App\Models\Panel\Plan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientExport;
use DateTime;

// use App\Http\Requests\Panel\ClientFormRequest;

class ClientController extends Controller
{
    private $client;
    private $totalPage = 15;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function export()
    {
        $export = Excel::download(new ClientExport, 'Clientes.xlsx');

        return $export;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Clientes';

        $clients = $this->client::with('state', 'city', 'modality')->orderBy('name')->paginate($this->totalPage);

        return view('panel.clients.index', compact('clients', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar um novo cliente";

        $plans = Plan::with('modality')->get();

        $modalities = $this->getModalitiesOfPlans($plans);

        return view('panel.clients.create-edit', compact('title', 'modalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $insert = $this->client->create($data);

        if ($insert)
            return redirect()->route('clients.index')->withSuccess('Cliente cadastrado com sucesso');

        else
            return redirect()->route('clients.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $client = $this->client::where('id', $id)->with('modality', 'profission', 'state', 'city', 'dependents')->get()->first();

        $age = '';

        $birth = new DateTime($client->birth);

        $today = new DateTime('now');

        $diff = $birth->diff($today);

        $client->birth = $birth->format('d/m/Y');

        $age = $diff->y;

        $numDependents = $client->dependents->count();

        $dependents = [];

        if ($numDependents > 0) {

            $i = 0;

            foreach ($client->dependents as $dependent) {

                $birth = new DateTime($dependent->birth);

                $diff = $birth->diff($today);

                $dependents[$i]['birth'] = $birth->format('d/m/Y');
                $dependents[$i]['age'] = $diff->y;

                $i++;

            }
        }

        return view('panel.clients.view', compact('client', 'age', 'numDependents', 'dependents'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('panel.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $plans = Plan::with('modality')->get();

        $modalities = $this->getModalitiesOfPlans($plans);

        $statesWithCities = State::with('cities')->get();

        $statesCities = $this->getStatesAndCities($statesWithCities);

        $states = $statesCities['states'];

        $cities = $statesCities['cities'];

        $title = "Editar Cliente: {$client->name}";

        $titlePage = "Editar Cliente";

        return view('panel.clients.create-edit', compact('title', 'titlePage', 'client', 'states', 'cities', 'modalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($data['abrangencia'] == '1') {

            $data['state_id'] = NULL;

            $data['city_id'] = NULL;
        }

        $client = $this->client->find($id);

        $update = $client->update($data);

        if ($update)
            return redirect()->route('clients.index')->withSuccess('Cliente editado com sucesso');

        else
            return redirect()->route('clients.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $delete = $client->delete();

        if ($delete)
            return redirect()->route('clients.index')->withSuccess('Cliente deletado com sucesso');

        else
            return redirect()->route('client.index')->with(['errors' => 'Falha ao deletar']);

    }

    private function getModalitiesOfPlans($plans)
    {
        $modalities = [];

        foreach ($plans as $plan) {

            $modalities[$plan->modality->id] = $plan->modality->name;

        }

        return $modalities;
    }

    private function getStatesAndCities($statesWithCities)
    {
        $cities = [];
        $states = [];

        foreach ($statesWithCities as $state) {

            $states[$state->id] = $state->name;

            foreach ($state->cities as $city) {

                $cities[$city->id] = $city->name;

            }
        }

        $states = json_encode($states);
        $cities = json_encode($cities);

        $statesCities['states'] = $states;
        $statesCities['cities'] = $cities;

        return $statesCities;
    }
}
