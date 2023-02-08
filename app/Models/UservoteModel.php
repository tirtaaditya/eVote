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
	
    function getUserPresentAndKuasa($identityCode)
    {
        $query = "SELECT 
			identity_code, 
			'Hadir' AS isPresent 
		   FROM `master_users_vote` 
		   	WHERE isPresent=1
		   	  AND identity_code='".$identityCode."'
		   UNION
		   SELECT 
			a.identity_code_kuasa, 
			CONCAT('dikuasakan ', a.identity_code, ' ', b.name) AS isPresent 
		   FROM `transaction_users_kuasa` a 
			LEFT JOIN master_users_vote b ON a.identity_code_kuasa=b.identity_code
			WHERE identity_code_kuasa='".$identityCode."'
		 ";
       
        $result = $this->db->query($query, [$identityCode]);
        
        return $result->getFirstRow('array');           
    }

    function getUserValidateOTP($nik, $otp)
    {
        $query = "SELECT * FROM master_users_vote where otp = ? and identity_code = ?";
       
        $result = $this->db->query($query, [$otp, $nik]);

        return $result->getFirstRow('array');           
    }

    function getUserValidateVote($nik)
    {
        $query = "SELECT * FROM transaction_voting where identity_code = ?";
       
        $result = $this->db->query($query, [$nik]);

        return $result->getFirstRow('array');           
    }

    function getDataKuasa($id)
    {
        $query = "SELECT * FROM `transaction_users_kuasa` WHERE identity_code=?";
       
        $result = $this->db->query($query, [$id]);
        
        return $result->getResultArray();           
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

    function saveUserVote($data)
    {
		$this->db->transBegin();

        $this->db->table('transaction_voting')->insertbatch($data);;
        
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
	
    function getKodeKehadiran($kodeKehadiran)
    {
        $query = "SELECT * FROM transaction_kode_kehadiran where kode_kehadiran = ?";
       
        $result = $this->db->query($query, [$identityCode]);
        
        return $result->getFirstRow('array');           
    }
	
}
