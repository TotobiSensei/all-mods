<?php
class Delete
{
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function mod($objId)
    {
        try
        {
            $this->db->beginTransaction();

            $query = "
            DELETE
                reviews
            FROM
                comments
            LEFT JOIN
                reviews ON comments.id = reviews.obj_id AND reviews.obj_type = 'comment'
            WHERE
                comments.obj_id = :objId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->execute();

            $query = "SELECT img FROM image WHERE obj_id = :objId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->execute();
            $img = $stmt->fetch();

            $query = "
                DELETE
                    mods,
                    comments,
                    image,
                    reviews,
                    views
                FROM
                    mods
                LEFT JOIN
                    comments ON mods.id = comments.obj_id AND comments.obj_type = 'mod'
                LEFT JOIN
                    image ON mods.id = image.obj_id AND image.obj_type = 'mod'
                LEFT JOIN
                    reviews ON mods.id = reviews.obj_id AND reviews.obj_type = 'mod'
                LEFT JOIN
                    views ON mods.id = views.obj_id AND views.obj_type = 'mod'
                WHERE
                    mods.id = :objId
                ";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->execute();

            $this->db->commit();

            if(!strpos($img["img"], "default"))
            {
                $tmp = "..".$img["img"];
                unlink($tmp);
            }

            header("Location: /");

        }
        catch(PDOException $e)
        {
            $this->db->rollBack();
            echo $e;
        }
    }

    public function theme($objId)
    {
        try
        {
            $this->db->beginTransaction();

            $query = "
                DELETE
                    reviews
                FROM
                    comments
                LEFT JOIN
                    reviews ON comments.id = reviews.obj_id AND reviews.obj_type = 'comment'
                WHERE
                    comments.obj_id = :objId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->execute();

            $query = "
                DELETE
                    themes,
                    comments,
                    reviews,
                    views
                FROM 
                    themes
                LEFT JOIN
                    comments ON themes.id = comments.obj_id AND comments.obj_type = 'theme'
                LEFT JOIN
                    reviews ON themes.id = reviews.obj_id AND reviews.obj_type = 'theme'
                LEFT JOIN
                    views ON themes.id = views.obj_id AND views.obj_type = 'theme'
                WHERE
                    themes.id = :objId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->execute();

            $this->db->commit();

            header("Location: /");
        }
        catch(PDOException $e)
        {
            $this->db->rollBack();

            echo $e;
        }
    }
}