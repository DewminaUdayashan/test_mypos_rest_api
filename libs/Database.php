<?php

class Database
{

    public $DB_CON = '';

    public function __construct()
    {
        $this->DB_CON = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    /**
     * @param $query MYSQL Query
     */
    public function runQuery($query)
    {
        // $result = mysqli_query($this->DB_CON, $query) or die('Error: ' . mysqli_error($this->DB_CON));
        // return $result;
        $queryResult = $this->DB_CON->query($query);
        $result = array();

        while ($fetchdata = $queryResult->fetch_assoc()) {
            $result[] = $fetchdata;
        }

        // echo json_encode($result);
        return $result;
    }

    public function insert($query)
    {
        $queryResult = $this->DB_CON->query($query) or trigger_error($this->DB_CON->error . " in " . $query);
        return $queryResult;
    }

    public function update($query)
    {
        return $this->DB_CON->query($query) ===TRUE;
    }
}