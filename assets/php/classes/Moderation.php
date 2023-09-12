<?php
class Moderation
{
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function isAdmin($id)
    {
        try
        {
            $query = "
                SELECT
                    roles.role
                FROM users
                JOIN
                    roles ON users.role_id = roles.id
                WHERE 
                    users.id = :id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $data = $stmt->fetch();

            if ($data)
            {
                if($data["role"] === "admin")
                {
                     return true;
                }
            }
            else
            {
                return false;
            }

        }
        catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function isModerator($id)
    {
        try
        {
            $query = "
                SELECT
                    roles.role
                FROM users
                JOIN
                    roles ON users.role_id = roles.id AND roles.role = 'moderator'
                WHERE 
                    users.id = :id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            $data = $stmt->fetch();

            if ($data)
            {
               if($data["role"] === "moderator")
               {
                    return true;
               }
            }
            else
            {
                return false;
            }

        }
        catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function isBanned($id)
    {
        try
        {
            $query  = "SELECT * FROM ban_list WHERE banned_user_id = :id ORDER BY ban_time DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            $data = $stmt->fetch();

            if ($data)
            {
                if ($data["ban_time"] > time())
                {
                    $banPeriod = (new DateTime("@" . $data["ban_time"]))->setTimezone(new DateTimeZone('Europe/Moscow'))->format("H:i:s d:m:Y");
                    $banInfo = "Вы забанены ";

                    if (!empty(trim($data["reason"])))
                    {
                        return $banInfo = $banInfo . "по причине : " . $data["reason"] . " , " . " до : " . $banPeriod . " . " . "Соблюдайте правила нашего сообщества!";
                    }
                    else
                    {
                        return $banInfo = $banInfo . " до :" . $banPeriod . " . " . " Соблюдайте правила нашего сообщества!";
                    }
                    }
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }
}