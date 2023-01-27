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

    function getUserValidateOTP($nik, $otp)
    {
        $query = "SELECT * FROM master_users_vote where otp = ? and identity_code = ?";
       
        $result = $this->db->query($query, [$otp, $nik]);

        return $result->getFirstRow('array');           
    }


    function updateUserVote($data)
	{
		$this->db->transBegin();

        $this->db->table('master_users_vote')->where('identity_code', $data['identity_code'])->update($data);;
        
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