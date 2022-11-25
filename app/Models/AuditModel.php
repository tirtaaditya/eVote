<?php namespace App\Models;

use CodeIgniter\Model;

class AuditModel extends Model
{
    function getListAuditActivity($id)
    {
        $query = "SELECT * FROM audit_activity where security_users_id = ? ORDER BY created_on DESC LIMIT 10";
       
        $result = $this->db->query($query, $id);
        
        return $result->getResultArray();      
    }

	function insertAuditActivity($data)
	{
		$this->db->transBegin();

        $this->db->table('audit_activity')->insert($data);
        
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

	function insertAuditErrorSystem($data)
	{
		$this->db->transBegin();

        $this->db->table('audit_error_system')->insert($data);
        
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