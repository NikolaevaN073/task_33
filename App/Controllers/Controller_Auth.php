<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\DataBase;
use App\Core\Auth;
use App\Core\View;
use App\Models\Model_Auth;

class Controller_Auth extends Controller 
{    
    protected $db;
    protected $auth;
    public $model;
	public $view;

    function __construct() 
    {
        $this->db = new DataBase;
        $this->auth = new Auth($this->db);
        $this->model = new Model_Auth($this->db, $this->auth);
        $this->view = new View();
    }   
    
    function action_index() 
    {    
        $data = $this->model->get_data();

        if ($data['home']) {
            $this->view->generate('auth_view.php', 'template_view.php');
            header('Location: /home'); exit();
        } else {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            $this->view->generate('auth_view.php', 'template_view.php', $data);        
           
        }   
    } 
}
