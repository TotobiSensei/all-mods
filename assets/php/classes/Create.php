<?php
class Create
{
    use Helper;
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function theme($form)
    {
        $userId = $form["userId"];
        $header = $form["header"];
        $topic = $form["topic"];
        $text = $form["text"];

        try
        {
            $query = "INSERT INTO themes SET header = :header, topic = :topic, text = :text, date = NOW(), user_id = :userId";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":header", $header);
            $stmt->bindParam(":topic", $topic);
            $stmt->bindParam(":text", $text);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function comment($form)
    {
        $objId = $form["objId"];
        $objType = $form["objType"];
        $userId = $form["userId"];
        $message = $form["message"];

        try
        {
            $query = "INSERT INTO comments SET obj_id = :objId, obj_type = :objType, user_id = :userId, message = :message, date = NOW()";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("objId", $objId);
            $stmt->bindParam("objType", $objType);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("message", $message);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function mod($form)
    {
        $name = $form["name"];
        $description = $form["description"];
        $categoryId = $form["categoryId"];
        $img = $form["img"];
        $link = $form["link"];
        $userId = $form["userId"];
        $gameId = $form["gameId"];

        if(empty($name) || empty($link))
        {
            throw new Exception("Поля названия и ссылки на скачивание обьязательны к заполнению!");
        }

        if(!preg_match("/^[a-zA-Z0-9_-]{3,50}$/", $name))
        {
            throw new Exception("Некорректнное название используйте латинницу!");
        }

        if(!filter_var($link, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))
        {
            throw new Exception("Некорректная ссылка!");
        }

        if(isset($img) && $img["error"] == 0)
        {
            $allowType = ["image/jpeg", "image/png", "image/jpg"];
            $allowSize = 1024 * 1024 * 2;

            if(in_array($img["type"], $allowType) && $img["size"] <= $allowSize)
            {
                $fileName = uniqid()."_".$img["name"];

                $destination = "../assets/img/mod_img/".$fileName;

                if(!move_uploaded_file($img["tmp_name"], $destination))
                {
                    throw new Exception("Ошибка при загрузке файла!");
                }
            }
        }
        else
        {
            $destination = "/assets/img/mod_img/mod_default_img.jpg";
        }

        try
        {
            $this->db->beginTransaction();

            $query = "INSERT INTO mods SET name = :name, description = :description, category_id = :categoryId, file_name = :link, upload = NOW(), user_id = :userId, game_id = :gameId";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":categoryId", $categoryId);
            $stmt->bindParam(":link", $link);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":gameId", $gameId);

            $stmt->execute();

            $objId = $this->db->lastInsertId();
            $destination = str_replace('..', '', $destination);

            $query = "INSERT INTO image SET obj_id = :objId, obj_type = 'mod', img = :path";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->bindParam(":path", $destination);
            $stmt->execute();

            $this->db->commit();

            return true;
        }
        catch(PDOException $e)
        {
            $this->db->rollBack();

            $destination = "..".$destination;
            if(!strpos($destination, "default"))
            {
                unlink($destination);
            }

            echo $e;
        }

    }

    public function report($form)
    {
        $objId = $form["objId"];
        $objType = $form["objType"];
        $reportingUser = $form["reportingUser"];
        $reportType = $form["reportType"];
        $addition = $form["addition"];

        $reportsTmp = implode("/", $reportType);

        try
        {
            $query = "INSERT INTO reports SET obj_id = :objId, obj_type = :objType, reporting_user_id = :reportingUser, report_type = :reportType, addition = :addtion";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(":objId", $objId);
            $stmt->bindParam(":objType", $objType);
            $stmt->bindParam(":reportingUser", $reportingUser);
            $stmt->bindParam(":reportType", $reportsTmp);
            $stmt->bindParam(":addtion", $addition);

            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function message($form)
    {
        $fromUserId = $form["fromUserId"];
        $toUserId = $form["toUserId"];
        $message = $form["message"];
        $date = time();
        $dialogId = $this->generateDialogId($fromUserId, $toUserId);

        try
        {
            $query = "INSERT INTO messages SET message = :message, date = :date, from_user_id = :fromUserId, to_user_id = :toUserId, dialog_id = :dialogId";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":message", $message);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":fromUserId", $fromUserId);
            $stmt->bindParam(":toUserId", $toUserId);
            $stmt->bindParam(":dialogId", $dialogId);
            $stmt->execute();

            header("Location: http://". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }
}