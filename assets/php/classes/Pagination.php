<?php
class Pagination
{
    use Helper;
    private $db;
    private $currentPage;
    private $itemsPerPage;
    private $totalItems;

    public function __construct($itemsPerPage, $totalItems)
    {
        $this->db = new Database();
        $this->currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->itemsPerPage = $itemsPerPage;
        $this->totalItems = $totalItems;
    }

    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }
    public function getTotalPages()
    {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function renderLink()
    {   
        $uri = $_SERVER["REQUEST_URI"];
        $parseUri = parse_url($uri);

        $baseUrl = $parseUri["path"];
        $query = isset($parseUri["query"]) ? $parseUri["query"] : "";
        parse_str($query, $queryParams);
        unset($queryParams["page"]);
        $queryString = http_build_query($queryParams);

        if($this->totalItems > $this->itemsPerPage)
        {
            echo "<div class=\"pagination-wrap\">";
                echo "<div class=\"pagination\">";
                for($i=1; $i<= $this->getTotalPages(); $i++)
                {
                    $isActive = ($i == $this->currentPage) ? "active" : "";
                    $link = $baseUrl;

                    if(!empty($queryString))
                    {
                        $link .= "?" . $queryString . "&page=" . $i;
                    }
                    else
                    {
                        $link .= "?page=" . $i;
                    }
                    echo "<a class=\"$isActive\" href=\"$link\">$i</a>";
                }
                echo "</div>";
            echo "</div>";
        }
    }

    
}
?>
