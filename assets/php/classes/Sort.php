<?php
class Sort
{
    use Helper;
    private $db;
    private $itemsPerPage;
    private $offset;
    // private $table;
    // private $sortBy;
    // private $sortOrder;
    // private $category;

    public function __construct($pagination = NULL)
    {
        $this->db = Database::pdo();

        $this->itemsPerPage = $pagination["itemsPerPage"];

        $this->offset = $pagination["offset"];


        // $this->table = $table;
        // $this->sortBy = $sortBy;
        // $this->sortOrder = $sortOrder;
        // $this->category = $category;
    }

    
    public function sortMods($sortBy, $sortOrder, $category = NULL)
    {
        
        try
        {
            $categorySubquery = "";

            if($category !== NULL && $category !== "")
            {
                $categorySubquery = "
                    JOIN
                        mods_categories AS c ON m.category_id = c.id
                    WHERE
                        c.id = :categoryId
                ";
            }


            switch ($sortBy) {
                case "rating":

                    $query = "
                    SELECT
                        m.*,
                        i.img,
                        reviews.avg_rating
                    FROM
                        mods m
                    JOIN
                        image i ON m.id = i.obj_id AND i.obj_type = 'mod'
                    LEFT JOIN
                        (
                            SELECT
                                AVG(rating) as avg_rating, obj_id
                            FROM
                                reviews
                            WHERE
                                obj_type = 'mod'
                            GROUP BY
                                obj_id
                        ) as reviews
                    ON
                        m.id = reviews.obj_id
                    $categorySubquery
                    ORDER BY
                        reviews.avg_rating $sortOrder
                    LIMIT
                        :itemsPerPage
                    OFFSET
                        :offset
                    ";
                    break;

                case "views" :

                    $query = "
                        SELECT
                            m.*,
                            i.img,
                            v.count
                        FROM
                            mods m
                        JOIN
                            image i ON m.id = i.obj_id AND i.obj_type = 'mod'
                        LEFT JOIN
                            views v ON m.id = v.obj_id AND v.obj_type = 'mod'
                        $categorySubquery
                        ORDER BY
                            v.count $sortOrder
                        LIMIT
                            :itemsPerPage
                        OFFSET
                            :offset
                    ";
                    break;
                
                case "upload" :

                    $query = "
                        SELECT
                            m.*,
                            i.img
                        FROM
                            mods m
                        JOIN
                            image i ON m.id = i.obj_id AND i.obj_type = 'mod'
                        $categorySubquery
                        ORDER BY
                            m.upload $sortOrder
                        LIMIT
                            :itemsPerPage
                        OFFSET
                            :offset
                    ";
                    break;

                case "update" :

                    $query = "
                        SELECT
                            m.*,
                            i.img
                        FROM
                            mods m
                        JOIN
                            image i ON m.id = i.obj_id AND i.obj_type = 'mod'
                        $categorySubquery
                        ORDER BY
                            m.updated $sortOrder
                        LIMIT
                            :itemsPerPage
                        OFFSET
                            :offset
                    ";
                    break;
                    
                    default :

                        $query = "
                            SELECT
                                m.*,
                                i.img
                            FROM
                                mods m
                            JOIN
                                image i ON m.id = i.obj_id AND i.obj_type = 'mod'
                            $categorySubquery
                            ORDER BY
                                m.name $sortOrder
                            LIMIT
                                :itemsPerPage
                            OFFSET
                                :offset
                        ";
                
            }

            $stmt = $this->db->prepare($query);
            if ($category !== NULL && $category !== "") : $stmt->bindValue(":categoryId", $category); endif;
            $stmt->bindValue(":itemsPerPage", $this->itemsPerPage);
            $stmt->bindValue(":offset", $this->offset);
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