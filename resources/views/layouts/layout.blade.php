<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>@yield('title')</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg text-center" style="font-size: 1.5rem;">
            <div class="navbar-brand">
                <img src="{{ asset('img/connection-app.png') }}" alt="logo" width="100" height="100">
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">ホーム</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">トーク</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">投稿</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">マイページ</a></li>
                </ul>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        ログイン者
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="main">
        @yield('main')
    </div>
<style>
.navbar {
    background-color: #333;
    overflow: hidden;
    position: fixed;
    text-item: center;
    width: 100%;
    top: 0;
    z-index: 100;
}

.navbar-brand {
    margin: 0;
    padding: 0 8px;
}

.navbar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-item {
    float: left;
}

.nav-link {
    display: block;
    color: white;
    width: 150px;
    margin-left: 20px;
    padding: 10px 8px;
    text-decoration: none;
    border-radius: 30px;
    border: 2px solid white;
}

.nav-link:hover {
    background-color: #ddd;
    color: black;
}

.main {
    margin-top: 116px;
}
</style>
</body>
</html>
