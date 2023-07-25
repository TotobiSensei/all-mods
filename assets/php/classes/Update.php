<?php
class Update
{
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function theme($form)
    {
        $themeId = $form["themeId"];
        $userId = $_POST["userId"];
        $header = $_POST["header"];
        $topic = $_POST["topic"];
        $text = $_POST["text"];

        try
        {
            $query = "UPDATE themes SET header = :header, topic = :topic, text = :text, updated = NOW() WHERE id = :themeId AND user_id = :userId";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":header", $header);
            $stmt->bindParam(":topic", $topic);
            $stmt->bindParam(":text", $text);
            $stmt->bindParam(":themeId", $themeId);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function profile($form)
    {
        $img = $form["image"];
        $userId = $form["userId"];
        try
        {
           if(isset($img))
           {
                $decodedImg = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

                $maxSize = 5 * 1024 * 1024;

                $fileMimeType = mime_content_type($img);
                if($fileMimeType !== "image/jpeg" && $fileMimeType !== "image/png")
                {
                    throw new Exception("Ошибка! Используйте изображения с расширением JPEG или PNG");
                }

                if(strlen($decodedImg) > $maxSize)
                {
                    throw new Exception("Ошибка! Максимальный размер изображения не должен превышать 5мб.");
                }

                $path = "../assets/img/users_logo/" . $userId . "_"  . uniqid() . ".jpeg";

                if(!file_put_contents($path, $decodedImg))
                {
                    throw new Exception("Ошибка при загрузке изображения, попробуйте позже");
                }

                try
                {
                    $query = "SELECT img FROM image WHERE obj_id = :userId AND obj_type = 'user'";

                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":userId", $userId);
                    $stmt->execute();
                    $oldImg = $stmt->fetch();
    
                    $path = str_replace('..', '', $path);
                    var_dump($oldImg);
                    if($oldImg !== FALSE)
                    {
                        $oldImgPath = "..".$oldImg["img"];
                        if(file_exists($oldImgPath))
                        {
                            unlink($oldImgPath);
                        }
                        else
                        {
                            echo "file not found";
                        }
                        $query = "UPDATE image SET img = :path WHERE obj_id = :userId AND obj_type = 'user'";
    
                        $stmt = $this->db->prepare($query);
                        $stmt->bindParam(":userId", $userId);
                        $stmt->bindParam(":path", $path);
                        $stmt->execute();

                       
                        if($stmt->rowCount() > 0)
                        {
                            $oldImgPath = "..".$oldImg["img"];
                            unset($oldImgPath);
                        }
                    }
                    else
                    {
                        $query = "INSERT INTO image SET obj_id = :userId, obj_type = 'user', img = :path";
    
                        $stmt = $this->db->prepare($query);
                        $stmt->bindParam(":userId", $userId);
                        $stmt->bindParam(":path", $path);
                        $stmt->execute();
                    }
                        
                    if($stmt->rowCount() > 0)
                    {
                        
                    }

                }
                catch(PDOException $e)
                {
                    echo $e;
                }

                return  true;
           }

           $login = $form["login"];
           $name = $form["name"];
           $surname = $form["surname"];
           $birthday = $form["birthday"];
           $about = $form["about"];

           if(empty(trim($login)))
           {
               throw new Exception("Заполните поле логина!");
           }

           if(empty(trim($name)))
           {
               throw new Exception("Заполните поле имени!");
           }

           if(empty(trim($surname)))
           {
               throw new Exception("Заполните поле Фамилии!");
           }

           if(!preg_match("/^[a-zA-Z0-9_-]{3,16}$/", $login))
           {
               throw new Exception("Некоретный логин! Можно использовать латиницу, цифры и символы \"_ -\"");
           }

           if(empty(trim($birthday)) || $birthday == "")
           {
               $birthday = NULL;
           }

           if(empty(trim($about)) || $about == "")
           {
               $about = NULL;
           }

           try
           {
                $query = "SELECT COUNT(*) FROM users WHERE login = :login";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":login", $login);
                $stmt->execute();
                $count = $stmt->fetchColumn();

                if($count)
                {
                    $query = "SELECT login FROM users WHERE id = :userId";

                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":userId", $userId);
                    $stmt->execute();
                    $user = $stmt->fetch();

                    if($login !== $user["login"])
                    {
                        throw new Exception("Пользователь с таким логином уже зарегестрирован!");
                    }
                    
                }  

                $fullName = implode("/", [$name, $surname]);

                

                $query = "UPDATE users SET login = :login, full_name = :fullName, about_me = :about, birthday = :birthday WHERE id = :userId";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":userId", $userId);
                $stmt->bindParam(":login", $login);
                $stmt->bindParam(":fullName", $fullName);
                $stmt->bindParam(":about", $about);
                $stmt->bindParam(":birthday", $birthday);
                $stmt->execute();

                return true;
           }
           catch(PDOException $e)
           {
                echo $e;
           }
        }
        catch(Exception $e)
        {
            $_SESSION["error"] = $e;
        }
    }
}