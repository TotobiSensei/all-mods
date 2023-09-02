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
}