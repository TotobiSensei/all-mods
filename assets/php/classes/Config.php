<?php

class Config
{
    private static $dbConfig = 
    [
        "db" => "mysql:host=localhost;dbname=all_mods", 
        "user" => "root", 
        "psw" => "",
    ];

    public static function getConfig()
    {
        return self::$dbConfig;
    }
}