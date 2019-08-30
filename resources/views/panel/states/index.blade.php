@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Estados </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Estados</li>
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
                    <div class="col-md-8"><h5 class="mb-0">Estados Cadastrados</h5></div>
                    <div class="col-md-4"><a href="{{route('states.create')}}" class="btn btn-xs btn-success float-right"><i class="fas fa-plus"></i> Cadastrar</a></div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr class="border-0">
                                <th class="border-0" width="5">#</th>
                                <th class="border-0">Nome</th>
                                <th class="border-0" width="95">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($states as $state)
                                <tr>
                                    <td width="5">{{$state->id}}</td>

                                    <td>{{$state->name}}</td>

                                    <td width="95">
                                        <a href="{{route('states.edit', $state->id)}}" class="float-left mr-1 btn btn-xs btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{route('states.show', $state->id)}}" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {!! $states->links() !!}
    </div>
</div>
@endsection
