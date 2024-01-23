{{-- @extends('layouts.layout');

@section('title','友だち一覧画面')

@section('main')
    <div class="container mt-5">
        <h1>友だち一覧</h1>
        <div class="my-4">
            <a class="btn btn-primary" href="{{route('friend.friendRegister')}}">友だち登録</a>
        </div>
        <div class="friend-list mt-2">
            @forelse ($friends as $friend)
            <div class="friend-wrapper mb-4 border border-dark-subtle rounded-3 p-3">
                <div class="friend-container row align-items-center">
                    <div class="col-md-1">
                        @if ($friend->icon)
                        <img src="{{ asset('storage/icons/' . $friend->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                        @else
                        <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                        @endif
                    </div>
                    <div class="friend-info col-md-3">
                        <a href="{{ route('chat.show', ['user' => $friend->id]) }}">
                            <p style="margin: 0;">{{$friend->name}}</p>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <p>友だちはいません</p>
            @endforelse
        </div>
        <div class="text-end">
            <a href="{{ route('home')}}">戻る</a>
        </div>
    </div>
@endsection --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>トーク一覧画面</title>

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
        <div class="container mt-5 w-75 p-3" style="margin: auto;">
            <div class="sidebar p-3 row bg-body-secondary" style="height: 100vh; font-size:1.5rem; overflow-y: auto;">
                <ul class="nav d-flex flex-column my-auto">
                    <li class="col-md-12 text-center">
                        <a class="side-nav-link" href="#">友達一覧</a>
                    </li>
                    <li class="col-md-12 text-center">
                        <a class="side-nav-link" href="#">グループ一覧</a>
                    </li>
                </ul>
            </div>
            <h1 class="mt-3">友だち一覧</h1>
            <div class="my-4">
                <a class="btn btn-primary" href="{{ route('friend.friendRegister') }}">友だち登録</a>
            </div>
            <div class="friend-list mt-2">
                @forelse ($friends as $friend)
                <div class="friend-wrapper mb-4 border border-dark-subtle rounded-3 p-3">
                    <div class="friend-container row align-items-center">
                        <div class="col-md-1">
                            @if ($friend->icon)
                            <img src="{{ asset('storage/icons/' . $friend->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                            @else
                            <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                            @endif
                        </div>
                        <div class="friend-info col-md-3">
                            <a href="{{ route('chat.show', ['user' => $friend->id]) }}">
                                <p style="margin: 0;">{{$friend->name}}</p>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <p>友だちはいません</p>
                @endforelse
            </div>
            <div class="text-end">
                <a href="{{ route('home') }}">戻る</a>
            </div>
        </div>
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
    margin-left: 250px;
}

/* サイドバーの基本スタイル */
.sidebar {
    position: fixed; /* 固定位置 */
    top: 116px; /* ヘッダーの下 */
    left: 0; /* 画面の左端 */
    width: 250px; /* 適切な幅 */
    height: calc(100vh - 116px); /* 画面の高さからヘッダーの高さを引いた値 */
    background-color: #f8f9fa; /* 背景色 */
    border-right: 1px solid #ddd; /* 右側の境界線 */
    overflow-y: auto; /* コンテンツが多い場合はスクロール可能 */
    padding: 15px; /* 内部の余白 */
    box-shadow: 2px 0px 5px rgba(0,0,0,0.1); /* 影の効果 */
}

/* サイドバー内のリンクスタイル */
.sidebar .nav-link {
    font-size: 1.2rem; /* 文字サイズ */
    color: #333; /* 文字色 */
    margin-bottom: 10px; /* 下の余白 */
    padding: 10px 15px; /* 内部の余白 */
    border-radius: 5px; /* 角丸 */
    transition: background-color 0.3s, color 0.3s; /* スムーズなホバーエフェクトのための遷移 */
}

/* リンクにマウスオーバーしたときのスタイル */
.sidebar .nav-link:hover {
    background-color: #e9ecef; /* 背景色 */
    color: #007bff; /* 文字色 */
}

/* モバイルデバイス用のスタイル */
@media (max-width: 768px) {
    .sidebar {
        width: 100%; /* 画面の全幅を使用 */
        height: auto; /* 高さを自動調整 */
        position: relative; /* 固定位置を解除 */
        top: 0; /* 上端に設定 */
    }
}
</style>
</body>
</html>

