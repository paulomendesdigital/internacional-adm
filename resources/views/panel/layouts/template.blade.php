<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('assets/all/images/favicon.png') }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('assets/panel/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{url('assets/panel/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/panel/libs/css/style.css')}}">

    <!-- Icons -->
    <link rel="stylesheet" href="{{url('assets/panel/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{url('assets/panel/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/panel/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">

    @stack('css')

    <title>{{$title ?? 'Painel Administrativo - Internacional Administradora'}}</title>
</head>

<body>

    <div class="dashboard-main-wrapper">

        @include('panel.includes.navbar')

        @include('panel.includes.sidebar')

        <div class="dashboard-wrapper">

            <div class="dashboard-ecommerce">

                <div class="container-fluid dashboard-content ">

                    @yield('content')

                </div>
            </div>

            @include('panel.includes.footer')

        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{url('assets/panel/vendor/jquery/jquery-3.3.1.min.js')}}"></script>

    <!-- bootstap bundle js -->
    <script src="{{url('assets/panel/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

    <!-- slimscroll js -->
    <script src="{{url('assets/panel/vendor/slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- main js -->
    <script src="{{url('assets/panel/libs/js/main-js.js')}}"></script>

    @stack('scripts')

</body>

</html>
