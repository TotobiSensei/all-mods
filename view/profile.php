<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

$userId = $_SESSION["user"];
Render::header();
$reviews = new Reviews();
$read = new Read();

$user = $read->profileData($userId);
$mods = $read->userMods($userId);
// echo "<pre>";
// var_dump($mods);
// echo "</pre>";
?>
<section class="profile-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="left-block">
                    <img src="<?= $user["img"] ?>" alt="">
                </div>
            </div>
            <div class="col">
                <div class="right-block">
                    <div class="row">
                        <div class="col">
                            <div class="rigth-top">
                                <div class="name">
                                    <span><?= $user["login"] ?></span>
                                </div>
                                <div onclick="location.href='/view/profile-edit.php?user=<?= $user['id'] ?>'" class="edit">
                                    <span>Редактировать</span>
                                    <span>&#9999;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="right-bottom">
                                <div class="role">
                                    <span>Роль:</span>
                                    <span><?= $user["role"] ?></span>
                                </div>
                                <div class="likes">
                                    <span>&#10084;</span>
                                    <span><?= $user["likes"] ?></span>
                                </div>
                                <div class="views">
                                    <span>&#128065;</span>
                                    <span><?= $user["views"] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="profile-content">
    <div class="container">
        <div class="row">
            <div class="col-2 left">
                <div class="left-block">
                    <div class="tabs">
                        <div onclick="location.href='?about'" class="tab">
                            <span>about</span>
                        </div>
                        <div onclick="location.href='?files'" class="tab">
                            <span>files</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col right">
                <div class="right-block">
                    <div class="content">
                        <?php
                            switch (true) {
                                case strpos($_SERVER["REQUEST_URI"], "about") || !strpos($_SERVER["REQUEST_URI"], "files"):
                        ?>
                                    <div class="about-block">
                                        <div class="name">
                                            <span>Имя:</span>
                                            <span><?= isset($user["name"]) || !empty($user["name"]) ? $user["name"] : "неизвестно" ?></span>
                                        </div>
                                        <div class="surname">
                                            <span>Фамилия:</span>
                                            <span><?= isset($user["surname"]) || !empty($user["surname"])? $user["surname"] : "неизвестна" ?></span>
                                        </div>
                                        <div class="age">
                                            <span>Возраст:</span>
                                            <span><?= isset($user["age"]) ? $user["age"]. " лет" : "неизвестен" ?> </span>
                                        </div>
                                        <div class="about">
                                            <span>О себе:</span>
                                            <span><?= !empty(trim($user["about_me"])) ? $user["about_me"] : "пусто" ?></span>
                                        </div>
                                    </div>
                        <?php
                                break;
                                
                                case strpos($_SERVER["REQUEST_URI"], "files"):
                        ?>
                                    <div class="files-block">
                                        <?php foreach($mods as $mod): ?>
                                            <div onclick="location.href='/view/template/mod_page.php?mod-id=<?= $mod['id'] ?>'" class="file">
                                                <div class="name">
                                                    <span></span>
                                                    <span><?= $mod["name"] ?></span>
                                                </div>
                                                <div class="rating">
                                                    <span>&#8902;</span>
                                                    <span>(<?= ceil($mod["avg_rating"]) ?>)</span>
                                                </div>
                                                <div class="views">
                                                    <span>&#128065;</span>
                                                    <span><?= $mod["count"] ?></span>
                                                </div>
                                                <div class="downloads">
                                                    <span>&#129095;</span>
                                                    <span>1337</span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                        <?php
                                    break;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
Render::footer();
?>