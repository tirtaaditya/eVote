<?php namespace App\Models;

use CodeIgniter\Model;

class WhatsappModel extends Model
{
    function insertLogWA($insertData)
    {
        $this->db->transBegin();

        $this->db->table('log_whatsapp')->insert($insertData);

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