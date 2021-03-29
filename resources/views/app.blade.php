<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="{{ asset('js/plantilla.js') }}" defer></script> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/plantilla.css') }}" rel="stylesheet"> -->
    @routes
</head>
<body class="FondoColor">
    @inertia
</body>
</html>
