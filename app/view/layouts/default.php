<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link href="/public/styles/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a href="/" class="navbar-brand">Webcraft</a>
        <button type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" class="navbar-toggler navbar-toggler-right">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($_SESSION['authorized']['id'])) : ?>
                    <li class="nav-item"><a href="/register" class="nav-link">Регистрация</a></li>
                    <li class="nav-item"><a href="/login" class="nav-link">Вход</a></li>
                <?php else :?>
                    <li class="nav-item"><a href="/show" class="nav-link">Показать данные</a></li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-sm-12 mt-5">
            <?=$content?>
        </div>
    </div>
</div>
    <script src="/public/scripts/jquery-3.5.1.min.js"></script>
    <script src="/public/scripts/bootstrap.min.js"></script>
    <script src="/public/scripts/form.js"></script>
    <script src="/public/scripts/sorting.js"></script>
</body>
</html>