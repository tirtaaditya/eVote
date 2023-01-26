<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\AuditHelper;

use App\Models\AuthModel;
use App\Models\AuditModel;
use App\Models\UservoteModel;

class Main extends BaseController
{
	public function __construct()
    {
        $this->models = new AuthModel();
		$this->auditModels = new AuditModel();
		$this->uservoteModels = new UservoteModel();
 
		$this->auditHelper = new AuditHelper();		
    }

	public function index()
	{
		$data['sendOTPUrl'] = base_url()."/main/sendOTP";

		return view('AbsenCreateView', $data);		
	}
	
	public function sendOTP()
	{
		$errorMessage = "";
		$$successMessage = "";

		try
		{
			$postData = $this->request->getPost();

			$nomorWhatsapp = $postData['nomorWhatsapp'];
	       	$nik = $postData['nik'];
			$otp = rand(100000, 999999);
			
			$userVote = $this->uservoteModels->getUserVote($nik);
			if(empty($userVote))
			{
				$errorMessage = "NIK Tidak Ditemukan";
			}

			$successMessage = 'OTP Berhasil Dikirim';
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			echo $errorMessage;die();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $this->session->user['security_users_id']);
        }

		$response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage == '' ? $successMessage : $errorMessage;

		return json_encode($response);
	}

	public function admin()
	{
		if($this->session->has('user'))
		{
			return redirect()->to(base_url().'/home');
		}
		else
		{
			$data['postback_url'] = base_url()."/main/login";

			return view('LoginView', $data);
		}
	}

	public function login()
	{
		$response = [];
		$dataUser = [];
		$errorMessage = "";

		try
		{
			$postData = $this->request->getPost();

			$id = $postData['email'];
	       	$password = sha1($postData['password']);

			$dataUser = $this->models->getUsers($id, $password);
			
			if(!isset($dataUser))
			{
				$errorMessage = "Email dan Password tidak ditemukan";
			}
			else
			{
				$this->session->set('user', $dataUser);
				$this->auditHelper->writeAuditActivity("Login", "Login", $this->session->user['security_users_id']);
			}

		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $this->session->user['security_users_id']);
        }

		$response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage;
        $response['data'] = $dataUser;

		return json_encode($response);
	}

	public function activity()
	{
		$response = [];
		$dataActivity = [];
		$errorMessage = "";

		try
		{
			$dataActivity = $this->auditModels->getListAuditActivity($this->session->user['security_users_id']);			
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $this->session->user['security_users_id']);
        }

		$response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage;
        $response['data'] = $dataActivity;

		return json_encode($response);
	}

	public function logout()
	{
		try
		{
			$this->auditHelper->writeAuditActivity("Logout", "Logout", $this->session->user['security_users_id']);
			$this->session->destroy();	
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $this->session->user['security_users_id']);
        }

		return redirect()->to(base_url().'/main');
	}
}
