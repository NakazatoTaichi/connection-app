<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>@yield('title')</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="app-logo">
                <img src="file:///Users/nakazatotaichi/laravel_docker/connection-app/connection-app.png" alt="">
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">ホーム</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">トーク</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">投稿</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">マイページ</a></li>
                </ul>
                <div class="login">
                    <p>ログイン者：〇〇〇〇</p>
                </div>
            </div>
        </nav>
    </div>
    <div class="main">
        @yield('main')
    </div>
<style>
nav {
    background-color: #333;
    overflow: hidden;
    height: 100px;
    display: flex;
    align-items: center;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 100;
}

.app-logo img {
    margin-top: 3px;
    width: 100px;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

nav li {
    float: left;
}

nav a {

    display: block;
    color: white;
    text-align: center;
    width: 150px;
    margin-left: 20px;
    padding: 10px 12px;
    text-decoration: none;
    border-radius: 30px;
    border: 2px solid white;
    font-size: 1.5rem;
}

nav a:hover {
    background-color: #ddd;
    color: black;
}

.login {
    margin-left: auto;
    color: white;
    text-align: center;
    padding: 30px;
}
</style>
</body>
</html>
