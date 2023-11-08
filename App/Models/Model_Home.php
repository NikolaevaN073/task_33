<?php

namespace App\Models;

use App\Core\Model;
use App\Core\DataBase;

class Model_Home extends Model 
{
    protected $db;
    public $data = [];  
    

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }
   
    public function get_data ()
    {
        $query = "SELECT * FROM users 
        JOIN contacts ON users.id = contacts.contact_user_id
        WHERE contacts.user_id = ?";

        return $this->db->get_data_fields($query, $_COOKIE['user_id']);
    }

    public function get_contact ($search)
    {
        $query = "SELECT * FROM users WHERE login = ? OR nickname = ?";
        $user_data = $this->db->get_data_field($query, [$search, $search]);

        if ($user_data) {
            $contact = "SELECT * FROM contacts WHERE user_id = ? AND contact_user_id =?";
            $result = $this->db->get_data_field($contact, [$_COOKIE['user_id'], $user_data['id']]);

            if (!$result) {
                $this->db->insert('contacts', [
                    'user_id' => $_COOKIE['user_id'],
                    'contact_user_id' => $user_data['id']
                ]);
                return $user_data; 
            } else {
                return $data['error'] = 'Пользователь уже в списке контактов';
            }
        
        } else {
            return $data['error'] = 'Пользователь не найден';
        }   
    }
}