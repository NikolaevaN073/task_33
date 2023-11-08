<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\DataBase;
use App\Core\View;
use App\Models\Model_Register;

class Controller_Register extends Controller 
{       
    protected $db;
    public $model;
	public $view;

    function __construct() 
    {
        $this->db = new DataBase;
        $this->model = new Model_Register($this->db);
        $this->view = new View();
    }

    function action_index() 
    { 
        if (isset($_POST['nickname'])) {
            $this->register($_POST);  
        }
        $this->view->generate('register_view.php', 'template_view.php');         
    } 

    public function register($data) 
    { 
        echo json_encode($this->model->register_user($data), JSON_UNESCAPED_UNICODE);       
        header('Location: /auth');  exit();
    }
}