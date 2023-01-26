<?php namespace App\Models;

use CodeIgniter\Model;

class UservoteModel extends Model
{
    function getUserVote($identityCode)
    {

        $query = "SELECT * FROM master_users_vote where identity_code = ?";
       
        $result = $this->db->query($query, [$identityCode]);
        
        return $result->getFirstRow('array');           
    }
}