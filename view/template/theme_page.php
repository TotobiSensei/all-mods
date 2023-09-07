<?php
require_once __DIR__ . "/../../assets/php/initClasses.php";

Render::header();
// var_dump($_POST);
$themeId = $_GET["theme"];
@$sessId = $_SESSION["user"];

$currentURL = "http://". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$read = new Read();
$create = new Create();
$review = new Reviews();
$views = new Views();
$pagination = new Pagination(5, count($read->comment($themeId, "theme")));
$moderation = new Moderation();

$data = $read->themes($themeId);
$comments = $read->comment($themeId, "theme", [$pagination->getItemsPerPage(), $pagination->getOffset()]);
$views->incViewsCount($themeId, $data["user_id"], "theme");



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
            "userId" => $sessId,
            "postCreatorId" => $postCreatorId,
            "rating" => $rating
        ];
    
        $review->addReview($reviewData);
   }
   catch(Exception $e)
   {
        $_SESSION["error"] = $e->getMessage();
   }
    header("Location: $currentURL");
}
//report
if (isset($_POST["send-report"]))
{
    $form = [
        "objId" => $_POST["objId"],
        "objType" =>  $_POST["objType"],
        "reportingUser" =>  $_POST["reportingUser"],
        "reportType" =>  $_POST["report"],
        "addition" =>  $_POST["addition"],
    ];
    
    $create->report($form);

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
<?php if (isset($warning)) : ?>
<div class="warning">
    <?= $warning ?>
</div>
<?php endif; ?>
<section class="theme-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="theme-header">
                    <div class="content">
                        <div class="top">
                            <div class="head">
                                <span class="header">
                                    <?= $data["header"] ?>
                                </span>
                                <span class="topic">
                                    <?= $data["topic"] ?>
                                </span>
                            </div>
                            <span>👁 <?= $data["count"] ?></span>
                        </div>
                        <div class="middle">
                            <span>
                                <?= $data["text"] ?>
                            </span>
                        </div>
                        <div class="bottom">
                            <div class="left">
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
                            <div class="right">
                                <?= $review->reviewRender($themeId, "theme", ["userId" => $sessId, "postCreatorId" => $data["user_id"]]) ?>
                                <?= Render::reportForm($themeId, $sessId, "theme"); ?>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= Render::answerForm($themeId, 'theme', $sessId)  ?>
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
                                            <div onclick="location.href='../profile.php?user=<?= $comment['user_id'] ?>'" class="user-info">
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
                                                    <?= $review->reviewRender($themeId, "comment", ["commentId" => $comment["id"], "userId" => $sessId, "postCreatorId" => $comment["user_id"]]) ?>
                                                    <?= Render::reportForm($comment["id"], $sessId, "comment"); ?>
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