@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $titlePage ?? 'Cadastrar Modalidade' }} </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('modalities.index')}}" class="breadcrumb-link">Modalidades</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadatrar Modalidade</li>
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
                @if (!empty($modality))
                <form method="post" action="{{route('modalities.update', $modality->id)}}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                @else
                <form method="post" action="{{route('modalities.store')}}" enctype="multipart/form-data">
                @endif

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="form-group">
                        <label for="name" class="col-form-label">Nome</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{$modality->name ?? old('name')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" value="1" name="elegibilidade" class="custom-control-input" @if (!empty($modality->elegibilidade)) checked @endif>
                                <span class="custom-control-label"> Elegibilidade?</span>
                            </label>
                        </div>

                        <div class="col-md-3">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" value="1" name="pj" class="custom-control-input" @if (!empty($modality->pj)) checked @endif>
                                <span class="custom-control-label"> PJ?</span>
                            </label>
                        </div>
                    </div>

                    <button class="btn btn-primary float-right">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
