<?php

namespace App\Helpers;

use App\Models\AuditModel;

class AuditHelper
{
	function __construct()
    {
        $this->auditModel = new AuditModel();
    }

	function writeAuditActivity($activity, $module, $userId)
	{
		$data['activity'] = $activity;
		$data['module'] = $module;
		$data['security_users_id'] = $userId;

		$this->auditModel->insertAuditActivity($data);
	}

	function getListAuditActivity($userId)
    {
        $query = "SELECT * FROM audit_activity
                    WHERE security_users_id = ?
                    ORDER BY created_on DESC Limit 10";

        $result = $this->db->query($query, $userId);

        return $result->getResultArray();
    }

	function writeAuditErrorSystem($class, $e, $userId)
	{
		$systemData['class_name'] = $class;
		$systemData['security_users_id'] = $userId;

		if(!empty($e))
		{
			$systemData['message'] = $e->getMessage();
			$systemData['description'] = json_encode($e->getTrace());
		}

		$this->auditModel->insertAuditErrorSystem($systemData);
	}
}