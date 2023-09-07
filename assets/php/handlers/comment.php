<?php
require_once __DIR__ . "/../initClasses.php";

$create = new Create();
$moderation = new Moderation();

if(isset($_POST["send"]))
{
    $themeId = $_POST["objId"];
    $objType = $_POST["objType"];
    $userId = $_POST["userId"];
    $message = $_POST["message"];

    $form = [
        "objId" => $themeId,
        "objType" => $objType,
        "userId" => $userId,
        "message" => $message,
    ];

    $create->comment($form);

}

header("Location: {$_SERVER['HTTP_REFERER']}");