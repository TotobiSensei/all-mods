<?php
class Reviews
{
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function addModReview($form)
    {
        $objId      = $form["objId"];
        $objType    = $form["objType"];
        $userId     = $form["userId"];
        $rating     = $form["rating"];

        if(empty($userId))
        {
            throw new Exception("Войдите или зарегистрируйтесь, что бы оценивать коментарии или темы.");
        }

        try
        {
            $query = "SELECT COUNT(rating) FROM reviews WHERE obj_id = :objId AND obj_type = :objType and user_id = :userId"; 

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->bindParam(":objType", $objType);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if($count > 0)
            {
                $query = "UPDATE reviews SET rating = :rating WHERE obj_id = :objId AND obj_type = :objType and user_id = :userId";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":rating", $rating);
                $stmt->bindParam(":objId", $objId);
                $stmt->bindParam(":objType", $objType);
                $stmt->bindParam(":userId", $userId);
                $stmt->execute();;

                return true;
            }
            else
            {
                $stmt = $this->db->prepare("INSERT INTO reviews SET `obj_id` = :objId, `obj_type` = :objType, `user_id` = :userId, `rating` = :rating");
                $stmt->bindParam(":objId", $objId);
                $stmt->bindParam(":objType", $objType);
                $stmt->bindParam(":userId", $userId);
                $stmt->bindParam(":rating", $rating);
                $stmt->execute();

                return true;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }

    public function addUserReview($form)
    {
        $objId = $form["objId"];
        $objType = $form["objType"];
        $userId = $form["userId"];
        $objCreatorId = $form["objCreatorId"];
        $rating = $form["rating"];

        if(empty($userId))
        {
            throw new Exception("Войдите или зарегистрируйтесь, что бы оценивать коментарии или темы.");
        }
        try
        {
            $query = "SELECT rating FROM reviews WHERE obj_id = :objId AND obj_type = :objType and user_id = :userId";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":objId", $objId);
            $stmt->bindParam(":objType", $objType);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $data = $stmt->fetch();

            if($data !== false)
            {
                if($rating === "up")
                {
                    if($data["rating"] < 1)
                    {
                        $query = "UPDATE reviews SET rating = 1 WHERE obj_id = :objId AND obj_type = :objType AND user_id = :userId";
                    }
                    else
                    {
                        $query = "DELETE FROM reviews WHERE obj_id = :objId AND obj_type = :objType AND user_id = :userId";
                    }
                }
                elseif($rating === "down")
                {
                    if($data["rating"] > -1 && $data['rating'] <= 1)
                    {
                        $query = "UPDATE reviews SET rating = -1 WHERE obj_id = :objId AND obj_type = :objType AND user_id = :userId";
                    }
                    else
                    {
                        $query = "DELETE FROM reviews WHERE obj_id = :objId AND obj_type = :objType AND user_id = :userId";
                    }
                }

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":objId", $objId);
                $stmt->bindParam(":objType", $objType);
                $stmt->bindParam(":userId", $userId);
                $stmt->execute();
            }
            else
            {
                if($rating === "up")
                {
                    $query = "INSERT INTO reviews SET `obj_id` = :objId, `obj_type` = :objType, `user_id` = :userId, `post_creator_id` = :objCreatorId, `rating` = 1";
                }
                elseif($rating === "down")
                {
                    $query = "INSERT INTO reviews SET `obj_id` = :objId, `obj_type` = :objType, `user_id` = :userId, `post_creator_id` = :objCreatorId, `rating` = -1";
                }

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":objId", $objId);
                $stmt->bindParam(":objType", $objType);
                $stmt->bindParam(":userId", $userId);
                $stmt->bindParam(":objCreatorId", $objCreatorId);
                $stmt->execute();
            }

            return true;
        }
        catch(PDOException $e)
        {
            echo "Произошла ошибка при выполнении запроса: " . $e->getMessage();
        } 
    }
}