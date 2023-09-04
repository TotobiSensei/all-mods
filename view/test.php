<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

$read = new Read();

$mods = $read->dialogueList($_SESSION["user"]);
echo "<pre>";
var_dump($mods);
echo "</pre>";
if(isset($_POST["messageId"]))
{
    $update->messageStatus($_POST["messageId"]);
}