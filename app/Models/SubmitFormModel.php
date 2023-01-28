<?php namespace App\Models;

use CodeIgniter\Model;

class SubmitFormModel extends Model
{
	function insertForm($data)
	{
		$this->db->transBegin();

        $this->db->table('master_users_vote')->insert($data);
        
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