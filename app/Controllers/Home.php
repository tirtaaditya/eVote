<?php namespace App\Controllers;

use App\Controllers\BaseController;

use App\Helpers\AuditHelper;

use App\Models\AuditModel;

class Home extends BaseController
{
	public function __construct()
    {
        $this->auditModels = new AuditModel();

		$this->auditHelper = new AuditHelper();
    }

	public function index()
	{
        if($this->checkSession())
        {
        	return redirect()->to(base_url().'/main/logout');
        }

		$data = [];

		try
		{
			$activity = $this->auditModels->getListAuditActivity($this->session->user['security_users_id']);

			$data['activity'] = $activity;	
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $this->session->user['security_users_id']);
        }

		$masterpage_data['title'] = 'Beranda';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('HomeView', $data);

		return view('MasterPageView', $masterpage_data);
	}

}
