@extends('site.layouts.template')

@section('content')
<!-- SLIDE -->
<div class="container">
    <div class="slide d-none d-lg-block" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{url('assets/site/imgs/quem-somos.jpg')}}" alt="First slide">
            </div>
        </div>
    </div>
</div>
<!-- END SLIDE -->

<!-- CONTENT -->
<div class="container mt-3">
    <div class="row text-center">
        <div class="col-md-12">
            <h1 class="mt-4 mb-4">Bem-vindo à Administradora Internacional</h1>
        </div>
    </div>

    <div class="row mb-5 text-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat, elit vitae ultrices pulvinar, ipsum ex ultrices orci, vitae porttitor dui diam vel nisi. Aenean volutpat quis nulla sed fringilla. Mauris ultrices ultrices turpis. In dolor augue, pellentesque vitae vulputate vel, egestas quis turpis. Vestibulum dapibus faucibus lobortis. Phasellus ut condimentum nunc. Donec vel velit vel augue ultrices vestibulum vitae ut massa. Donec vitae eros lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus volutpat odio sit amet odio hendrerit pretium. Nulla fringilla neque nec nisi pellentesque, et rutrum augue volutpat. Nam vitae odio at sem ullamcorper posuere et vitae dui. Donec non ultrices ipsum. Ut tempus in orci sit amet posuere.</p>

            <p>Aenean vehicula rhoncus nunc eget sagittis. Proin bibendum tristique metus et ultricies. Vestibulum nec urna vel mauris tincidunt luctus ac nec dui. Vivamus bibendum euismod ipsum quis venenatis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed metus felis, feugiat ac volutpat sit amet, fermentum eu tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus. In consectetur ut tortor sit amet placerat.</p>

            <p>Aenean in nisi nunc. Morbi id massa non dolor ornare sodales. Aliquam sed orci quis ipsum porttitor tincidunt quis eget libero. Donec augue augue, auctor ac volutpat et, congue sed nulla. Donec in erat nisi. Suspendisse suscipit, ipsum ac ornare iaculis, orci nibh semper mauris, quis condimentum est tellus non ante. Aliquam dapibus nisl purus, vitae faucibus nisl volutpat sed. Fusce nec libero nec elit faucibus molestie. Aliquam egestas nunc magna, non tempor arcu tristique efficitur. Pellentesque lobortis tristique lacus, in gravida mi tristique sed. Fusce eu erat ac enim ultrices accumsan eget suscipit orci. Curabitur scelerisque consectetur luctus. Nullam sem lorem, condimentum sit amet enim in, tincidunt dignissim justo. Nullam in sagittis urna, luctus lacinia dolor.</p>

            <p>Aliquam non pretium eros. Vestibulum quis egestas lorem. In hac habitasse platea dictumst. Aliquam libero dolor, fermentum ut maximus sed, dictum eget nisl. Proin ultricies volutpat eros. Phasellus efficitur suscipit tincidunt. Proin fermentum vestibulum magna, non vulputate nunc tristique eu.</p>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row text-center">
        <div class="col-md-12">
            <a href="{{ url('/planos') }}" class="btn btn-padrao rounded-pill">Seja um Cliente Internacional</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 border-bottom mt-5 mb-5"></div>
    </div>

    <div class="row text-center quem-somos-planos">
        <a href="individual.html" class="col-md-3">
            <div class="quem-somos-plano rounded-circle">
                <span>Individual</span>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat, elit vitae ultrices pulvinar, ipsum ex ultrices orci, vitae porttitor dui diam vel nisi. Aenean volutpat quis nulla sed fringilla. Mauris ultrices ultrices turpis. In dolor augue, pellentesque vitae vulputate vel, egestas quis turpis.</p>
        </a>

        <a href="coletivo.html" class="col-md-3">
            <div class="quem-somos-plano rounded-circle">
                <span>Coletivo por Adesão</span>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat, elit vitae ultrices pulvinar, ipsum ex ultrices orci, vitae porttitor dui diam vel nisi. Aenean volutpat quis nulla sed fringilla. Mauris ultrices ultrices turpis. In dolor augue, pellentesque vitae vulputate vel, egestas quis turpis.</p>
        </a>

        <a href="pme.html" class="col-md-3">
            <div class="quem-somos-plano rounded-circle">
                <span>Pequenas e Médias Empresas</span>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat, elit vitae ultrices pulvinar, ipsum ex ultrices orci, vitae porttitor dui diam vel nisi. Aenean volutpat quis nulla sed fringilla. Mauris ultrices ultrices turpis. In dolor augue, pellentesque vitae vulputate vel, egestas quis turpis.</p>
        </a>

        <a href="#" class="col-md-3">
            <div class="quem-somos-plano rounded-circle">
                <span>Grandes Empresas</span>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat, elit vitae ultrices pulvinar, ipsum ex ultrices orci, vitae porttitor dui diam vel nisi. Aenean volutpat quis nulla sed fringilla. Mauris ultrices ultrices turpis. In dolor augue, pellentesque vitae vulputate vel, egestas quis turpis.</p>
        </a>
    </div>
</div>
<!-- END CONTENT -->
@endsection
