<?php namespace App\Models;

use CodeIgniter\Model;

class SubmitFormModel extends Model
{
	function insertForm($data, $kuasa)
	{
		$this->db->transBegin();

		if(!empty($kuasa))
		{
		    $this->db->table('transaction_users_kuasa')->insertBatch($kuasa);
		}

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
