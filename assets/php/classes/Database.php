<?php

class Database
{
    private static $pdo;

    public static function pdo()
    {
        $params = Config::getConfig();

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try
        {
            self::$pdo = new PDO($params["db"], $params["user"], $params["psw"], $options);

            return self::$pdo;

        }catch(PDOException $e)
        {
            echo "Error :".$e->getMessage();
        }
    }
}