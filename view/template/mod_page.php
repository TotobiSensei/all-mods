<?php
require_once __DIR__ . "/../../assets/php/initClasses.php";

Render::header();

$modId = $_GET["mod-id"];// MOD ID
@$sessId = $_SESSION["user"];

$auth = new Authentication();
$moder = new Moderation();
$read = new Read();
$views = new Views();

$data = $read->mod($modId);

$views->incViewsCount($modId, $data["user_id"], 'mod');


if(isset($_SESSION["error"]))
{
    echo " <div class=\"error\">";
    echo $_SESSION["error"];
    unset($_SESSION["error"]);
    echo "</div>";
}
?>
<section class="mod-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="info-block">
                    <div class="top">
                        <div class="left">
                            <img src="<?= $data["img"] ?>" alt="">
                        </div>
                        <div class="right">
                            <div class="name">
                                <h1><?= $data["name"] ?></h1>
                                <?php if (($auth->checkAuth() && $sessId === $data["user_id"]) || ($moder->isAdmin($sessId) || $moder->isModerator($sessId))) : ?>
                                    <div onclick="location.href='/view/upload.php?mod=<?= $data['id'] ?>'" class="edit">
                                        <span>Редактировать</span>
                                        <span>&#9999;</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="description">
                            <div class="author">
                                <span>Автор:</span>
                                <span><?= $data["login"] ?></span>
                            </div>
                                <span>
                                    <?= $data["description"] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="middle">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Рейтинг</td>
                                    <td><?= Render::modsRating($modId, "mod", $sessId)?></td>
                                </tr>
                                <tr>
                                    <td>Просмотры</td>
                                    <td><?= $data["views"] ?></td>
                                </tr>
                                <tr>
                                    <td>Загрузки</td>
                                    <td>5678</td>
                                </tr>
                                <tr>
                                    <td>Загружен</td>
                                    <td><?= $data["upload"] ?></td>
                                </tr>
                                <tr>
                                    <td>Обновлен</td>
                                    <td><?= $data["updated"] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bottom">
                        <a class="button" href="<?= $data["file_name"] ?>">СКАЧАТЬ</a>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            Render::answerForm($modId, 'mod', $sessId);
            Render::comments($modId, 'mod');
        ?>
    </div>
</section>
<?php

Render::footer();