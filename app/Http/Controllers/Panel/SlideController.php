<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Slide;
use App\Http\Requests\Panel\SlideStoreRequest;
use App\Http\Requests\Panel\SlideUpdateRequest;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    private $slide;
    private $totalPage = 15;

    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Slides';

        $slides = $this->slide::orderBy('title')->paginate($this->totalPage);

        return view('panel.slides.index', compact('slides', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar um novo slide";

        return view('panel.slides.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideStoreRequest $request)
    {
        $data = $request->all();

        $data['status'] = (empty($data['status']) ? 0 : 1);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $extension = $request->image->extension();

            $nameFile = kebab_case($data['title']) . time() . '.' . $extension;

            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('slides', $nameFile);

            if (!$upload)
                return redirect()->back()->with('error', 'Falha ao realizar o upload da imagem');
        }

        $insert = $this->slide->create($data);

        if ($insert)
            return redirect()->route('slides.index')->with(['successes' => 'Slide cadastrado com sucesso']);

        else
            return redirect()->route('slides.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = $this->slide->find($id);

        return view('panel.slides.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = $this->slide->find($id);

        $title = "Editar Slide: {$slide->title}";

        return view('panel.slides.create-edit', compact('title', 'slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideUpdateRequest $request, $id)
    {
        $data = $request->all();

        $data['status'] = (empty($data['status']) ? 0 : 1);

        $slide = $this->slide->find($id);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $extension = $request->image->extension();

            $nameFile = kebab_case($data['title']) . time() . '.' . $extension;

            $data['image'] = $nameFile;

            $upload = $request->image->storeAs('slides', $nameFile);

            if (!empty($slide->image))
                Storage::delete("slides/{$slide->image}");

            if (!$upload)
                return redirect()->back()->with('error', 'Falha ao realizar o upload da imagem');
        }

        $update = $slide->update($data);

        if ($update)
            return redirect()->route('slides.index')->with(['successes' => 'Slide editado com sucesso']);

        else
            return redirect()->route('slides.edit', $id)->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = $this->slide->find($id);

        $delete = $slide->delete();

        if ($delete) {

            Storage::delete("slides/{$slide->image}");

            return redirect()->route('slides.index');

        } else {

            return redirect()->route('slide.index')->with(['errors' => 'Falha ao deletar']);
        }
    }
}
