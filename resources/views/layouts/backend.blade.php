<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.claims.index', $city->slug) }}">Скарги
                                    <span class="badge badge-info">{{ \App\Claim::where('city_id', $city->id)->where('is_processed', false)->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.structureRequests.index', $city->slug) }}">
                                    Запити
                                    <span class="badge badge-success">{{ \App\StructureRequest::where('city_id', $city->id)->where('is_processed', false)->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Керування сайтом <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.structures.index', $city->slug) }}">
                                       Об'екти
                                    </a>

                                    <a class="dropdown-item" href="{{ route('admin.users.index', $city->slug) }}">
                                       Адмiнiстратори
                                    </a>

                                    <a class="dropdown-item" href="{{ route('admin.cities.index', $city->slug) }}">
                                       Мiста
                                    </a>

                                    <a class="dropdown-item" href="{{ route('admin.categories.index', $city->slug) }}">
                                       Категорії
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.types.index', $city->slug) }}">
                                       Види діяльності
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.districts.index', $city->slug) }}">
                                        Райони
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.import.index', $city->slug) }}">
                                        Iмпорт даних
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('flash::message')
            </div>
            @yield('content')
        </main>
    </div>

    @yield('js')

</body>
</html>
