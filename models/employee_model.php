<?php
class EmployeeModel extends Model
{
    function __construct(){
        parent::__construct();
    }
    
    function uploadImage(){
        $image = $_POST['image'];
        $name = $_POST['name'];
     
        $realImage = base64_decode($image);
     
      $res =  file_put_contents("uploads/".$name, $realImage);  
      if($res) 
      echo json_encode(true); else echo json_encode(false);
    }

    function addEmployee(){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $dob = $_POST['dob'];
            $type = $_POST['type'];
            $url = $_POST['url'];
    
            $query = "INSERT INTO employees (id,name, email, mobile,dob,type,url)"
            ." VALUES ('".$id."','" . $name . "', '" . $email . "',  '" . $mobile . "','" . $dob . "','" . $type . "', '" . $url . "')";
            $result = $this->db->insert($query);
            echo json_encode($result);
    }

    function updateEmployee(){
        $autId = $_POST['aut_id'];
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];
        $type = $_POST['type'];
        $url = $_POST['url'];

        $query = "UPDATE employees SET id='".$id ."',name='".$name . "',mobile='".$mobile . "',type='".$type . "'".
        ",dob='".$dob . "',url='".$url . "',email='".$email."' WHERE aut_id = ".$autId . "";
        $result = $this->db->update($query);
        echo json_encode($result);
}

    function fetchEmployees() {
        $query = "SELECT * FROM employees";
        $result = $this->db->runQuery($query);
        echo json_encode($result);
    }

    function searchEmployees(){
            $term = $_POST['term'];
            $query = "SELECT * FROM employees WHERE name LIKE '%".$term."%'";
            $result = $this->db->runQuery($query);
            echo json_encode($result);
    }

    function deleteEmployee()
    {
        $id = $_POST['id'];
        $query = "DELETE FROM employees WHERE aut_id = ".$id;
        $result = $this->db->update($query);
        echo json_encode($result);
    }

}
