<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Profission;
use App\Http\Requests\Panel\ProfissionFormRequest;

class ProfissionController extends Controller
{
    private $profission;
    private $totalPage = 15;

    public function __construct(Profission $profission)
    {
        $this->profission = $profission;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem das Profissões';

        $profissions = $this->profission::orderBy('name')->paginate($this->totalPage);

        return view('panel.profissions.index', compact('profissions', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar uma nova profissão";

        return view('panel.profissions.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfissionFormRequest $request)
    {
        $data = $request->all();

        $insert = $this->profission->create($data);

        if ($insert)
            return redirect()->route('profissions.index')->withSuccess('Profissão cadastrada com sucesso');

        else
            return redirect()->route('profissions.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profission = $this->profission->find($id);

        return view('panel.profissions.show', compact('profission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profission = $this->profission->find($id);

        $title = "Editar Profissão: {$profission->name}";

        $titlePage = "Editar Profissão";

        return view('panel.profissions.create-edit', compact('title', 'titlePage', 'profission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfissionFormRequest $request, $id)
    {
        $data = $request->all();

        $profission = $this->profission->find($id);

        $update = $profission->update($data);

        if ($update)
            return redirect()->route('profissions.index')->withSuccess('Profissão editada com sucesso');

        else
            return redirect()->route('profissions.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profission = $this->profission->find($id);

        $delete = $profission->delete();

        if ($delete)
            return redirect()->route('profissions.index')->withSuccess('Profissão deletada com sucesso');

        else
            return redirect()->route('profission.index')->with(['errors' => 'Falha ao deletar']);

    }
}
