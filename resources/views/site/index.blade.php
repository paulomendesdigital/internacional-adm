@extends('site.layouts.template')

@section('content')
<!-- SLIDE -->
<div class="d-none d-lg-block" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

        @foreach ($slides as $slide)
            <div class="carousel-item @if($loop->first) active @endif">
                <img class="d-block w-100" src='{{url("storage/slides/$slide->image")}}' alt="First slide">
            </div>
        @endforeach
    </div>
</div>
<!-- END SLIDE -->

<!-- BLOCKS -->
    <div class="container main-blocks">
        <div class="row blocks">
            <a href="{{url('/individual')}}" class="block block-voce">
                <img src="{{url('assets/site/imgs/small-icon-white.png')}}" alt="Ícone Administradora Internacional">
                <span class="desc">
                    para <br> <strong>Você</strong>
                </span>
            </a>

            <a href="{{url('/pequenas-e-medias-empresas')}}" class="block block-pequena">
                <img src="{{url('assets/site/imgs/small-icon-white.png')}}" alt="Ícone Administradora Internacional">
                <span class="desc">
                    para <strong>Peq.<br> Med. Empresas</strong>
                </span>
            </a>

            <a href="{{url('/coletivo-por-adesao')}}" class="block block-coletivo">
                <img src="{{url('assets/site/imgs/small-icon-white.png')}}" alt="Ícone Administradora Internacional">
                <span class="desc">
                    para <strong>Coletivo.<br> Por Adesão</strong>
                </span>
            </a>
        </div>
    </div>
<!-- END BLOCKS -->

<!-- CONTENT -->
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-sm-12 col-lg-4 block-info">
                    <img src="{{url('assets/site/imgs/icon-telefone.png')}}" alt="Ícone de Telefone">
                    <div class="title-info">
                        ATENDIMENTO<br>
                        AO CLIENTE
                    </div>
                    <div class="desc-info">
                        LOREM IPSUM LOREM IPSUM LOREM IPSUM LOREM IPSUM LOREM IPSUM 
                    </div>
                </div>

                <div class="col-sm-12 col-lg-4 block-info">
                    <img src="{{url('assets/site/imgs/icon-saúde.png')}}" alt="Ícone de Telefone">
                    <div class="title-info">
                        REDE CREDENCIADA<br>
                        DE SEU PLANO
                    </div>
                    <div class="desc-info">
                        LOREM IPSUM LOREM IPSUM LOREM IPSUM LOREM IPSUM LOREM IPSUM 
                    </div>
                </div>

                <div class="col-sm-12 col-lg-4 block-info">
                    <img src="{{url('assets/site/imgs/icon-lápis.png')}}" alt="Ícone de Telefone">
                    <div class="title-info">
                        INFORMAÇÕES<br>
                        COMPLEMENTARES
                    </div>
                    <div class="desc-info">
                        LOREM IPSUM LOREM IPSUM LOREM IPSUM LOREM IPSUM LOREM IPSUM 
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-4">
            <div class="row vermais">
                <div class="col-sm-8 col-md-12 col-lg-8 title-vermais">Lorem Ipsum Lorem</div>
                <div class="col-sm-4 col-md-12 col-lg-4"><div class="btn btn-vermais">Ver Mais</div></div>
            </div>

            <div class="row vermais">
                <div class="col-sm-8 col-md-12 col-lg-8 title-vermais">Lorem Ipsum Lorem</div>
                <div class="col-sm-4 col-md-12 col-lg-4"><div class="btn btn-vermais">Ver Mais</div></div>
            </div>

            <div class="row vermais">
                <div class="col-sm-8 col-md-12 col-lg-8 title-vermais">Lorem Ipsum Lorem</div>
                <div class="col-sm-4 col-md-12 col-lg-4"><div class="btn btn-vermais">Ver Mais</div></div>
            </div>

            <div class="bancos">
                <div class="row text-center">
                    <div class="col-md-12">
                        <span>BANCOS CONVENIADOS PARA DÉBITO AUTOMÁTICO</span>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <img src="{{url('assets/site/imgs/icons-banco.png')}}" alt="Bancos">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->

@endsection

@push('scripts')
<script>
$('.carousel').carousel({
  interval: 2000
})
</script>
@endpush