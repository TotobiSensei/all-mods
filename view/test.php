<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

var_dump($_POST);
?>

<form action="" class="rating-form" method="POST">
    <label for="" class=""><span>★</span><input type="submit" name="star" value="1"></label>
    <label for="" class=""><span>★</span><input type="submit" name="star" value="2"></label>
    <label for="" class=""><span>★</span><input type="submit" name="star" value="3"></label>
    <label for="" class=""><span>★</span><input type="submit" name="star" value="4"></label>
    <label for="" class=""><span>★</span><input type="submit" name="star" value="5"></label>
</form>