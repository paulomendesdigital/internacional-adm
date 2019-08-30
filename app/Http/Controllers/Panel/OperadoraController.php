<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Operadora;
use App\Http\Requests\Panel\OperadoraFormRequest;

class OperadoraController extends Controller
{
    private $operadora;
    private $totalPage = 15;

    public function __construct(Operadora $operadora)
    {
        $this->operadora = $operadora;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Operadoras';

        $operadoras = $this->operadora::orderBy('name')->paginate($this->totalPage);

        return view('panel.operadoras.index', compact('operadoras', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar uma nova operadora";

        return view('panel.operadoras.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperadoraFormRequest $request)
    {
        $data = $request->all();

        $insert = $this->operadora->create($data);

        if ($insert)
            return redirect()->route('operadoras.index')->withSuccess('Operadora cadastrada com sucesso');

        else
            return redirect()->route('operadoras.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operadora = $this->operadora->find($id);

        return view('panel.operadoras.show', compact('operadora'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operadora = $this->operadora->find($id);

        $title = "Editar Operadora: {$operadora->name}";

        $titlePage = "Editar Operadora";

        return view('panel.operadoras.create-edit', compact('title', 'titlePage', 'operadora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OperadoraFormRequest $request, $id)
    {
        $data = $request->all();

        $operadora = $this->operadora->find($id);

        $update = $operadora->update($data);

        if ($update)
            return redirect()->route('operadoras.index')->withSuccess('Operadora editada com sucesso');

        else
            return redirect()->route('operadoras.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operadora = $this->operadora->find($id);

        $delete = $operadora->delete();

        if ($delete)
            return redirect()->route('operadoras.index')->withSuccess('Operadora deletada com sucesso');

        else
            return redirect()->route('operadora.index')->with(['errors' => 'Falha ao deletar']);

    }
}
