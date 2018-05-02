<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">
            <div class="city-hash">
                #{{ $city->name }}
                <div>розумне місто</div>
            </div>
        </a>

        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Пошук" aria-label="Пошук"  autocomplete="off">
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Мешканцю міста</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Подати скаргу</a>
                        <a class="dropdown-item" href="#">Підписатися на розсилку</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Інструкція</a>
                </li>
            </ul>
        </div>
    </div>
</nav>