<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>

                    {{-- ------------------------------------- --}}
                    {{-- DASHBOARD --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="{{url('/panel')}}"><i class="fas fa-fw fa-tachometer-alt"></i>Dashboard <span class="badge badge-success">6</span></a>
                    </li>
                    {{-- END DASHBOARD --}}


                    {{-- ------------------------------------- --}}
                    {{-- SLIDES --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#slides" aria-controls="slides"><i class="fa fa-fw fa-image"></i>Slides</a>
                        <div id="slides" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('slides.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('slides.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END SLIDES --}}


                    {{-- ------------------------------------- --}}
                    {{-- CLIENTS --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#clients" aria-controls="clients"><i class="fas fa-fw fa-user"></i>Clientes</a>
                        <div id="clients" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('clients.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('clients.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END CLIENTS --}}


                    {{-- ------------------------------------- --}}
                    {{-- QUEM SOMOS --}}
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-fw fa-users"></i>Quem Somos</a>
                    </li> -->
                    {{-- END QUEM SOMOS --}}


                    {{-- ------------------------------------- --}}
                    {{-- MODALIDADES --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#modalities" aria-controls="modalities"><i class="fas fa-fw fa-user-circle"></i>Modalidades</a>
                        <div id="modalities" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('modalities.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('modalities.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END MODADLIDES --}}


                    {{-- ------------------------------------- --}}
                    {{-- PROFISSÕES --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-fw fa-user-md"></i>Profissões</a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('profissions.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('profissions.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END PROFISSÕES --}}


                    {{-- ------------------------------------- --}}
                    {{-- ELEGIBILIDADES --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#elegibilidades" aria-controls="elegibilidades"><i class="fas fa-fw fa-building"></i>Elegibilidades</a>
                        <div id="elegibilidades" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('elegibilidades.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('elegibilidades.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END ELEGIBILIDADES --}}


                    {{-- ------------------------------------- --}}
                    {{-- OPERADORAS --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#operadoras" aria-controls="operadoras"><i class="fas fa-fw fa-heart"></i>Operadoras</a>
                        <div id="operadoras" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('operadoras.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('operadoras.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END OPERADORAS --}}


                    {{-- ------------------------------------- --}}
                    {{-- FAIXA ETÁRIAS --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#ages" aria-controls="ages"><i class="fas fa-fw fa-user-plus"></i>Faixas Estárias</a>
                        <div id="ages" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('ages.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('ages.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END FAIXA ETÁRIAS --}}


                    {{-- ------------------------------------- --}}
                    {{-- LOCALIZAÇÃO --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#locations" aria-controls="locations"><i class="fas fa-fw fa-map-marker-alt"></i>Localizações</a>
                        <div id="locations" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#states" aria-controls="states">Estados</a>
                                    <div id="states" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('states.create')}}">Cadastrar</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('states.index')}}">Ver Todos</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#cities" aria-controls="cities">Cidades</a>
                                    <div id="cities" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('cities.create')}}">Cadastrar</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('cities.index')}}">Ver Todos</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END PLANOS --}}


                    {{-- ------------------------------------- --}}
                    {{-- PLANOS --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#plans" aria-controls="plans"><i class="fas fa-fw fa-money-bill-alt"></i>Planos</a>
                        <div id="plans" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('plans.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('plans.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END PLANOS --}}


                    {{-- ------------------------------------- --}}
                    {{-- USUÁRIOS --}}
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#users" aria-controls="users"><i class="fas fa-fw fa-users"></i>Usuários</a>
                        <div id="users" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('users.create')}}">Cadastrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('users.index')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- END USUÁRIOS --}}


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/panel/conf/edit/1')}}" ><i class="fas fa-fw fa-cog mr-2"></i>Configuração</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
