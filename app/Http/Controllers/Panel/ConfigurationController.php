<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panel\Configuration;
use App\Http\Requests\Panel\ConfigurationUpdateRequest;

class ConfigurationController extends Controller
{
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configuration = $this->configuration->find($id);

        $title = "Editar Usuário: {$configuration->name}";

        return view('panel.configurations.create-edit', compact('title', 'configuration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfigurationUpdateRequest $request, $id)
    {
        $data = $request->all();

        $configuration = $this->configuration->find($id);

        $update = $configuration->update($data);

        if ($update)
            return redirect("/panel/conf/edit/{$id}")->withSuccess('Configuração editada com sucesso');

        else
            return redirect("/panel/conf/edit/{$id}")->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }
}
