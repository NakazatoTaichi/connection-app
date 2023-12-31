<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>トップ画面</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Home</h1>
        <div class="my-4">
            @if ($user->icon)
                <img src="{{ asset('storage/icons/' . $user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
            @else
                <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
            @endif
            {{\Illuminate\Support\Facades\Auth::user()->name}}でログインしています。
        </div>
        <form action="{{route('user.logout')}}" method="post">
            @csrf
            <button>ログアウト</button>
        </form>
        <div class="row mt-3">
            <div class="col-md-3">
                <a href="{{ route('user.index') }}">ユーザ一覧</a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('myProfile') }}">プロフィール編集</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
