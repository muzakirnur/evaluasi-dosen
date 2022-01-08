<head>
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="img/bg.svg">
    <div class="container">
        <div class="img">
        </div>
        <div class="login-content">
            <h1 class="card-title" style="color:white;margin-left:10%">Selamat Datang di Evaluasi Pengajaran Dosen
                <br>
                Silahkan
                <a href="{{ route('login') }}" style="display: inline;font-size:2.4rem">Login</a>
            </h1>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
