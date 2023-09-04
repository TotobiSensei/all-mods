<?php
session_start();
require_once __DIR__ . "/../../assets/php/initClasses.php";

$auth = new Authentication();
$create = new Create();
$read = new Read();
$review = new Reviews();
$views = new Views();

if($auth->checkAuth())
{
    $user = $read->profileData($_SESSION["user"]);
}

if(isset($_GET["logOut"]))
{
    $auth->logout();
}

// if($auth->checkAuth() !== true) header("Location: /"); exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap-reboot.min.css">
    <!-- <script src="/assets/js/jQuery.js"></script> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/assets/css/bootstrap-grid.min.css">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap-grid.min.css.map"> -->
    <!-- <script src="/assets/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="/assets/css/cropper.min.css">
    <link rel="stylesheet" href="/assets/css/flickity.min.css">
    <script src="/assets/js/cropper.min.js"></script>
    <script src="/assets/js/flickity.pkgd.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <ul class="menu">
                                <li class="item">
                                    <a class="link" href="/">Главная</a>
                                </li>
                                <li class="item">
                                    <a class="link" href="/view/games.php">Моды</a></li>
                                <li class="item">
                                    <a class="link" href="/view/themes.php">Форум</a>
                                </li>
                                <li class="item">
                                    <a class="link" href="#">Контакты</a>
                                </li>
                                <li class="item">
                                    <a class="link" href="#">F.A.Q.</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="user">
                                <?php
                                    if($auth->checkAuth())
                                    {
                                ?>
                                        <li class="item">
                                            <a class="link" href="/view/upload.php">Загрузить</a>
                                        </li>
                                        <li class="item messages">
                                            <a class="link" href="/view/messages.php">&#128386;</a>
                                        </li>
                                        <li class="item profile">
                                            <img src="<?= $user["img"] ?>" alt="">
                                            <a class="link" href="/view/profile.php?user=<?=  $_SESSION["user"]?>"><?= $user["login"]?></a>
                                        </li>
                                        <li class="item log-out">
                                            <a class="link" href="?logOut=1">&#9032;</a>
                                        </li>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <li class="item">
                                            <a class="link" href="/view/authentication.php">LogIn</a>
                                        </li>
                                        <li class="item">
                                            <a class="link" href="/view/registration.php">SignIn</a> 
                                        </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>