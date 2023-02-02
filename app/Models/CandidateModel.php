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
    
    function getHasilVote()
    {
        $query = "SELECT a.name, a.master_candidate_vote_id, COUNT(b.transaction_voting_id) AS total_suara FROM master_candidate_vote a LEFT JOIN transaction_voting b ON a.master_candidate_vote_id=b.master_candidate_vote_id GROUP BY a.name, a.master_candidate_vote_id";
       
        $result = $this->db->query($query);
        
        return $result->getResultArray();        
    }


}
