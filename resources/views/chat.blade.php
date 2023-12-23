<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div>
            @foreach ($messages as $message)
                <div>
                    <p>{{$message->message}}</p>
                </div>
            @endforeach
        </div>
        <form method="POST" action="{{ route('chat.send', $user)}}">
            @csrf
            <input type="text" name="message" value="">
            <button type="submit">送信</button>
        </form>
    </div>
</body>
</html>
