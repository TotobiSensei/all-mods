<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

$read = new Read();

$news = $read->news($_GET["news-"]);
    
?>

    <div><?=$news["img"]?></div>
    <div><?=$news["title"]?></div>
    <div><?=$news["content"]?></div>
    <div><?=$news["date"]?></div>
    <div><?=$news["login"]?></div>


<?php
Render::footer();
?>