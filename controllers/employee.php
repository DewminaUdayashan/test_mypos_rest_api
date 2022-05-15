<?php

class Employee extends Controller{

    function __construct(){   
        parent::__construct();
    }

    function index(){
        // $this->view->title = 'title';
        // $this->view->render('view_folder/index',true);
    }

    function uploadImage()
    {
        $this->model->uploadImage();
    }

    function addEmployee(){
        $this->model->addEmployee();
    }

    function fetchEmployees(){
        $this->model->fetchEmployees();
    }

    function searchEmployees(){
        $this->model->searchEmployees();
    }

    function deleteEmployee(){
        $this->model->deleteEmployee();
    }

    
    function updateEmployee(){
        $this->model->updateEmployee();
    }
}
