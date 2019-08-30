<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Panel\UserStoreRequest;
use App\Http\Requests\Panel\UserUpdateRequest;

class UserController extends Controller
{
    private $user;
    private $totalPage = 15;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Usuários';
        $users = $this->user::orderBy('name')->paginate($this->totalPage);

        return view('panel.users.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar um novo usuário";

        return view('panel.users.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();

        if ($data['password'] != $data['confirmPassword'])
            return redirect()->route('users.create')->withErrors(['A senha e a confirmação da senha devem ser iguais']);

        unset($data['confirmPassword']);

        $data['password'] = bcrypt($data['password']);

        $insert = $this->user->create($data);

        if ($insert)
            return redirect()->route('users.index')->withSuccess('Usuário cadastrado com sucesso');
        else
            return redirect()->route('users.create')->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        return view('panel.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        $title = "Editar Usuário: {$user->name}";

        return view('panel.users.create-edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->all();

        if (!empty($data['password'])) {
            if ($data['password'] != $data['confirmPassword']) {
                return redirect()->route('users.create')->withErrors(['A senha e a confirmação da senha devem ser iguais']);
            }

            $data['password'] = bcrypt($data['password'])->withInput()->withErrors('Ocorreu um erro interno. Por favor, tente novamente');
        }

        unset($data['confirmPassword']);

        $user = $this->user->find($id);

        if (empty($data['password']))
            $data['password'] = $user->password;

        $update = $user->update($data);

        if ($update)
            return redirect()->route('users.index')->withSuccess('Usuário editado com sucesso');
        else
            return redirect()->route('users.edit', $id)->withErrors(['Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        $delete = $user->delete();

        if ($delete) {
            return redirect()->route('users.index')->withSuccess('Usuário deletado com sucesso');
        } else {
            return redirect()->route('user.index')->withErrors(['Falha ao deletar']);
        }
    }
}
