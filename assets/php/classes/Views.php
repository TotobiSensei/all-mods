<?php
class Views
{
    private $db;

    public function __construct()
    {
        $this->db = Database::pdo();
    }

    public function incViewsCount($id, $userId, $type)
    {
        try
        {   
            $query = "SELECT COUNT(*) FROM views WHERE obj_id = :obj_id AND obj_type = :obj_type AND user_id = :userId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam("obj_id", $id);
            $stmt->bindParam("obj_type", $type);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if($count > 0)
            {
                $query = "UPDATE views SET count = count +1 WHERE obj_id = :obj_id AND obj_type = :obj_type AND user_id = :userId";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam("obj_id", $id);
                $stmt->bindParam("obj_type", $type);
                $stmt->bindParam(":userId", $userId);
                $stmt->execute();
            }
            else
            {
                $query = "INSERT INTO views SET obj_id = :obj_id, obj_type = :obj_type, user_id = :userId, count = 1";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam("obj_id", $id);
                $stmt->bindParam("obj_type", $type);
                $stmt->bindParam(":userId", $userId);
                $stmt->execute();
            }
            
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }
}