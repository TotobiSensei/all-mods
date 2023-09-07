<?php
class Reviews
{
    use Helper;
    private $db;
    private $auth;

    public function __construct()
    {
        $this->db = Database::pdo();
        $this->auth = new Authentication();
    }

    public function reviewRender($objId, $objType, $otherParam = null)
    {
        if($objType == "mod")//рендер рейтинга для модів
        {
            try
            {
                $query = "SELECT * FROM reviews WHERE obj_id = :objId AND obj_type = :objType AND rating > 0";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":objId", $objId);
                $stmt->bindParam(":objType", $objType);
                $stmt->execute();
                $data = $stmt->fetchAll();

                $rating = 0;

                if(!empty($data))
                {
                    

                    $count = count($data);

                    foreach($data as $row)
                    {
                        $rating += $row["rating"];
                    }

                    $rating /= $count;
                }
                ?>

                    <form action="" class="rating-form" method="POST">
                        <?php 
                            for($i=1; $i<=5; $i++) : 
                                $active = ceil($rating) >= $i ? "active" : "" ;
                                if(!$this->auth->checkAuth() || !$this->issetUriParam("mod-id")) :
                        ?>
                                    <span class="static <?= $active ?>">★</span>
                        <?php
                                else :
                        ?>
                                    <label for="" class="<?= $active ?>">
                                        <span>★</span>
                                        <input type="submit" name="star" value="<?= $i ?>">
                                    </label>
                        <?php
                                endif;
                            endfor;
                        ?>
                    </form>

                <?
            }
            catch(PDOException $e)
            {
                echo $e;
            }
        }
        else
        {
            if($objType !== "theme")//рендер лайків для коментарів
            {
                try
                {
                    $query = "
                    SELECT c.id, r.sum
                    FROM comments c
                    INNER JOIN (
                        SELECT SUM(rating) AS sum, obj_id
                        FROM reviews
                        GROUP BY obj_id
                    ) AS r ON c.id = r.obj_id 
                    WHERE c.obj_id = :objId AND c.id = :commentId
                    ";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":objId", $objId);
                    $stmt->bindParam(":commentId", $otherParam["commentId"]);
                    $stmt->execute();
                    $data = $stmt->fetch();

                    $query = "SELECT rating FROM reviews WHERE obj_id = :objId AND obj_type = :objType AND user_id = :userId";

                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":objId", $otherParam["commentId"]);
                    $stmt->bindParam(":objType", $objType);
                    $stmt->bindParam(":userId", $otherParam["userId"]);
                    $stmt->execute();
                    $dataActive = $stmt->fetch();

                    if(!empty($data))
                    {
                            $val = ceil($data["sum"]);

                            $activeUp = @$dataActive["rating"] === 1 ? "active" : "";
                            $activeDown = @$dataActive["rating"] === -1 ? "active" : "";
                            echo " 
                                <form class=\"post-action\" action=\"\" method=\"post\">
                                    <div class=\"reviews\">
                                        <input type=\"hidden\" name=\"objType\" value=\"$objType\">
                                        <input type=\"hidden\" name=\"comment\" value=\"{$otherParam["commentId"]}\">
                                        <input type=\"hidden\" name=\"postCreatorId\" value=\"{$otherParam["postCreatorId"]}\">
                                        <label class=\"up\" for=\"rating\">
                                            <span class=\"$activeUp\">&#128402</span>
                                            <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"up\">
                                        </label>
                                        <span>$val</span>
                                        <label class=\"down\" for=\"rating\">
                                            <span class=\"$activeDown\">&#128403;</span>
                                            <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"down\">
                                        </label>
                                    </div>
                                </form>
                                ";
                    }
                    else
                    {
                        echo "
                        <form class=\"post-action\" action=\"\" method=\"post\">
                            <div class=\"reviews\">
                                <input type=\"hidden\" name=\"objType\" value=\"$objType\">
                                <input type=\"hidden\" name=\"comment\" value=\"{$otherParam["commentId"]}\">
                                <input type=\"hidden\" name=\"postCreatorId\" value=\"{$otherParam["postCreatorId"]}\">
                                <label class=\"up\" for=\"rating\">
                                    &#128402
                                    <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"up\">
                                </label>
                                <label class=\"down\" for=\"rating\">
                                    &#128403;
                                    <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"down\">
                                </label>
                            </div>
                        </form>
                        ";
                    }
                }
                catch(PDOException $e)
                {
                    echo $e;
                }
            }
            else//рендер лайків для шапки теми
            {
                try
                {
                    $query = "SELECT SUM(rating) AS sum FROM reviews WHERE obj_id = :objId AND obj_type = :objType GROUP BY obj_id";

                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":objId", $objId);
                    $stmt->bindParam("objType", $objType);
                    $stmt->execute();
                    $data = $stmt->fetch();

                    $query = "SELECT rating FROM reviews WHERE obj_id = :objId AND obj_type = :objType AND user_id = :userId";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":objId", $objId);
                    $stmt->bindParam(":objType", $objType);
                    $stmt->bindParam(":userId", $otherParam["userId"]);
                    $stmt->execute();
                    $dataActive = $stmt->fetch();

                    if(!empty($data))
                    {
                            $val = ceil($data["sum"]);

                            $activeUp = @$dataActive["rating"] === 1 ? "active" : "";
                            $activeDown = @$dataActive["rating"] === -1 ? "active" : "";
                            echo " 
                                <form class=\"post-action\" action=\"\" method=\"post\">
                                    <div class=\"reviews\">
                                        <input type=\"hidden\" name=\"objType\" value=\"$objType\">
                                        <input type=\"hidden\" name=\"postCreatorId\" value=\"{$otherParam["postCreatorId"]}\">
                                        <label class=\"up\" for=\"rating\">
                                            <span class=\"$activeUp\">&#128402</span>
                                            <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"up\">
                                        </label>
                                        <span>$val</span>
                                        <label class=\"down\" for=\"rating\">
                                            <span class=\"$activeDown\">&#128403;</span>
                                            <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"down\">
                                        </label>
                                    </div>
                                </form>
                                ";
                    }
                    else
                    {
                        echo "
                        <form class=\"post-action\" action=\"\" method=\"post\">
                            <div class=\"reviews\">
                                <input type=\"hidden\" name=\"objType\" value=\"$objType\">
                                <input type=\"hidden\" name=\"postCreatorId\" value=\"{$otherParam["postCreatorId"]}\">
                                <label class=\"up\" for=\"rating\">
                                    &#128402
                                    <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"up\">
                                </label>
                                <label class=\"down\" for=\"rating\">
                                    &#128403;
                                    <input  id=\"rating\" type=\"submit\" name=\"rating\" value=\"down\">
                                </label>
                            </div>
                        </form>
                         ";
                    }
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }
            
        }
    }

    public function addReview($form)
    {
        $objId = $form["objId"];
        $objType = $form["objType"];
        $userId = $form["userId"];
        $postCreatorId = $form["postCreatorId"];
        $rating = $form["rating"];

        if(empty($userId))
        {
            throw new Exception("Войдите или зарегистрируйтесь, что бы оценивать коментарии или темы.");
        }

        if($objType !== "mod")//обробник для коментарів та шапки теми
        {
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
                        $query = "INSERT INTO reviews SET `obj_id` = :objId, `obj_type` = :objType, `user_id` = :userId, `post_creator_id` = :postCreatorId, `rating` = 1";
                    }
                    elseif($rating === "down")
                    {
                        $query = "INSERT INTO reviews SET `obj_id` = :objId, `obj_type` = :objType, `user_id` = :userId, `post_creator_id` = :postCreatorId, `rating` = -1";
                    }

                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":objId", $objId);
                    $stmt->bindParam(":objType", $objType);
                    $stmt->bindParam(":userId", $userId);
                    $stmt->bindParam(":postCreatorId", $postCreatorId);
                    $stmt->execute();
                }

                return true;
            }
            catch(PDOException $e)
            {
                echo "Произошла ошибка при выполнении запроса: " . $e->getMessage();
            }
        }

        try//обробник рейтинга для модів
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
                $stmt->execute();

                $this->removeUriParam("rating");

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

                $this->removeUriParam("rating");

                return true;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        } 
    }
}