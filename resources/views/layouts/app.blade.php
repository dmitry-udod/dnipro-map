<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="{{ asset('icons/logo.png') }}"/>
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Відкрита мапа - {{ isset($city->name) ? $city->name : 'обрати місто'  }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    @yield('css')

</head>
<body>
    <div id="app">
        @if (isset($city))
            @include('navbar')
        @endif
        @yield('content')
    </div>

    @yield('js')
</body>
</html>
