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
