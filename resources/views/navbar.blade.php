<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <div class="city-hash">
                #{{ $city->name }}
                <div>розумне місто</div>
            </div>
        </a>

        @if (! request()->routeIs('main_list'))
        <div class="input-group col-4 ">
            <input class="form-control mr-sm-2 w-50 d-none d-sm-block" type="search" placeholder="Пошук за адресою" aria-label="Пошук за адресою" autocomplete="off" id="search-input">
        </div>
        @endif

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
                @if (! request()->routeIs('main_list'))
                <li class="d-block d-sm-none">
                    <div class="input-group col-12 d-block">
                        <input class="form-control w-100" type="search" placeholder="Пошук за адресою" aria-label="Пошук за адресою" autocomplete="off" id="search-input-mobile">
                    </div>
                </li>
                @endif

                <li class="nav-item">
                    @if (request()->routeIs('main_list'))
                        <a class="nav-link" href="{{ route('categories', [$city->slug, optional($category)->slug]) }}">Мапа</a>
                    @else
                        <a class="nav-link" href="{{ route('main_list', [$city->slug, optional($category)->slug]) }}">Список</a>
                    @endif
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="city-select" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Міста</a>
                    <div class="dropdown-menu" aria-labelledby="city-select">
                        @foreach(\App\City::orderBy('name')->get() as $cityList)
                            <a class="dropdown-item" href="{{ route('main', $cityList->slug) }}">{{ $cityList->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="$('#categories').modal('toggle');return false;">Категорії</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="citizen" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Мешканцю міста</a>
                    <div class="dropdown-menu" aria-labelledby="citizen">
                        <a class="dropdown-item" href="#">Подати скаргу</a>
                        {{--<a class="dropdown-item" href="#">Підписатися на розсилку</a>--}}
                    </div>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="#">Інструкція</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</nav>