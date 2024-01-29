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
                    <li class="nav-item"><a class="nav-link" href="{{ route('home')}}">ホーム</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('friend.index') }}">トーク</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('post.index') }}">投稿</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('myProfile') }}">マイページ</a></li>
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
    <div class="sidebar p-3 bg-secondary">
        <a href="{{ route('friend.index') }}" class="d-flex align-items-center text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-wechat" viewBox="0 0 16 16">
                <path d="M11.176 14.429c-2.665 0-4.826-1.8-4.826-4.018 0-2.22 2.159-4.02 4.824-4.02S16 8.191 16 10.411c0 1.21-.65 2.301-1.666 3.036a.324.324 0 0 0-.12.366l.218.81a.616.616 0 0 1 .029.117.166.166 0 0 1-.162.162.177.177 0 0 1-.092-.03l-1.057-.61a.519.519 0 0 0-.256-.074.509.509 0 0 0-.142.021 5.668 5.668 0 0 1-1.576.22ZM9.064 9.542a.647.647 0 1 0 .557-1 .645.645 0 0 0-.646.647.615.615 0 0 0 .09.353Zm3.232.001a.646.646 0 1 0 .546-1 .645.645 0 0 0-.644.644.627.627 0 0 0 .098.356Z"/>
                <path d="M0 6.826c0 1.455.781 2.765 2.001 3.656a.385.385 0 0 1 .143.439l-.161.6-.1.373a.499.499 0 0 0-.032.14.192.192 0 0 0 .193.193c.039 0 .077-.01.111-.029l1.268-.733a.622.622 0 0 1 .308-.088c.058 0 .116.009.171.025a6.83 6.83 0 0 0 1.625.26 4.45 4.45 0 0 1-.177-1.251c0-2.936 2.785-5.02 5.824-5.02.05 0 .1 0 .15.002C10.587 3.429 8.392 2 5.796 2 2.596 2 0 4.16 0 6.826Zm4.632-1.555a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Zm3.875 0a.77.77 0 1 1-1.54 0 .77.77 0 0 1 1.54 0Z"/>
            </svg>
            <span style="font-size: 2.0rem; margin-left: 3px;">トーク</span>
        </a>
        <hr>
        <ul class="nav d-flex flex-column">
            <li>
                <a class="side-nav-link d-flex align-items-center" href="{{ route('friend.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
                        <path d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
                    </svg>
                    <span style="font-size: 1.5rem; margin-left: 10px;">友だち</span>
                </a>
            </li>
            <li>
                <a class="side-nav-link d-flex align-items-center" href="{{ route('group.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                    </svg>
                    <span style="font-size: 1.5rem; margin-left: 10px;">グループ</span>
                </a>
            </li>
            <li style="margin-top: 50vh;">
                <a class="side-nav-link d-flex align-items-center" href="{{ route('friend.friendRegister') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    <span style="font-size: 1.5rem; margin-left: 10px;">友だち登録</span>
                </a>
            </li>
            <li>
                <a class="side-nav-link d-flex align-items-center" href="{{ route('group.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    <span style="font-size: 1.5rem; margin-left: 10px;">グループ作成</span>
                </a>
            </li>
        </ul>
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

.nav-link {
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
    margin-left: 250px;
}

.sidebar {
    position: fixed;
    top: 116px;
    left: 0;
    width: 250px;
    height: calc(100vh - 116px);
    overflow-y: auto;
    font-size:1.5rem;
    box-shadow: 2px 0px 5px rgba(0,0,0,0.1);
}

.sidebar .side-nav-link {
    display: block;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.sidebar .side-nav-link:hover {
    background-color: #e9ecef;
    color: #007bff;
}

hr {
    height: 3px;
    border: none;
    background-color: #000;
    margin: 10px 0;
}

/* モバイルデバイス用のスタイル */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        top: 0;
    }
}
</style>
</body>
</html>
