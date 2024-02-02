<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container mx-auto">
        <div class="card col-md-6 mx-auto">
            <div class="card-body p-5">
                <h1 class="card-title text-center">ログイン画面</h1>
                @if ($errors->any())
                    <ul style="margin-bottom: 0; list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li>
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <form action="" method="post" class="needs-validation" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        <div class="invalid-feedback">メールアドレスを入力してください。</div>
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
                        <div class="invalid-feedback">パスワードを入力してください。</div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
