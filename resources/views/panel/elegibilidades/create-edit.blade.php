@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $titlePage ?? 'Cadastrar Elegibilidade' }} </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('elegibilidades.index')}}" class="breadcrumb-link">Elegibilidades</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadatrar Elegibilidade</li>
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

            @if (!empty($elegibilidade))
            <form method="post" action="{{route('elegibilidades.update', $elegibilidade->id)}}" enctype="multipart/form-data">
                {!! method_field('PUT') !!}
            @else
            <form method="post" action="{{route('elegibilidades.store')}}" enctype="multipart/form-data">
                @endif

                <h5 class="card-header">Informações de Cadastro</h5>
                <div class="card-body">

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="form-group">
                        <label for="name" class="col-form-label">Nome</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{$elegibilidade->name ?? old('name')}}">
                    </div>
                </div>

                <h5 class="card-header">Profissões</h5>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select multiple="multiple" id="my-select" name="profissions[]">
                                    @foreach ($profissions as $profission)
                                        <option value='{{ $profission->id }}'

                                            @if (!empty($elegibilidade))
                                                @foreach ($elegibilidade->profissions as $eleProfission)
                                                    @if ($profission->id == $eleProfission->id) selected @endif
                                                @endforeach
                                            @endif

                                        >{{ $profission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary float-right mb-3">Enviar</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ url('assets/panel/vendor/multi-select/css/multi-select.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('assets/panel/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
    <script>
        $('#my-select, #pre-selected-options').multiSelect()
    </script>
@endpush
