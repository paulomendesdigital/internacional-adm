@extends('site.layouts.template')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">

        <div class="col-md-12 p-0">
            @include('includes.errors')
        </div>

        <div class="col-md-4" id="plans-sidebar">
            <img src="{{url('assets/all/images/logo-horizontal-white-mobile.png')}}" class="d-lg-none" alt="Logo Internacional Administradora">
            <img src="{{url('assets/all/images/logo-vertical-white.png')}}" class="d-none d-lg-block" alt="Logo Internacional Administradora">
        </div>

        <div class="col-md-8 p-4" id="plans-content">
            <form method="post" action="{{ url('/planos/info-store') }}">

                {!! method_field('PUT') !!}
                {!! csrf_field() !!}

                <input type="hidden" name="id" value="{{ $id }}">

                <h5>Falta pouco</h5>
                <small>Insira as informações abaixo para o nosso sistema fazer o orçamento para você</small>

                <br>
                <br>

                <div class="row mb-2">

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-6">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" name="birth" placeholder="Data de Nascimento" min="{{ $minDate }}" max="{{ $maxDate }}" value="{{ old('birth') }}">
                        </div>
                    </div>

                </div>

                <div id="site-dependents">
                    <site-dependents
                        prop-min-date="{{ $minDate }}"
                        prop-max-date="{{ $maxDate }}"

                        @if (!empty($profissions))
                            prop-profissions="{{ $profissions }}"
                            prop-elegibilidade="{{ $client->modality->elegibilidade }}"
                            prop-client-modality-pj="{{ $client->modality->pj }}"
                        @endif
                    >
                        Carregando...
                    </site-dependents>
                </div>

                <button type="submit" class="btn btn-primary">Ver Planos Agora</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{url('assets/site/css/plans.css')}}">
@endpush

@push('scripts')
<script src="{{ url('/js/manifest.js') }}"></script>
<script src="{{ url('/js/vendor.js') }}"></script>
<script src="{{ url('/js/site-dependents.js') }}"></script>
@endpush
