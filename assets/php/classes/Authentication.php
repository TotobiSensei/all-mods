<?php

class Authentication
{
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function login($login, $psw)
    {
        if($this->validate($login, $psw))
        {

            $stmt = $this->db->prepare("SELECT * FROM users WHERE login = :login");
            $stmt->execute(["login" => $login]);
            $user = $stmt->fetch();


            $_SESSION["user"] = $user["id"];
            
            return true;
        }

        return false;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /");
        exit;
    }

    public function checkAuth()
    {
        return isset($_SESSION["user"]);
    }

    private function validate($login, $psw)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login = :login");
        $stmt->execute(["login" => $login]);
        $user = $stmt->fetch();

        // Проверяем, что пользователь с таким логином существует в базе данных
        if (!$user) {
            return false;
        }

        if($user && password_verify($psw, $user["psw_hash"]))
        {
            return true;
        }

        return false;
    }
}