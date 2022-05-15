<?php
class HomeModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function fetchCenters()
    {
       

        $query = "SELECT * FROM center";
        $result = $this->db->runQuery($query);

        echo json_encode($result);
    }
}
