@extends('site.layouts.template')

@section('content')
<!-- SLIDE -->
<div class="slide d-none d-lg-block" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{url('assets/site/imgs/quem-somos.jpg')}}" alt="First slide">
        </div>
    </div>
</div>
<!-- END SLIDE -->

<!-- CONTENT -->
<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-12">
            <h1 class="mb-5">Fale Conosco</h1>
        </div>
    </div>
    <form method="post" action="{{ url('/fale-conosco/enviar') }}">

        {!! csrf_field() !!}

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nome:</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
        </div>
        <div class="form-group">
            <label for="subject">Assunto:</label>
            <input type="text" name="subject" class="form-control" id="subject">
        </div>
        <div class="form-group">
            <label for="message">Mensagem:</label>
            <textarea class="form-control" name="message" id="message" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <div class="row">
        <div class="col-md-12 border-bottom mt-5 mb-5"></div>
    </div>
    <div class="row text-center mb-5">
        <div class="col-md-12">
            <h1 class="mb-5">Ainda não é um cliente Internacional? Faça sua adesão.</h1>

            <a href="{{ url('/planos') }}" class="btn btn-padrao rounded-pill">Seja um Cliente Internacional</a>
        </div>
    </div>

    <div id="site-sales-center">
        <sales-center
            @if (!empty($conf))
                prop-phone="{{$conf->phone}}"
                prop-whatsapp="{{$conf->whatsapp}}"
                prop-email="{{$conf->email}}"
            @endif
        ></sales-center>
    </div>
</div>
<!-- END CONTENT -->
@endsection

@push('scripts')
<script src="{{ url('/js/manifest.js') }}"></script>
<script src="{{ url('/js/vendor.js') }}"></script>
<script src="{{ url('/js/sales-center.js') }}"></script>
@endpush
