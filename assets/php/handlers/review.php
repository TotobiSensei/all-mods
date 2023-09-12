<?php
require_once __DIR__ . "/../initClasses.php";

if (true)
{
    $review = new Reviews();

    if (isset($_POST["star"]))
    {
        $objId      = $_POST["objId"];
        $objType    = $_POST["objType"];
        $userId     = $_POST["userId"];
        $rating     = $_POST["star"];

        $form = [
            "objId"     => $objId,
            "objType"   => $objType,
            "userId"    => $userId,
            "rating"    => $rating,
        ];

        $review->addModReview($form);
    }

    if (isset($_POST["rating"]))
    {
        $form = [
            "objId"           => $_POST["objId"],
            "objType"          => $_POST["objType"],
            "userId"          => $_POST["userId"],
            "objCreatorId"    => $_POST["objCreatorId"],
            "rating"           => $_POST["rating"],
        ];

        $review->addUserReview($form);
    }

    header("Location: {$_SERVER['HTTP_REFERER']}");
}