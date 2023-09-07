<?php
require_once __DIR__ . "/../../assets/php/initClasses.php";

Render::header();
var_dump($_POST);

$modId = $_GET["mod-id"];// MOD ID
@$sessId = $_SESSION["user"];
$currentURL = "http://". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$auth = new Authentication();
$moder = new Moderation();
$create = new Create();
$read = new Read();
$review = new Reviews();
$views = new Views();
$pagination = new Pagination(5, count($read->comment($modId, "mod")));

$data = $read->mod($modId);
$comments = $read->comment($modId, "mod", [$pagination->getItemsPerPage(), $pagination->getOffset()]);

$views->incViewsCount($modId, $data["user_id"], 'mod');



if(isset($_GET["rating"]) || isset($_POST["rating"]))
{
    $objId = isset($_POST["comment"]) ? $_POST["comment"] : $modId;

    $objType  =  isset($_POST["objType"]) ? $_POST["objType"] : "mod";

    $postCreatorId = $_POST["postCreatorId"];

    $rating = isset($_POST["rating"]) ? $_POST["rating"] : $_GET["rating"];

   try
   {
        $reviewData = [
            "objId" => $objId,
            "objType" => $objType,
            "userId" => $sessId,
            "postCreatorId" => $postCreatorId,
            "rating" => $rating
        ];
    
        $review->addReview($reviewData);
        // header("Location: $currentURL");
   }
   catch(Exception $e)
   {
        $_SESSION["error"] = $e->getMessage();
   }
}

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
                                <span>
                                    <?= $data["description"] ?>
                                </span>
                            </div>
                            <div class="author">
                                <span>Автор:</span>
                                <span><?= $data["login"] ?></span>
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
        <?php Render::answerForm($modId, 'mod', $sessId) ?>
        <div class="row">
            <div class="col">
                <div class="answer-block">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <?php
                                        foreach($comments as $comment) :
                                    ?>
                                <div class="answer">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="user-info">
                                                <img class="user-img" src="<?= $comment["img"] ?>" alt="">
                                                <span class="user-name"><?= $comment["login"] ?></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="message">
                                                <div class="top">
                                                    <div class="text"><?= $comment["message"] ?></div>
                                                </div>
                                                <div class="bottom">
                                                    <div class="date-block">
                                                        <div class="date">
                                                            <span>Отправлено: <?= $comment["date"] ?></span>
                                                        </div>
                                                        <div class="update">
                                                            <span>
                                                                Обновлен: 27.07.2023
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <?= $review->reviewRender($modId, "comment", ["commentId" => $comment["id"], "userId" => $sessId, "postCreatorId" => $comment["user_id"]]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        endforeach;
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $pagination->renderLink() ?>
    </div>
</section>
<?php

Render::footer();