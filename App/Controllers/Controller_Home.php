<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\DataBase;
use App\Core\View;
use App\Models\Model_Home;

class Controller_Home extends Controller 
{      
    protected $db;
    public $model;
	public $view;

    function __construct() 
    {
        $this->db = new DataBase;
        $this->model = new Model_Home($this->db);
        $this->view = new View();
    }  
    
    function action_index() 
    { 

        if (isset($_POST['search']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->search($_POST['search']);
        }

        $data['contacts'] = $this->model->get_data();
        $this->view->generate('home_view.php', 'template_view.php', $data);         
    } 

    function search ($search)
    {
        echo json_encode($this->model->get_contact ($search), JSON_UNESCAPED_UNICODE);
    }
}
