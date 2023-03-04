<?php namespace App\Models;

use CodeIgniter\Model;

class UservoteModel extends Model
{
    function getVoteStart()
    {
        $query = "SELECT * FROM master_vote where master_vote_id = 1";
       
        $result = $this->db->query($query);
        
        return $result->getFirstRow('array');           
    }

    function getUserVote($identityCode)
    {
        $query = "SELECT * FROM master_users_vote where identity_code = ?";
       
        $result = $this->db->query($query, [$identityCode]);
        
        return $result->getFirstRow('array');           
    }
	
    function getPhonenumber($phoneNumber)
    {
        $query = "SELECT * FROM master_users_vote where phone_number = ? AND isPresent=1";
       
        $result = $this->db->query($query, [$phoneNumber]);
        
        return $result->getFirstRow('array');           
    }

    function getPesertaHadir($nik)
    {
        $query = "SELECT * FROM master_users_vote where identity_code = ? AND isPresent=1";
       
        $result = $this->db->query($query, [$nik]);
        
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

    function getDataPeserta()
    {
        $query = "SELECT a.*, b.kode_kehadiran 
                    FROM master_users_vote a
                    LEFT JOIN transaction_kode_kehadiran b 
                        ON a.identity_code= b.identity_code
                        ORDER BY isPresent DESC";
       
        $result = $this->db->query($query);
        
        return $result->getResultArray();           
    }

    function getListKodeKehadiran()
    {
        $query = "SELECT * FROM transaction_kode_kehadiran";
       
        $result = $this->db->query($query);
        
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
	
    function cekKodeKehadiran($kodeKehadiran)
    {
        $query = "SELECT * FROM transaction_kode_kehadiran where kode_kehadiran = ?";

        $result = $this->db->query($query, [$kodeKehadiran]);
        
        return $result->getFirstRow('array');           
    }

    function getKodeKehadiran($kodeKehadiran)
    {
        $query = "SELECT * FROM transaction_kode_kehadiran WHERE identity_code IS NULL AND kode_kehadiran = ?";

        $result = $this->db->query($query, [$kodeKehadiran]);
        
        return $result->getFirstRow('array');           
    }

    function getKodeKehadiran2($kodeKehadiran)
    {
        $query = "SELECT * FROM transaction_kode_kehadiran WHERE identity_code IS NOT NULL AND kode_kehadiran = ?";

        $result = $this->db->query($query, [$kodeKehadiran]);
        
        return $result->getFirstRow('array');           
    }
	
    function updateKodeKehadiran($data)
    {
	$this->db->transBegin();

        $this->db->table('transaction_kode_kehadiran')->where('kode_kehadiran', $data['kode_kehadiran'])->update($data);
        
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
