<?php
require_once __DIR__ . "/../../assets/php/initClasses.php";

$auth = new Authentication();
$read = new Read();

if($auth->checkAuth())
{
    $user = $read->profileData($_SESSION["user"]);
}

if(isset($_GET["logOut"]))
{
    $auth->logout();
    header("Location: /");
    exit;
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="/assets/css/cropper.min.css">
    <script src="/assets/js/cropper.min.js"></script>
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
                                    <a class="link" href="/">Home</a>
                                </li>
                                <li class="item">
                                    <a class="link" href="/view/games.php">Mods</a></li>
                                <li class="item">
                                    <a class="link" href="/view/themes.php">Forum</a>
                                </li>
                                <li class="item">
                                    <a class="link" href="#">test</a>
                                </li>
                                <li class="item">
                                    <a class="link" href="#">test</a>
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
                                            <a class="link" href="/view/upload.php">Upload</a>
                                        </li class="item">
                                        <li class="item profile">
                                            <img src="<?= $user["img"] ?>" alt="">
                                            <a class="link" href="/view/profile.php"><?= $user["login"]?></a>
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