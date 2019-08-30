<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Age;
use App\Http\Requests\Panel\AgeFormRequest;

class AgeController extends Controller
{
    private $age;
    private $totalPage = 15;

    public function __construct(Age $age)
    {
        $this->age = $age;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Idades';

        $ages = $this->age::orderBy('name')->paginate($this->totalPage);

        return view('panel.ages.index', compact('ages', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar uma nova faixa etária";

        return view('panel.ages.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgeFormRequest $request)
    {
        $data = $request->all();

        $insert = $this->age->create($data);

        if ($insert)
            return redirect()->route('ages.index')->withSuccess('Idade cadastrada com sucesso');

        else
            return redirect()->route('ages.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $age = $this->age->find($id);

        return view('panel.ages.show', compact('age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Age $age)
    {

        $title = "Editar Idade: {$age->name}";

        $titlePage = "Editar Idade";

        return view('panel.ages.create-edit', compact('title', 'titlePage', 'age'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgeFormRequest $request, $id)
    {
        $data = $request->all();

        $age = $this->age->find($id);

        $update = $age->update($data);

        if ($update)
            return redirect()->route('ages.index')->withSuccess('Idade editada com sucesso');

        else
            return redirect()->route('ages.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $age = $this->age->find($id);

        $delete = $age->delete();

        if ($delete)
            return redirect()->route('ages.index')->withSuccess('Idade deletada com sucesso');

        else
            return redirect()->route('age.index')->with(['errors' => 'Falha ao deletar']);

    }
}
