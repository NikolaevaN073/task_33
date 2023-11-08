<?php

namespace App\Core;
use App\Core\DataBase;

class User 
{
    protected $db;
    public $id;    
    public $nickname;
    public $login;
    public $password;    
    public $msg = [];

    public function __construct(DataBase $db, $nickname, $login, $password)
    {
        $this->db = $db;        
        $this->nickname = $nickname;
        $this->login = $login;
        $this->password = $password;
    }

    public function check_nickname () 
    {
        return $this->db->get_data_row('users', 'nickname', $this->nickname) ?? false;
    }

    public function check_login () 
    {
        return $this->db->get_data_row('users', 'login', $this->login) ?? false;
    }
    
    public function create ()
    {             
        return $this->db->insert('users', [            
            'nickname'     => $this->nickname,
            'login'    => $this->login,
            'password' => password_hash($this->password, PASSWORD_DEFAULT)  
        ]);   
    }   
}
