<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{asset('login_alt_asset/images/fav.jpg')}}">
    <link rel="stylesheet" href="{{asset('login_alt_asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('login_alt_asset/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login_alt_asset/css/style.css')}}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{'E-Learning-App' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body style="background-image: url({{asset('dist/img/photo1.png')}}); background-size:cover">
<div id="app">


    <main>
        @yield('content')
    </main>
    <script>

        function myFunction() {

            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>
</div>
<script src="{{asset('login_alt_asset/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('login_alt_asset/js/popper.min.js')}}"></script>
<script src="{{asset('login_alt_asset/js/bootstrap.min.js')}}"></script>
</body>
</html>
