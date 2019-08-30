<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Elegibilidade;
use App\Http\Requests\Panel\ElegibilidadeFormRequest;
use App\Models\Panel\Profission;

class ElegibilidadeController extends Controller
{
    private $elegibilidade;
    private $totalPage = 15;

    public function __construct(Elegibilidade $elegibilidade)
    {
        $this->elegibilidade = $elegibilidade;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Elegibilidades';

        $elegibilidades = $this->elegibilidade::orderBy('name')->paginate($this->totalPage);

        return view('panel.elegibilidades.index', compact('elegibilidades', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar uma nova elegibilidade";

        $profissions = Profission::all();

        return view('panel.elegibilidades.create-edit', compact('title', 'profissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ElegibilidadeFormRequest $request)
    {
        $data = $request->all();

        if (empty($data['profissions']))
            $profissions = [];

        else
            $profissions = $data['profissions'];

        $elegibilidade = $this->elegibilidade->create($data);

        $elegibilidade->profissions()->sync($profissions);

        if ($elegibilidade)
            return redirect()->route('elegibilidades.index')->withSuccess('Elegibilidade cadastrada com sucesso');

        else
            return redirect()->route('elegibilidades.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elegibilidade = $this->elegibilidade->find($id);

        return view('panel.elegibilidades.show', compact('elegibilidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $elegibilidade = $this->elegibilidade::where('id', $id)->with('profissions')->get()->first();

        $title = "Editar Elegibilidade: {$elegibilidade->name}";

        $titlePage = "Editar Elegibilidade";

        $profissions = Profission::all();

        foreach ($profissions as $profession)

        return view('panel.elegibilidades.create-edit', compact('title', 'titlePage', 'elegibilidade', 'profissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ElegibilidadeFormRequest $request, $id)
    {
        $data = $request->all();

        if (empty($data['profissions']))
            $profissions = [];

        else
            $profissions = $data['profissions'];

        $elegibilidade = $this->elegibilidade->find($id);

        $update = $elegibilidade->update($data);

        if ($update) {
            $elegibilidade->profissions()->sync($profissions);

            if ($elegibilidade)
                return redirect()->route('elegibilidades.index')->withSuccess('Elegibilidade editada com sucesso');

            else
                return redirect()->route('elegibilidades.edit', $id)->withErrors('Falha ao editar as profissões');

        } else {

            return redirect()->route('elegibilidades.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elegibilidade = $this->elegibilidade->find($id);

        $delete = $elegibilidade->delete();

        if ($delete)
            return redirect()->route('elegibilidades.index')->withSuccess('Elegibilidade deletada com sucesso');

        else
            return redirect()->route('elegibilidade.index')->with(['errors' => 'Falha ao deletar']);

    }
}
