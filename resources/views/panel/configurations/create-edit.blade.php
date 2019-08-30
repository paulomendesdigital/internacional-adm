@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Editar Configuração </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Configuração</li>
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

        @include('includes.success')

        <div class="card">
            <h5 class="card-header">Contatos</h5>
            <div class="card-body">
                <form method="post" action="{{url('/panel/conf/update', $configuration->id)}}" enctype="multipart/form-data">

                    {!! method_field('PUT') !!}

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Telefone</label>
                                <input id="phone" type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" value="{{$configuration->phone ?? old('phone')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="whatsapp" class="col-form-label">Whatsapp</label>
                                <input id="whatsapp" type="text" class="form-control" name="whatsapp" value="{{$configuration->whatsapp ?? old('whatsapp')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{$configuration->email ?? old('email')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook" class="col-form-label">Facebook</label>
                                <input id="facebook" type="text" class="form-control" name="facebook" value="{{$configuration->facebook ?? old('facebook')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instagram" class="col-form-label">Instagram</label>
                                <input id="instagram" type="text" class="form-control" name="instagram" value="{{$configuration->instagram ?? old('instagram')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube" class="col-form-label">Youtube</label>
                                <input id="youtube" type="text" class="form-control" name="youtube" value="{{$configuration->youtube ?? old('youtube')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter" class="col-form-label">Twitter</label>
                                <input id="twitter" type="text" class="form-control" name="twitter" value="{{$configuration->twitter ?? old('twitter')}}">
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
