<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>User all!</h1>
    @foreach ($users as $user)
    <a href="{{ route('chat.show', ['user' => $user->id]) }}">
        <p>{{$user->name}}</p>
        <p>{{$user->email}}</p>
    </a>
    @endforeach
</body>
</html>
