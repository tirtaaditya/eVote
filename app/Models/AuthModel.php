<?php namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    function getUsers($id, $password)
    {
        $query = "SELECT * FROM security_users where security_users_id = ? AND password = ?";
       
        $result = $this->db->query($query, [$id, $password]);
        
        return $result->getFirstRow('array');           
    }
}