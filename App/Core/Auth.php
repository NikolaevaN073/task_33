<?php

namespace App\Core;

use App\Core\DataBase;

class Auth
{    
    public $login, $password, $token, $db;
    
    public function __construct(DataBase $db)
    {        
        $this->db = $db;
    }

    public function check_token ()
    {        
        if (isset($_SESSION['token']) && $_SESSION['token'] === $this->token) {
            return true;
        } 
        return false;
    }

    public function check_login ()
    {  
        if ($this->db->get_data_row('users', 'login', $this->login)) {
            return false;
        } 
        return true;
    }    

    public function check_password ()
    {  
        if (password_verify($this->password, $this->db->get_data_row('users', 'login', $this->login)['password'])) {
            return true;
        } 
        return false;           
    } 

}
