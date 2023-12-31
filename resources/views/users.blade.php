<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h1>ユーザ一覧</h1>
            @foreach ($users as $user)
            <div class="user-wrapper mb-4 border p-3">
                <div class="user-container row align-items-center mb-4">
                    <div class="col-md-1">
                        @if ($user->icon)
                            <img src="{{ asset('storage/icons/' . $user->icon )}}" alt="icon" class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                        @else
                            <div class="icon-placeholder rounded-circle" style="width: 50px; height: 50px; background-color: #CCCCCC;"></div>
                        @endif
                    </div>
                    <div class="user-info col-md-3">
                        <a href="{{ route('chat.show', ['user' => $user->id]) }}">
                            <p>{{$user->name}}</p>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="text-end mb-5">
                <a href="{{ route('home')}}">戻る</a>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
