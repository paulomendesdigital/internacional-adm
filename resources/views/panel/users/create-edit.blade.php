@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Cadastrar Usuário </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}" class="breadcrumb-link">Usuários</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Usuário</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader  -->
<!-- ============================================================== -->

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Informações de Cadastro</h5>
            <div class="card-body">
                @if (!empty($user))
                <form method="post" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                @else
                <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                @endif

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="form-group">
                        <label for="name" class="col-form-label">Nome</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{$user->name ?? old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{$user->email ?? old('email')}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm-password">Confirmar Senha</label>
                                <input id="confirm-password" type="password" class="form-control {{ $errors->has('confirmPassword') ? 'is-invalid' : '' }}" name="confirmPassword">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary float-right">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
