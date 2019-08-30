@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $titlePage ?? 'Cadastrar Cidade' }} </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('cities.index')}}" class="breadcrumb-link">Cidades</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadatrar Cidade</li>
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
                @if (!empty($city))
                <form method="post" action="{{route('cities.update', $city->id)}}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                @else
                <form method="post" action="{{route('cities.store')}}" enctype="multipart/form-data">
                @endif

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nome</label>
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{$city->name ?? old('name')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Estado</label>
                                <select name="state_id" class="form-control {{ $errors->has('state_id') ? 'is-invalid' : '' }}">

                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            @if (!empty($city) && $city->state_id == $state->id)
                                                selected
                                            @endif
                                            >{{ $state->name }}</option>
                                    @endforeach

                                </select>
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
