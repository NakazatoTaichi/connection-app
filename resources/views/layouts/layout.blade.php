<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- スクロールヒント --}}
    <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    {{-- スクロールヒント --}}
    <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
    <style>
        p {
            font-size: 1.5rem;
        }
        a {
            font-size: 1.5rem;
            text-decoration: none;
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
                    <li class="nav-item"><a class="nav-link layout-button" href="{{ route('home')}}">ホーム</a></li>
                    <li class="nav-item"><a class="nav-link layout-button" href="{{ route('friend.index') }}">トーク</a></li>
                    <li class="nav-item"><a class="nav-link layout-button" href="{{ route('post.index') }}">投稿</a></li>
                    <li class="nav-item"><a class="nav-link layout-button" href="{{ route('myProfile') }}">マイページ</a></li>
                </ul>
                <div class="dropdown">
                    <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:1.5rem;">
                        @if (\Illuminate\Support\Facades\Auth::user()->icon)
                            <img src="{{ asset('storage/icons/' . \Illuminate\Support\Facades\Auth::user()->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                        @else
                            <div class="d-flex align-items-center">
                                <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                                <p style="margin-left: 10px; margin-bottom: 0;">{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                            </div>
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form action="{{route('user.logout')}}" method="post" style="display: inline-block; margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="font-size:1.5rem;">ログアウト</button>
                        </form>
                    </div>
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

.layout-button {
    color: white;
    width: 150px;
    margin-left: 20px;
    padding: 10px 8px;
    text-decoration: none;
    border-radius: 30px;
    border: 2px solid white;
}

.layout-button:hover {
    background-color: #ddd;
    color: black;
}

.dropdown {
    margin-left: auto;
    padding-right: 50px;
}

.dropdown-toggle {
    text-decoration: none;
}

.dropdown-item {
    background-color: #ddd;
    margin-left:2px;
}

.main {
    margin-top: 116px;
}
</style>
<script>
    new ScrollHint('.js-scrollable', {
        i18n: {
            scrollable: 'スクロールできます'
        }
    });
</script>
</body>
</html>
