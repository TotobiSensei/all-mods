<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();
$sessId = $_SESSION["user"];
$read = new Read();
$pagination = new Pagination(5, count($read->comment(4, "mod")));

$comments = $read->comment(4, "mod", [$pagination->getItemsPerPage(), $pagination->getOffset()]);

?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="answer-block">
                <?php
                    foreach($comments as $comment) :
                ?>
                    <div class="row">
                        <div class="col">
                            <div class="answer">
                                <div class="left">
                                    <img class="user-img" src="<?= $comment["img"] ?>" alt="">
                                    <a class="user-name" href="http://all-mods/view/profile.php?user=<?= $comment['user_id'] ?>"><?= $comment["login"] ?></a>
                                </div>
                                <div class="right">
                                    <div class="top">
                                        <div class="message">
                                            <?= $comment["message"] ?>
                                        </div>
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
                                        <?= Render::userRating($comment["id"], "comment", ["userId" => $sessId, "objCreatorId" =>  $comment["user_id"],] ) ?>
                                        <?= Render::reportForm($comment["id"], $sessId, "theme"); ?>
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
    <?php $pagination->renderLink() ?>
</div>