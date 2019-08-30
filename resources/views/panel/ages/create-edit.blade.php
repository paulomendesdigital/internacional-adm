@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $titlePage ?? 'Cadastrar Idade' }} </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('ages.index')}}" class="breadcrumb-link">Idades</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadatrar Idade</li>
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
                @if (!empty($age))
                <form method="post" action="{{route('ages.update', $age->id)}}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                @else
                <form method="post" action="{{route('ages.store')}}" enctype="multipart/form-data">
                @endif

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="form-group">
                        <label for="name" class="col-form-label">Nome</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{$age->name ?? old('name')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="initial_age" class="col-form-label">Idade Inicial</label>
                                <input id="initial_age" type="number" class="form-control {{ $errors->has('initial_age') ? 'is-invalid' : '' }}" name="initial_age" value="{{$age->initial_age ?? old('initial_age')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="final_age" class="col-form-label">Idade Final</label>
                                <input id="final_age" type="number" class="form-control {{ $errors->has('final_age') ? 'is-invalid' : '' }}" name="final_age" value="{{$age->final_age ?? old('final_age')}}">
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
