<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

$read = new Read();

$mods = $read->mod(67);
var_dump($mods);