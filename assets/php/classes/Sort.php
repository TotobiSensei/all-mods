<?php
class Sort
{
    use Helper;
    private $db;
    private $table;
    private $sortBy;
    private $sortOrder;
    private $category;

    public function __construct($table, $sortBy, $sortOrder, $category = NULL)
    {
        $this->db = Database::pdo();
        $this->table = $table;
        $this->sortBy = $sortBy;
        $this->sortOrder = $sortOrder;
        $this->category = $category;
    }

    public function sortItemsBy($itemsPerPage, $offset)
    {
       try
       {
            if(basename($_SERVER['PHP_SELF']) === 'themes.php')
            {
                
                $query = "
                    SELECT 
                        $this->table.*, 
                        views.count, 
                        users.login,
                        (SELECT MAX(date) FROM comments WHERE comments.obj_id = themes.id AND comments.obj_type = 'theme') AS last_mess
                    FROM themes
                    LEFT JOIN 
                        views ON $this->table.id = views.obj_id AND views.obj_type = 'theme'
                    LEFT JOIN 
                        users ON $this->table.user_id = users.id
                    ORDER BY $this->sortBy " . ($this->sortOrder === 'ASC' ? 'ASC' : 'DESC') . " 
                    LIMIT :itemsPerPage OFFSET :offset
                    ";

                if($this->sortBy == "rating")
                {
                    $query = "
                    SELECT 
                        $this->table.*, 
                        views.count, 
                        users.login, 
                        (SELECT AVG(rating) FROM reviews WHERE reviews.obj_id = themes.id AND reviews.obj_type = 'theme') AS rating,
                        (SELECT MAX(date) FROM comments WHERE comments.obj_id = themes.id AND comments.obj_type = 'theme') AS last_mess
                    FROM themes
                    LEFT JOIN 
                        views ON $this->table.id = views.obj_id AND views.obj_type = 'theme'
                    LEFT JOIN 
                        users ON $this->table.user_id = users.id
                    ORDER BY $this->sortBy " . ($this->sortOrder === 'ASC' ? 'ASC' : 'DESC') . "
                    LIMIT :itemsPerPage OFFSET :offset
                    ";
                }
            }
            else
            {
                $categoryQuery = null;

                if($this->category !== "")
                {
                    $categoryQuery = "
                    LEFT JOIN mods_categories AS category ON $this->table.category_id = category.id
                    WHERE category.id = :category_id 
                    ";
                }

                $query = "
                SELECT $this->table.*, image.img 
                FROM $this->table
                JOIN image ON $this->table.id = image.obj_id AND image.obj_type = 'mod'
                ".$categoryQuery."
                ORDER BY $this->sortBy " . ($this->sortOrder === 'ASC' ? 'ASC' : 'DESC') . " 
                LIMIT :itemsPerPage OFFSET :offset
                ";

                if($_GET["sort"] === "rating")
                {
                    $query = "
                    SELECT subquery.avg_rating, mods.*, image.img
                    FROM mods
                    LEFT JOIN (
                        SELECT AVG(rating) AS avg_rating, obj_id
                        FROM reviews
                        GROUP BY obj_id
                    ) AS subquery ON mods.id = subquery.obj_id
                    JOIN image ON mods.id = image.obj_id AND image.obj_type = 'mod' "
                    . $categoryQuery .
                    "ORDER BY subquery.avg_rating " . ($this->sortOrder === 'ASC' ? 'ASC' : 'DESC') . "
                    LIMIT :itemsPerPage OFFSET :offset
                    ";
                }
            }

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':itemsPerPage', $itemsPerPage);
            $stmt->bindValue(':offset', $offset);
            if($this->category !== "")  $stmt->bindValue(":category_id", $this->category);
            $stmt->execute();
            $data = $stmt->fetchAll();

            return $data;
       }
       catch(PDOException $e)
       {
            echo $e;
       }
    }
}