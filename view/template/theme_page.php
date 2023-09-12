<?php
require_once __DIR__ . "/../../assets/php/initClasses.php";

Render::header();
// var_dump($_POST);
$themeId = $_GET["theme"];
@$sessId = $_SESSION["user"];

$read = new Read();
$create = new Create();
$review = new Reviews();
$views = new Views();
$moderation = new Moderation();

$data = $read->themes($themeId);

$views->incViewsCount($themeId, $data["user_id"], "theme");


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
                                
                                <?= Render::reportForm($themeId, $sessId, "theme"); ?>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            Render::answerForm($themeId, 'theme', $sessId);
            Render::comments($themeId, 'theme');
        ?>
    </div>
</section>
<?php
Render::footer();
?>