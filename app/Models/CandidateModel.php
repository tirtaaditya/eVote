<?php namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    function getCandidate($id)
    {
        $query = "SELECT * FROM `master_candidate_vote` WHERE master_vote_id=?";
       
        $result = $this->db->query($query, [$id]);
        
        return $result->getResultArray();           
    }

    function getVoteStart()
    {
        $query = "SELECT * FROM `master_vote`";
       
        $result = $this->db->query($query);
        
        return $result->getFirstRow('array');        
    }

}