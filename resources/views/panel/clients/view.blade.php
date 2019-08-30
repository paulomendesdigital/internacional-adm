@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $titlePage ?? 'Client' }} </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('clients.index')}}" class="breadcrumb-link">Clientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cliente</li>
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
            <h5 class="card-header">Informações do cliente</h5>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <span class="font-weight-bold">Nome:</span>
                        {{ $client->name }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <span class="font-weight-bold">Telefone:</span>
                        {{ $client->phone }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <span class="font-weight-bold">E-mail:</span>
                        {{ $client->email }}
                    </div>

                    @if (!empty($client->birth))

                        <div class="col-md-6 mb-3">
                            <span class="font-weight-bold">Dt. Nascimento:</span>
                            {{ $client->birth }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <span class="font-weight-bold">Idade:</span>
                            {{ $age }}
                        </div>

                    @else

                        <div class="col-md-6 mb-3">
                            <span class="font-weight-bold">Dt. Nascimento:</span>
                            -
                        </div>

                        <div class="col-md-6 mb-3">
                            <span class="font-weight-bold">Idade:</span>
                            -
                        </div>

                    @endif

                    <div class="col-md-6 mb-3">
                        <span class="font-weight-bold">Modalidade:</span>
                        {{ $client->modality->name }}
                    </div>

                    <div class="col-md-6 mb-3">
                        <span class="font-weight-bold">Profissão:</span>

                        @if (!empty($client->profission_id))

                            {{ $client->profission->name }}

                        @else

                            -

                        @endif
                    </div>

                    <div class="col-md-6 mb-3">
                        <span class="font-weight-bold">Abrangência:</span>

                        @if ($client->abrangencia == 1)

                            Nacional

                        @elseif ($client->abrangencia == 2)

                            Regional

                        @endif
                    </div>

                </div>
            </div>
        </div>

        @if ($client->abrangencia == 2)
            <div class="card">
                <h5 class="card-header">Abrangência</h5>

                <div class="card-body">

                    <div class="row">
                        @if (!empty($client->state_id))
                            <div class="col-md-6">
                                <span class="font-weight-bold">UF:</span>
                                {{ $client->state->name }}
                            </div>
                        @endif

                        @if (!empty($client->city_id))
                            <div class="col-md-6">
                                <span class="font-weight-bold">Cidade:</span>
                                {{ $client->city->name }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if ($numDependents > 0)
            <div class="card">
                <h5 class="card-header">Dependentes</h5>

                <div class="card-body">

                    <div class="row">
                        @foreach ($dependents as $dependent)

                            <div class="col-md-3">
                                {{ $dependent['age'] }} anos - {{ $dependent['birth'] }}
                            </div>

                        @endforeach
                    </div>

                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <a href="{{ route('clients.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Voltar
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
