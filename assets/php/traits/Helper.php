<?php
trait Helper
{
    private function issetUriParam($var) {
        $params = $_GET;
        return isset($params[$var]);
    }

    private function removeUriParam($param)
    {
        $currentURL = "http://". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $currentURL = preg_replace('/[?&]' . preg_quote($param, '/') . '=[^&#]+/', '', $currentURL);

        header("Location: $currentURL");
        exit;
    }
}