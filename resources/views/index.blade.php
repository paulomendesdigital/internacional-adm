@extends('panel.layouts.template')

@section('content')
<div id="app">
    <abrangencia>
        Carregando...
    </abrangencia>
</div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ url('assets/panel/vendor/multi-select/css/multi-select.css') }}">
@endpush

@push('scripts')
<script src="{{ url('assets/panel/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
<script>
    $('#my-select, #pre-selected-options').multiSelect()
</script>

<script src="{{ url('/js/manifest.js') }}"></script>
<script src="{{ url('/js/vendor.js') }}"></script>
<script src="{{ url('/js/bootstrap.js') }}"></script>
<script src="{{ url('/js/abrangencia.js') }}"></script>
@endpush