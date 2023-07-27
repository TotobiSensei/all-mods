<?php
class Read
{
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function themes($id = NULL)
    {
        try
        {
            if($id !== NULL)
            {
                $query = "
                    SELECT 
                        themes.*, 
                        users.login, 
                        views.count
                    FROM 
                        themes
                    LEFT JOIN 
                        views ON themes.id = views.obj_id
                    LEFT JOIN 
                        users ON themes.user_id = users.id
                    WHERE 
                        themes.id = :id";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $data = $stmt->fetch();

                return $data;
            }

            $query = " 
                SELECT
                    themes.*,
                    users.login,
                    (SELECT count FROM views WHERE views.obj_id = themes.id) AS count,
                    MAX(comments.date) AS last_mess
                FROM
                    themes
                LEFT JOIN
                    users ON themes.user_id = users.id
                LEFT JOIN
                    comments ON themes.id = comments.obj_id AND comments.obj_type = 'theme'
                GROUP BY
                    themes.id";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();

            return $data;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function comment($objId, $objType, $pagination = NULL)
    {
        try
        {
            

            if(isset($pagination))
            {
                $itemsPerPage = $pagination[0];
                $offset = $pagination[1];

                $query = "
                    SELECT 
                        comments.*,
                        image.img,
                        users.login
                    FROM 
                        comments
                    LEFT JOIN
                        image ON comments.user_id = image.obj_id AND image.obj_type = 'user'
                    LEFT JOIN
                        users ON comments.user_id = users.id
                    WHERE 
                        comments.obj_id = :obj_id AND  comments.obj_type = :obj_type
                    LIMIT :itemsPerPage OFFSET :offset";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam("obj_id", $objId);
                $stmt->bindParam("obj_type", $objType);
                $stmt->bindParam(":itemsPerPage", $itemsPerPage);
                $stmt->bindParam(":offset", $offset);
                $stmt->execute();
                $data = $stmt->fetchAll();

                return $data;
            }
            else
            {
                $query = "
                    SELECT 
                        comments.*,
                        image.img,
                        users.login
                    FROM 
                        comments
                    LEFT JOIN
                        image ON comments.user_id = image.obj_id AND image.obj_type = 'user'
                    LEFT JOIN
                        users ON comments.user_id = users.id
                    WHERE 
                        comments.obj_id = :obj_id AND  comments.obj_type = :obj_type";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam("obj_id", $objId);
                $stmt->bindParam("obj_type", $objType);
                $stmt->execute();
                $data = $stmt->fetchAll();

                return $data;
            }

            
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function games($pagination = NULL)
    {
        try
        {
            if($pagination)
            {
                $itemsPerPage = $pagination[0];
                $offset = $pagination[1];

                $query = "
                    SELECT
                        games.*,
                        image.img
                    FROM
                        games
                    LEFT JOIN
                        image ON games.id = image.obj_id AND image.obj_type = 'game'
                    LIMIT :itemsPerPage OFFSET :offset
                ";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":itemsPerPage", $itemsPerPage);
                $stmt->bindParam(":offset", $offset);
                $stmt->execute();
                $data = $stmt->fetchAll();

                return $data;
            }
            else
            {
                    $query = "
                    SELECT
                        games.*,
                        image.img
                    FROM
                        games
                    LEFT JOIN
                        image ON games.id = image.obj_id AND image.obj_type = 'game'
                    ";

                    $stmt = $this->db->prepare($query);
                    $stmt->execute();
                    $data = $stmt->fetchAll();

                    return $data;
            }
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        

        
    }

    public function mods($objId, $pagination = NULL)
    {
        if($objId !== NULL)
        {
            try
            {
                if(!empty($pagination))
                {
                    $itemsPerPage = $pagination[0];
                    $offset = $pagination[1];

                    $query = "
                    SELECT
                        mods.*,
                        image.img,
                        users.login
                    FROM
                        mods
                    LEFT JOIN
                        image ON mods.id = image.obj_id AND image.obj_type = 'mod'
                    LEFT JOIN
                        users ON mods.user_id = users.id
                    WHERE
                        mods.game_id = :gameId
                    LIMIT :itemsPerPage OFFSET :offset
                    ";

                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":gameId", $objId);
                    $stmt->bindParam(":itemsPerPage", $itemsPerPage);
                    $stmt->bindParam(":offset", $offset);
                    $stmt->execute();
                    $data = $stmt->fetchAll();

                    return $data;
                }
                else
                {
                    $query = "
                    SELECT
                        mods.*,
                        image.img,
                        users.login
                    FROM
                        mods
                    LEFT JOIN
                        image ON mods.id = image.obj_id AND image.obj_type = 'mod'
                    LEFT JOIN
                        users ON mods.user_id = users.id
                    WHERE
                        mods.game_id = :gameId
                    ";

                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(":gameId", $objId);
                    $stmt->execute();
                    $data = $stmt->fetchAll();

                    return $data;
                }
                
            }
            catch(PDOException $e)
            {
                echo $e;
            }
        }
    }

    public function topMods()
    {
        try
        {
            $query = "
                SELECT
                    mods.*,
                    COALESCE((
                        SELECT SUM(rating) FROM reviews WHERE obj_type = 'mod' AND obj_id = mods.id
                    ) / (
                        SELECT COUNT(rating) FROM reviews WHERE obj_type = 'mod' AND obj_id = mods.id
                    ), 0) AS avg_rating,
                    image.img
                FROM 
                    mods
                LEFT JOIN
                    image ON mods.id = image.obj_id AND image.obj_type = 'mod'
                ORDER BY 
                    avg_rating DESC
                LIMIT
                    5
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();

            ?>
            <div class="main-carousel"> 
            <?php
                foreach($data as $item)
                {
            ?>
                    <div class="carousel-cell">
                        <div class="name"><?= mb_strimwidth($item["name"], 0, 13, "...")  ?></div>
                        <div class="img"><img src="<?= $item["img"]?>" alt=""></div>
                    </div>
                    
            <?php 
                } 
            ?>
            </div>
            <?php
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function mod($objId)
    {
        try
        {
            $query = "
                SELECT
                    mods.*,
                    image.img,
                    views.count as views,
                    users.login
                FROM
                    mods
                LEFT JOIN
                    image ON mods.id = image.obj_id AND image.obj_type = 'mod'
                LEFT JOIN
                    views ON mods.id = views.obj_id AND views.obj_type = 'mod'
                LEFT JOIN
                    users ON mods.user_id = users.id
                WHERE
                    mods.id = :modId
                ";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":modId", $objId);
            $stmt->execute();
            $data = $stmt->fetch();

            return $data;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function modsCategories()
    {
        try
        {
            $query = "SELECT * FROM mods_categories";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll();

            return $data;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function userMods($userId)
    {
       try
       {
            $query = "
                SELECT
                    mods.*,
                    views.count,
                    (
                        SELECT
                            SUM(rating)
                        FROM
                            reviews
                        WHERE
                            obj_id = mods.id AND obj_type = 'mod'
                    ) 
                    /
                    (
                        SELECT
                            COUNT(rating)
                        FROM
                            reviews
                        WHERE
                            obj_id = mods.id AND obj_type = 'mod'
                    )   AS avg_rating
                FROM
                    users
                LEFT JOIN
                    mods ON users.id = mods.user_id
                LEFT JOIN
                    views ON mods.id = views.obj_id AND views.obj_type = 'mod'
                WHERE
                    users.id = :userId
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $data = $stmt->fetchAll();

            return $data;
       }
       catch(PDOException $e)
       {
            echo $e;
       }
    }

    public function profileData($userId)
    {
        try
        {
            $query = "
                SELECT 
                    users.id, login, users.full_name, users.about_me, users.email, users.birthday, users.reg_date,
                    roles.role,
                    image.img,
                    (
                        SELECT
                            SUM(count)
                        FROM
                            views
                        WHERE
                            user_id = users.id
                    ) as views,
                    (
                        SELECT
                            SUM(rating)
                        FROM
                            reviews
                        WHERE
                            post_creator_id = users.id
                    )  as likes
                FROM 
                    users
                LEFT JOIN 
                    roles ON users.role_id = roles.id
                LEFT JOIN
                    image ON users.id = image.obj_id AND obj_type = 'user'
                WHERE 
                    users.id = :userId
                ";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $data = $stmt->fetch();

            if(isset($data["full_name"]))
            {
                $fullName = explode("/", $data["full_name"]);

                isset($fullName[0]) ? $data["name"] = $fullName[0] : $data["name"] = NULL;
                isset($fullName[1]) ? $data["surname"] = $fullName[1] : $data["surname"] = NULL;
                
                unset($data["full_name"]);

            }

            if(isset($data["birthday"]))
            {
                $nowDate = new DateTime();
                $birthday = new DateTime($data["birthday"]);

                $interval = $nowDate->diff($birthday);

                $age = $interval->y;

                $data["age"] = $age;
            }
            

            return $data;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }
}