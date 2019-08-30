<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{url('assets/all/images/logo.jpg')}}" class="d-none d-lg-block align-top" alt="Internacional Administradora de Benefícios">
            <img src="{{url('assets/all/images/logo-mobile.jpg')}}" class="d-lg-none align-top" alt="Internacional Administradora de Benefícios">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-menu">

            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/quem-somos')}}">QUEM SOMOS</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        NOSSOS PLANOS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/individual')}}">Individual</a>
                        <a class="dropdown-item" href="{{url('/coletivo-por-adesao')}}">Coletivo por Adesão</a>
                        <a class="dropdown-item" href="{{url('/pequenas-e-medias-empresas')}}">Pequenas e Médias Emmpresas</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/planos')}}">SIMULADOR DE PLANOS</a>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="{{url('/blog')}}">BLOG</a> -->
                </li>
                <li class="nav-item">
                    <a class="btn btn-padrao btn-menu" href="{{url('/fale-conosco')}}">FALE CONOSCO</a>
                </li>
            </ul>

            <a href="#" class="btn btn-custom" target="_blank">
                Segunda via de Boleto
            </a>

            <div class="social-media">
                @if (!empty($conf->facebook))
                <a href="{{$conf->facebook}}" target="_blank">
                    <i class="fab fa-facebook-square"></i>
                </a>
                @endif

                @if (!empty($conf->instagram))
                <a href="{{$conf->instagram}}" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                @endif

                @if (!empty($conf->youtube))
                <a href="{{$conf->youtube}}" target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
                @endif

                @if (!empty($conf->twitter))
                <a href="{{$conf->twitter}}" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                @endif
            </div>

            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>
