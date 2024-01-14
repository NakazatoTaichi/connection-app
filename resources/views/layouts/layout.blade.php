<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <style>
        p {
            font-size: 1.5rem;
        }
        a {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg text-center" style="font-size: 1.5rem;">
            <div class="navbar-brand">
                <img src="{{ asset('img/connection-app.png') }}" alt="logo" width="100" height="100">
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home')}}">ホーム</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">トーク</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('post.index') }}">投稿</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('myProfile') }}">マイページ</a></li>
                </ul>
                <div class="dropdown">
                    @if (\Illuminate\Support\Facades\Auth::user()->icon)
                        <img src="{{ asset('storage/icons/' . \Illuminate\Support\Facades\Auth::user()->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                    @elseif (\Illuminate\Support\Facades\Auth::user()->icon->null)
                        <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @else
                        <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                    @endif
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ログイン者：{{\Illuminate\Support\Facades\Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{route('user.logout')}}" method="post">
                                <button type="submit" class="dropdown-item">
                                    @csrf
                                    ログアウト
                                </button>
                            </form>
                        </li>
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
    text-align: center;
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
}

.nav-item {
    float: left;
}

.nav-link {
    /* display: block; */
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

.dropdown {
    margin-left: auto !important;
    padding-right: 30px;
}

.dropdown-toggle {
    text-decoration: none;
}

.dropdown-item {
    background-color: #ddd;
}

.main {
    margin-top: 116px;
}
</style>
</body>
</html>
