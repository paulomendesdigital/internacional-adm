@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $titlePage ?? 'Cadastrar Plano' }} </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/panel')}}" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('plans.index')}}" class="breadcrumb-link">Planos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadatrar Plano</li>
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
        @if (!empty($plan))
        <form method="post" action="{{route('plans.update', $plan->id)}}" enctype="multipart/form-data">
            {!! method_field('PUT') !!}
        @else
        <form method="post" action="{{route('plans.store')}}" enctype="multipart/form-data">
        @endif
            <div class="card">
                <h5 class="card-header">Informações de Cadastro</h5>
                <div class="card-body">

                    {!! csrf_field() !!}

                    @include('includes.errors')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nome</label>
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $plan->name ?? old('name')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Modalidade</label>

                                <select name="modality_id" class="form-control {{ $errors->has('modality_id') ? 'is-invalid' : '' }}">
                                    @foreach ($modalities as $modality)
                                        <option value="{{ $modality->id }}"

                                            @if (!empty($plan) && $modality->id == $plan->modality->id) selected @endif

                                            >{{ $modality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Elegibilidade</label>
                                <select name="elegibilidade_id" class="form-control">
                                    <option value="">Selecione</option>

                                    @foreach ($elegibilidades as $elegibilidade)
                                        <option value="{{ $elegibilidade->id }}"

                                            @if (!empty($plan->elegibilidade_id) && $elegibilidade->id == $plan->elegibilidade->id) selected @endif

                                            >{{ $elegibilidade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Operadora</label>
                                <select name="operadora_id" class="form-control {{ $errors->has('operadora_id') ? 'is-invalid' : '' }}">
                                    @foreach ($operadoras as $operadora)
                                        <option value="{{ $operadora->id }}"

                                            @if (!empty($plan) && $operadora->id == $plan->operadora->id) selected @endif

                                            >{{ $operadora->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h5 class="card-header">Idades</h5>
                <div class="card-body">
                    <div class="row">

                        @foreach ($ages as $age)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Faixa Estária</label>
                                    <select name="age[{{ $age->id }}]" class="form-control" disabled>
                                        @foreach ($ages as $idade)
                                            <option value="{{ $idade->id }}" @if ($idade->id == $age->id) selected @endif>{{ $idade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Preço</label>
                                    <input type="text" class="form-control money"
                                        @if (!empty($prices) && count($prices) > 0)
                                            @foreach($prices as $key => $value)
                                                @if ($key == $age->id)
                                                    value="{{ $value }}"
                                                @endif
                                            @endforeach
                                        @endif
                                        name="price[{{ $age->id }}]">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div id="app">
                <abrangencia
                    prop-app-url="{{ $appUrl }}"

                    @if (!empty($plan))
                        prop-abrangencia="{{ $plan->abrangencia }}"

                        @if (!empty($plan->state))

                        prop-state-id="{{ $plan->state->id }}"

                        @endif

                        @if (!empty($cities))

                        prop-cities="{{ $cities }}"

                        @endif
                    @endif
                >
                    Carregando...
                </abrangencia>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary float-right">Enviar</button>
                        </div>
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
<script src="{{ url('/js/abrangencia.js') }}"></script>

<script src="{{ url('assets/all/js/jquery.maskMoney.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".money").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    });
</script>

@endpush
