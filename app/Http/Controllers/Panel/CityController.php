<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\City;
use App\Http\Requests\Panel\CityFormRequest;
use App\Models\Panel\State;

class CityController extends Controller
{
    private $city;
    private $totalPage = 15;

    public function __construct(City $city)
    {
        $this->city = $city;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem das Cidades';

        $cities = $this->city::with('state')->orderBy('name')->paginate($this->totalPage);

        return view('panel.cities.index', compact('cities', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar uma nova cidade";

        $states = State::orderBy('name')->get();

        return view('panel.cities.create-edit', compact('title', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityFormRequest $request)
    {
        $data = $request->all();

        $insert = $this->city->create($data);

        if ($insert)
            return redirect()->route('cities.index')->withSuccess('Cidade cadastrada com sucesso');

        else
            return redirect()->route('cities.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = $this->city->find($id);

        return view('panel.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = $this->city->find($id);

        $states = State::orderBy('name')->get();

        $title = "Editar Cidade: {$city->name}";

        $titlePage = "Editar Cidade";

        return view('panel.cities.create-edit', compact('title', 'titlePage', 'city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityFormRequest $request, $id)
    {
        $data = $request->all();

        $city = $this->city->find($id);

        $update = $city->update($data);

        if ($update)
            return redirect()->route('cities.index')->withSuccess('Cidade editada com sucesso');

        else
            return redirect()->route('cities.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = $this->city->find($id);

        $delete = $city->delete();

        if ($delete)
            return redirect()->route('cities.index')->withSuccess('Cidade deletada com sucesso');

        else
            return redirect()->route('city.index')->with(['errors' => 'Falha ao deletar']);

    }
}
