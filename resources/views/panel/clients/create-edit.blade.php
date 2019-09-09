@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $titlePage ?? 'Cadastrar Cliente' }} </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('clients.index')}}" class="breadcrumb-link">Clientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadatrar Cliente</li>
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
        @if (!empty($client))
        <form method="post" action="{{route('clients.update', $client->id)}}" enctype="multipart/form-data">
            {!! method_field('PUT') !!}
        @else
        <form method="post" action="{{route('clients.store')}}" enctype="multipart/form-data">
        @endif
            <div class="card">
                <h5 class="card-header">Informações de Cadastro</h5>
                <div class="card-body">

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="form-group">
                        <label for="name" class="col-form-label">Nome</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$client->name ?? old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-form-label">Telefone</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{$client->phone ?? old('phone')}}">
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">E-mail</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{$client->email ?? old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="modality" class="col-form-label">Modalidade</label>
                        <select id="modality" name="modality_id" class="form-control">

                            @foreach ($modalities as $id => $name)

                            <option value="{{ $id }}"
                                @if (!empty($client))

                                    @if ($id == $client->modality_id)

                                        selected

                                    @endif

                                @endif
                            >

                                {{ $name }}

                            </option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card">
                <h5 class="card-header">Abrangência</h5>

                <div class="card-body">
                    <div id="panel-client-abrangencia">
                        <panel-client-abrangencia

                            prop-app-url="{{ $appUrl }}"

                            @if (!empty($client))
                                prop-abrangencia="{{ $client->abrangencia }}"
                                prop-states="{{ $states }}"
                                prop-cities="{{ $cities }}"
                                prop-state-id="{{ $client->state_id }}"
                                prop-city-id="{{ $client->city_id }}"
                            @endif
                        >
                            Carregando...
                        </panel-client-abrangencia>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script src="{{ url('/js/manifest.js') }}"></script>
<script src="{{ url('/js/vendor.js') }}"></script>
<script src="{{ url('/js/bootstrap.js') }}"></script>
<script src="{{ url('/js/panel-client-abrangencia.js') }}"></script>
@endpush
