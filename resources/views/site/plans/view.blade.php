@extends('site.layouts.template')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                    @foreach ($operadoras as $id => $name)

                    <a
                        class="nav-item nav-link @if ($loop->first) active @endif"
                        id="operadora-{{ $id }}-tab"
                        href="#operadora-{{ $id }}"
                        data-toggle="tab"
                        role="tab"
                        aria-controls="operadora-{{ $id }}"
                        aria-selected="true"
                    >
                        {{ $name }}
                    </a>

                    @endforeach

                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">

                @foreach ($operadoras as $operadoraId => $operadoraName)

                <div
                    class="tab-pane fade @if ($loop->first) show active @endif"
                    id="operadora-{{ $operadoraId }}"
                    role="tabpanel"
                    aria-labelledby="operadora-{{ $operadoraId }}-tab"
                >
                    <div class="row">

                        @foreach ($plans as $plan)

                            @if (
                                $plan->operadora_id == $operadoraId
                            )

                            <div class="col-md-4 pt-4">
                                <div class="card card-plan">

                                    <div class="card-header card-header-plan color-orange text-center mb-3">
                                        {{ $plan->name }}
                                    </div>

                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2">Card subtitle</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="far fa-map"></i>

                                            @if ($client->abrangencia == '1')
                                                Nacional
                                            @elseif ($client->abrangencia == '2')
                                                Regional
                                            @endif
                                        </li>

                                        @if ($client->abrangencia == '2' && !empty($client->city_id) && !empty($client->state_id))
                                            <li class="list-group-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                {{ $client->state->name }} - {{ $client->city->name }}
                                            </li>
                                        @endif

                                        @if ($client->dependents()->count() > 0)
                                            <li class="list-group-item">
                                                <i class="fas fa-user"></i>

                                                @foreach ($pricesPlansClient as $idPlan => $pricePlanClient)

                                                    @if ($idPlan == $plan->id)

                                                        {{ $clientAge }} anos = R$ {{ $pricePlanClient }}

                                                    @endif

                                                @endforeach
                                            </li>
                                        @endif

                                    </ul>


                                    @if ($client->dependents()->count() > 0)

                                        <div class="card-body mt-3">
                                            <h6 class="card-subtitle">Dependentes</h6>
                                        </div>

                                        <ul class="list-group list-group-flush">


                                            @foreach ($finalPricesDependents as $idPlan => $pricesAges)

                                                @if ($idPlan == $plan->id)

                                                    @foreach ($pricesAges as $priceAge)
                                                        <li class="list-group-item">
                                                            <i class="fas fa-users"></i>
                                                            {{ $priceAge['qtd'] }}: {{ $priceAge['name'] }} = R$ {{ $priceAge['price'] }}
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif

                                    <div class="card-body">

                                        <small>
                                            Consulte as Internações e Laboratórios desse plano ligando para: {{ $conf->phone }}.
                                        </small>

                                        @foreach ($totalPricesPlans as $idPlan => $price)

                                            @if ($idPlan == $plan->id)

                                                <h3 class="color-orange text-center mt-5 mb-3">R$ {{ $price }}</h3>

                                            @endif

                                        @endforeach

                                        <form method="post" action="{{ url('/planos/enviar/mensagem') }}" class="text-center mb-4">
                                            {!! csrf_field() !!}

                                            <input type="hidden" name="id" value="{{ $client->id }}">

                                            <button type="submit" class="btn btn-blue center">Tenho Interesse</button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            @endif

                        @endforeach
                    </div>

                </div>

                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{url('assets/site/css/plans.css')}}">
@endpush
