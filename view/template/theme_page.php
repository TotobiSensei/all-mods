<?php
require_once __DIR__ . "/../../assets/php/initClasses.php";

Render::header();
$themeId = $_GET["theme"];
@$userId = $_SESSION["user"];

$currentURL = "http://". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$read = new Read();
$create = new Create();
$review = new Reviews();
$views = new Views();
$pagination = new Pagination(5, count($read->comment($themeId, "theme")));

$data = $read->themes($themeId);
$comments = $read->comment($themeId, "theme", [$pagination->getItemsPerPage(), $pagination->getOffset()]);
$views->incViewsCount($themeId, $data["user_id"], "theme");

if(isset($_POST["send"]))
{
    $message = $_POST["message"];

    $form = [
        "objId" => $themeId,
        "objType" => "theme",
        "userId" => $userId,
        "message" => $message,
    ];

    $create->comment($form);

    header("Location: $currentURL");
}

if(isset($_POST["rating"]))
{
    
    $objId = isset($_POST["comment"]) ? $_POST["comment"] : $themeId;

    $objType  = $_POST["objType"];

    $postCreatorId = $_POST["postCreatorId"];

    $rating = $_POST["rating"];

   try
   {
        $reviewData = [
            "objId" => $objId,
            "objType" => $objType,
            "userId" => $userId,
            "postCreatorId" => $postCreatorId,
            "rating" => $rating
        ];
    
        $review->addReview($reviewData);
   }
   catch(Exception $e)
   {
        $_SESSION["error"] = $e->getMessage();
   }
    // header("Location: $currentURL");
}

if(isset($_SESSION["error"]))
{
    echo " <div class=\"error\">";
    echo $_SESSION["error"];
    unset($_SESSION["error"]);
    echo "</div>";
}
?>
<section class="theme-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="theme-header">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="content">
                                    <div class="head">
                                        <h1>
                                            <?= $data["header"] ?>
                                        </h1>
                                        <span>👁 <?= $data["count"] ?></span>
                                    </div>
                                    <div class="topic">
                                        <h3>
                                            <?= $data["topic"] ?>
                                        </h3>
                                    </div>
                                    <div class="body">
                                        <span>
                                            <?= $data["text"] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="info">
                                    <div class="author">
                                        <span>Автор: <?= $data["login"] ?></span>
                                    </div>
                                    <div class="create-date">
                                        <span>Создано: <?= $data["date"] ?></span>
                                    </div>
                                    <div class="update-date">
                                        <?= isset($data["updated"]) ? "<span>Обновленно: {$data["updated"]} </span>" : "" ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <?= $review->reviewRender($themeId, "theme", ["userId" => $userId, "postCreatorId" => $data["user_id"]]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-block">
                    <form action="" method="post" class="d-flex flex-column">
                        <label for="message">Коментарий: </label>
                        <textarea name="message" id=""></textarea>
                        <input type="submit" name="send" value="Отправить">
                    </form>
                </div>
            </div>
        </div>
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
                                                        <img class="user-img" src="<?= $comment["img"] ?>"
                                                            alt="">
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
                                                            <?= $review->reviewRender($themeId, "comment", ["commentId" => $comment["id"], "userId" => $userId, "postCreatorId" => $comment["user_id"]]) ?>
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
    </div>
    <?php $pagination->renderLink() ?>
</section>
<?php
Render::footer();
?>