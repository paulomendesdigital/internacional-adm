@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Criar Slide </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('slides.index')}}" class="breadcrumb-link">Slides</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Criar Slide</li>
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
                @if (!empty($slide))
                <form method="post" action="{{route('slides.update', $slide->id)}}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                @else
                <form method="post" action="{{route('slides.store')}}" enctype="multipart/form-data">
                @endif

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="form-group">
                        <label for="title" class="col-form-label">Título</label>
                        <input id="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{$slide->title ?? old('title')}}">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem</label>
                        <input id="image" type="file" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image">
                    </div>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" value="1" name="status" class="custom-control-input" @if (!empty($slide->status)) checked @endif>
                        <span class="custom-control-label"> Ativo?</span>
                    </label>

                    <button class="btn btn-primary float-right">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
