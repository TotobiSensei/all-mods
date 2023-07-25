<?php
class Render
{
    public static function header()
    {
        return require_once __DIR__ . "/../../../view/template/header.php";
    }

    public static function footer()
    {
        return require_once __DIR__ . "/../../../view/template/footer.php";
    }
}

