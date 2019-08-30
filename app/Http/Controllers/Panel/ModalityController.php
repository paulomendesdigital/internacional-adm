<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Modality;
use App\Http\Requests\Panel\ModalityFormRequest;

class ModalityController extends Controller
{
    private $modality;
    private $totalPage = 15;

    public function __construct(Modality $modality)
    {
        $this->modality = $modality;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Modalidades';

        $modalities = $this->modality::orderBy('name')->paginate($this->totalPage);

        return view('panel.modalities.index', compact('modalities', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar uma nova modalidade";

        return view('panel.modalities.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModalityFormRequest $request)
    {
        $data = $request->all();

        $data['elegibilidade'] = (empty($data['elegibilidade']) ? 0 : 1);

        $data['pj'] = (empty($data['pj']) ? 0 : 1);

        $insert = $this->modality->create($data);

        if ($insert)
            return redirect()->route('modalities.index')->withSuccess('Modalidade cadastrada com sucesso');

        else
            return redirect()->route('modalities.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modality = $this->modality->find($id);

        return view('panel.modalities.show', compact('modality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modality = $this->modality->find($id);

        $title = "Editar Modalidade: {$modality->name}";

        $titlePage = "Editar Modalidade";

        return view('panel.modalities.create-edit', compact('title', 'titlePage', 'modality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModalityFormRequest $request, $id)
    {
        $data = $request->all();

        $data['elegibilidade'] = (empty($data['elegibilidade']) ? 0 : 1);

        $data['pj'] = (empty($data['pj']) ? 0 : 1);

        $modality = $this->modality->find($id);

        $update = $modality->update($data);

        if ($update)
            return redirect()->route('modalities.index')->withSuccess('Modalidade editada com sucesso');

        else
            return redirect()->route('modalities.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modality = $this->modality->find($id);

        $delete = $modality->delete();

        if ($delete)
            return redirect()->route('modalities.index')->withSuccess('Modalidade deletada com sucesso');

        else
            return redirect()->route('modality.index')->with(['errors' => 'Falha ao deletar']);

    }
}
