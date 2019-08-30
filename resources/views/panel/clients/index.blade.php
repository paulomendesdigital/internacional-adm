@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Clientes </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
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

        @include('includes.errors')

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8"><h5 class="mb-0">Clientes Cadastradas</h5></div>
                    <div class="col-md-4">
                        <!-- <a href="{{route('clients.create')}}" class="btn btn-xs btn-success float-right">
                            <i class="fas fa-plus"></i> Cadastrar
                        </!-->

                        <a href="{{ route('clients.export') }}" class="btn btn-xs btn-primary float-right">
                            <i class="fas fa-file-excel"></i> Exportar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr class="border-0">
                                <th class="border-0" width="5">#</th>

                                <th class="border-0">Nome</th>

                                <th class="border-0">Telefone</th>

                                <th class="border-0">E-mail</th>

                                <th class="border-0">Modalidade</th>

                                <th class="border-0">Abrangência</th>

                                <th class="border-0">Estado</th>

                                <th class="border-0">Cidade</th>

                                <th class="border-0" width="96">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>

                                    <td>{{ $client->name }}</td>

                                    <td>{{ $client->phone }}</td>

                                    <td>{{ $client->email }}</td>

                                    <td>{{ $client->modality->name }}</td>

                                    <td>
                                        @if ($client->abrangencia == '1')

                                        Nacional

                                        @elseif ($client->abrangencia == '2')

                                        Regional

                                        @endif
                                    </td>

                                    <td>
                                        @if (!empty($client->state))

                                        {{ $client->state->name }}

                                        @else

                                        -

                                        @endif
                                    </td>

                                    <td>
                                        @if (!empty($client->city))

                                        {{ $client->city->name }}

                                        @else

                                        -

                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ url('/panel/clients/view', $client->id) }}" class="mr-1 btn btn-xs btn-success">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{!! url('/planos/visualizar', base64_encode($client->id)) !!}" class="mr-1 btn btn-xs btn-primary" target="_blank">
                                            <i class="fas fa-angle-right"></i>
                                        </a>

                                        <!-- <a href="{{route('clients.edit', $client->id)}}" class="float-left mr-1 btn btn-xs btn-primary">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <a href="{{route('clients.show', $client->id)}}" class="float-left btn btn-xs btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {!! $clients->links() !!}
    </div>
</div>
@endsection
