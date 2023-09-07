<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

var_dump($_POST);

Render::userRating(62,'comment', ['userId' => 105, 'objCreatorId' => 19]);
?>

