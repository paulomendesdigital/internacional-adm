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
            <form method="post" action="planos/store">
                {!! csrf_field() !!}

                <h5>Comece aqui!</h5>
                <p>É muito rápido: você faz sua simulação e já pode comparar preços e vantagens.</p>

                <div class="row">

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>

                            <input id="name" type="text" name="name" class="form-control" placeholder="Nome" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>

                            <input id="phone" type="text" name="phone" class="form-control phone" placeholder="Telefone" value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="modality" class="col-form-label">Modalidade</label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>

                        <select id="modality" name="modality_id" class="form-control">
                            @foreach ($modalities as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>

                <div id="site-abrangencia">
                    <abrangencia>
                        Carregando...
                    </abrangencia>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="site-sales-center">
    <sales-center @if (!empty($conf)) prop-phone="{{$conf->phone}}" prop-whatsapp="{{$conf->whatsapp}}" prop-email="{{$conf->email}}" @endif></sales-center>
</div>

@endsection

@push('css')
<link rel="stylesheet" href="{{url('assets/site/css/plans.css')}}">
@endpush

@push('scripts')
<script src="{{ url('/js/manifest.js') }}"></script>
<script src="{{ url('/js/vendor.js') }}"></script>
<script src="{{ url('/js/bootstrap.js') }}"></script>
<script src="{{ url('/js/site-abrangencia.js') }}"></script>
<script src="{{ url('/js/sales-center.js') }}"></script>

<script src="{{ url('assets/all/js/jquery.maskedinput.min.js') }}"></script>
<script>
    jQuery(".phone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        });
</script>
@endpush
