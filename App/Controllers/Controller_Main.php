<?php

namespace App\Controllers;

use App\Core\Controller;

class Controller_Main extends Controller 
{       
    function action_index() 
    { 
        $this->view->generate('main_view.php', 'template_view.php');         
    } 
}
