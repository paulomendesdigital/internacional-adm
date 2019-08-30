<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ url('assets/all/images/favicon.png') }}" />

        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$title ?? 'Internacional Administradora'}}</title>

        <link rel="stylesheet" href="{{url('assets/site/libs/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/site/libs/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/site/css/style.css')}}">

        @stack('css')
    </head>
    <body>
        <!-- HEADER -->
        @include('site.includes.header')
        <!-- END HEADER -->

        @yield('content')

        <!-- FOOTER -->
        @include('site.includes.footer')
        <!-- END FOOTER -->

        <script src="{{url('assets/site/js/jquery.min.js')}}"></script>
        <script src="{{url('assets/site/libs/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{url('assets/site/libs/fontawesome/js/all.min.js')}}"></script>

        @stack('scripts')
    </body>
</html>
