<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ url('assets/all/images/favicon.png') }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('assets/panel/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{url('assets/panel/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/panel/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/panel/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>

    <title>Login</title>
</head>

<body>
    @yield('content')

    <!-- Optional JavaScript -->
    <script src="{{url('assets/panel/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('assets/panel/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
</body>

</html>
