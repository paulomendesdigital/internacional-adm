@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Deletar Cliente </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('clients.index')}}" class="breadcrumb-link">Clientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Deletar Clientes</li>
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
            <h5 class="card-header">Confirma a exclusão?</h5>
            <div class="card-body">
                <a href="{{route('clients.index')}}" class="btn btn-primary mr-3 float-left"><i class="fas fa-arrow-left"></i> Cancelar</a>

                <a class="float-left btn btn-danger" href="{{ route('clients.confirmDelete') }}">
                    <i class="fas fa-trash"></i> Deletar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
