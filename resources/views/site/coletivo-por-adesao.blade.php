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
            <h1 class="mt-4 mb-4">O coletivo de saúde é Internacional</h1>
        </div>
    </div>

    <div class="row mb-5 text-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat, elit vitae ultrices pulvinar, ipsum ex ultrices orci, vitae porttitor dui diam vel nisi. Aenean volutpat quis nulla sed fringilla. Mauris ultrices ultrices turpis. In dolor augue, pellentesque vitae vulputate vel, egestas quis turpis. Vestibulum dapibus faucibus lobortis.</p>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row text-center mb-5">
        <div class="col-md-12">
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

    <div class="row">
        <div class="col-md-12 border-bottom mt-5 mb-5"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p class="title-blue mb-0">Rede Credenciada</p>
            <p class="subtitle">Clique no logotipo da Operadora que deseja consultar</p>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3"><img src="{{url('assets/site/imgs/amil.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/amil.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/amil.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/amil.jpg')}}" alt=""></div>

                <div class="col-md-3"><img src="{{url('assets/site/imgs/bradesco.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/bradesco.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/bradesco.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/bradesco.jpg')}}" alt=""></div>

                <div class="col-md-3"><img src="{{url('assets/site/imgs/samp.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/samp.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/samp.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/samp.jpg')}}" alt=""></div>

                <div class="col-md-3"><img src="{{url('assets/site/imgs/unimed.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/unimed.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/unimed.jpg')}}" alt=""></div>
                <div class="col-md-3"><img src="{{url('assets/site/imgs/unimed.jpg')}}" alt=""></div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-12 border-bottom mt-5 mb-5"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p class="title-blue mb-0">Entidades de Classe Parceiras</p>
        </div>

        <div class="col-md-12">
            <div class="col-md-3"><img src="{{url('assets/site/imgs/logos-entidades-parceiras_.png')}}" alt=""></div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@endsection

@push('scripts')
<script src="{{ url('/js/manifest.js') }}"></script>
<script src="{{ url('/js/vendor.js') }}"></script>
<script src="{{ url('/js/sales-center.js') }}"></script>
@endpush
