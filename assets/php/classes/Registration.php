<?php
class Registration
{
    private $db;
    
    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function register($login, $email, $psw, $conf_psw)
    {
        //проверка веденных данных
        if(empty($login) || empty($email) || empty($psw))
        {
            throw new Exception("Не все поля заполнены!");
        }

        if(!preg_match("/^[a-zA-Z0-9_-]{3,16}$/", $login))
        {
            throw new Exception("Некоретный логин! Можно использовать латиницу, цифры и символы \"_ -\"");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new Exception("Некоректный емейл!");
        }

        if(strlen($psw) < 6)
        {
            throw new Exception("Минимальная длинна пароля 6 символов.");
        }

        if($psw !== $conf_psw)
        {
           throw new Exception("Пароли не совпадают.");
        }

        $hash = password_hash($psw, PASSWORD_DEFAULT);

        $query = "SELECT * FROM users WHERE login = :login or email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->execute(["login" => $login, "email" => $email]);
        $count = $stmt->fetchColumn();

        if($count > 0)
        {
            throw new Exception("Пользователь с таким логином или почтой уже существует!");
        }

        try
        {
            $firstName = "user_".rand(1,999);

            $query = "INSERT INTO users (login, full_name, email, psw_hash, reg_date, role_id) VALUES (:login, :full_name, :email, :psw, NOW(), 3)";
            $stmt = $this->db->prepare($query);
            $stmt->execute(["login" => $login, "full_name"=>$firstName, "email" => $email, "psw" => $hash]);
        }
        catch(PDOException $e)
        {
            echo "Error: ". $e->getMessage();
        }

        return true;

    }
}