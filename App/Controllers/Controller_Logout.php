<?php

namespace App\Controllers;

use App\Core\Controller;

class Controller_logout extends Controller
{	
    function action_index()	
    {
        session_destroy();
        unset ($_COOKIE['user_id']);
        setcookie('user_id', null, -1, '/');
        header("Location:" . URL);       
    }
}
