<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\DataTables;

class ModelPaslon extends Model
{
    protected $table = 'master_candidate_vote';

    function list($identityCode)
    {
        // sql query
        $query = "
        SELECT *
        FROM master_candidate_vote       
        WHERE master_candidate_vote_id = ?
        ";

        $result = $this->db->query($query, [$identityCode])->getFirstRow('array');

        return $result; 
    }

    function insertPaslon($data)
	{
        $this->db = \Config\Database::connect();
        // echo json_encode($data);die;
		$this->db->transBegin();

        $this->db->table('master_candidate_vote')->insert($data);
        
        if ($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            return FALSE;
        }
        else
        {
            $this->db->transCommit();
            return TRUE;
        } 
	}
    
    function updatePaslon($data, $id)
	{
        $this->db = \Config\Database::connect();
        // echo json_encode($data);die;
		$this->db->transBegin();

        $this->db->table('master_candidate_vote')->where('master_candidate_vote_id', $id)->update($data);
        
        if ($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            return FALSE;
        }
        else
        {
            $this->db->transCommit();
            return TRUE;
        } 
	}
    
    function deletePaslon($id)
    {
        $this->db = \Config\Database::connect();
        // echo json_encode($data);die;
		$this->db->transBegin();

        $this->db->table('master_candidate_vote')->where('master_candidate_vote_id', $id)->delete();
        
        if ($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            return FALSE;
        }
        else
        {
            $this->db->transCommit();
            return TRUE;
        } 
    }
	
    function getMasterVote()
    {
        $date = date('Y-m-d');
        $query = "
        SELECT *
        FROM master_vote
        WHERE start_date >= $date
        ";

        $result = $this->db->query($query,[$date]);
        
        return $result->getResultArray();  
    }

    function reset()
    {
        $this->db = \Config\Database::connect();
        // echo json_encode($data);die;
		$this->db->transBegin();

        $this->db->table('audit_error_system')->truncate();
        $this->db->table('audit_activity')->truncate();
        $this->db->table('log_whatsapp')->truncate();
        $this->db->table('transaction_users_kuasa')->truncate();
        $this->db->table('transaction_voting')->truncate();

        $updateMasterUser['isPresent'] = 0;
        $updateMasterUser['otp'] = NULL;
        $updateMasterUser['phone_number'] = NULL;
        $updateMasterUser['signature'] = NULL;

        $this->db->table('master_users_vote')->update($updateMasterUser);
        
        if ($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
            return FALSE;
        }
        else
        {
            $this->db->transCommit();
            return TRUE;
        } 
    }
	
}
