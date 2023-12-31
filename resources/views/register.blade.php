<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>登録画面</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-white">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h1 class="text-center my-4">新規登録</h1>
                        <hr style="border: 3px solid #8c8b8b;">
                        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3" style="font-size: 1.5rem;">
                                <label for="name">名前</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group mb-3" style="font-size: 1.5rem;">
                                <label for="email">メールアドレス</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group mb-3" style="font-size: 1.5rem;">
                                <label for="password">パスワード</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group mb-3" style="font-size: 1.5rem; height: 250px;">
                                <label for="icon">アイコン画像</label>
                                <input type="file" class="form-control-file" name="icon" id="icon" onchange="previewImage()">
                                <img id="preview">
                            </div>
                            <div class="mb-4 text-center">
                                <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.5rem; width: 150px;">登録</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            max-height: 150px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        function previewImage() {
            var preview = document.getElementById('preview');
            var fileInput = document.getElementById('icon');
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
            }
        }
    </script>
</body>
</html>
