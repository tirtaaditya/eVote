<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\AuditHelper;
use App\Helpers\WhatsappHelper;

use App\Models\AuthModel;
use App\Models\AuditModel;
use App\Models\UservoteModel;
use App\Models\CandidateModel;

class Main extends BaseController
{
	public function __construct()
    {
        $this->models = new AuthModel();
		$this->auditModels = new AuditModel();
		$this->uservoteModels = new UservoteModel();
		$this->candidateModels = new CandidateModel();
		$this->whatsappHelper = new WhatsappHelper();
 
		$this->auditHelper = new AuditHelper();		
    }

	//STEP 1
	public function index()
	{
		$data['submitFormUrl'] = base_url()."/submitform";
		$data['sendOTPUrl'] = base_url()."/main/sendOTP";
		$data['validateAbsenUrl'] = base_url()."/main/validateAbsen";

		return view('AbsenCreateView', $data);		
	}
	
	public function sendOTP()
	{
		$errorMessage = "";
		$successMessage = "";

		try
		{
			$postData = $this->request->getPost();

			$nomorWhatsapp = $postData['nomorWhatsapp'];
	       	$nik = $postData['nik'];
			$otp = rand(100000, 999999);
			$message = $otp." adalah kode OTP anda untuk Form Absensi";
			
			$userVote = $this->uservoteModels->getUserVote($nik);
			
			if(empty($userVote))
			{
				$errorMessage = "NIK salah/tidak ditemukan";
			}
			else
			{
				$this->whatsappHelper->sendWhatsapp('OTP', $nomorWhatsapp, $message);

				$otpUpdate['identity_code'] = $nik;
				$otpUpdate['otp'] = $otp;
				$otpUpdate['phone_number'] = $nomorWhatsapp;
				$updateUserOTP = $this->uservoteModels->updateUserVote($otpUpdate);
				
				if(!$updateUserOTP)
				{
					$errorMessage = "Gagal Sinkronisasi OTP dengan Sistem";
				}
				else
				{
					$successMessage = 'OTP Berhasil Dikirim';
				}
			}
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, 0);
        }

		$response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage == '' ? $successMessage : $errorMessage;

		return json_encode($response);
	}

	public function validateAbsen()
	{
		$errorMessage = "";
		$successMessage = "";

		try
		{
			$postData = $this->request->getPost();

			$nik = $postData['nik'];
			$otp = $postData['otp'];
			
			$userValidate = $this->uservoteModels->getUserValidateOTP($nik, $otp);

			if(empty($userValidate))
			{
				$errorMessage = "OTP Tidak Sesuai";
			}
			else
			{
				$successMessage = "OTP Sesuai";

				$session['nik'] = $nik;
				$session['name'] = $userValidate['name'];
				$session['phoneNumber'] = $userValidate['phone_number'];
				$this->session->set('user', $session);
			}
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, 0);
        }

		$response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage == '' ? $successMessage : $errorMessage;

		return json_encode($response);
	}
	//END STEP 1

	//STEP 2
	public function submitForm()
	{
		// if(empty($this->session->user))
		// {
		// 	return redirect()->to(base_url());	
		// }

		$data['sendOTPUrl'] = base_url()."/main/sendOTP";
		$data['dataSession'] = $this->session->user;
		$data['postbackURL'] = base_url()."/submit";
		return view('SubmitForm', $data);	
	}

	public function submit()
	{
		$files = $this->request->getFiles();
		print_r($files);die;
		// if(empty($this->session->user))
		// {
		// 	return redirect()->to(base_url());	
		// }

		// $config['upload_path']="./assets/images"; //path folder file upload
        // $config['allowed_types']='gif|jpg|png'; //type file yang boleh di upload
        // $config['encrypt_name'] = TRUE; //enkripsi file name upload
		$postData = $this->request->getPost();
		// echo json_encode($postData);die;
		$this->load->library('upload',$config);
        if($this->upload->do_upload("document")){
			echo "disini";
			die;
            $data = array('upload_data' => $this->upload->data());
 
            $judul= $this->input->post('judul');
            $image= $data['upload_data']['file_name']; 
             
            $result= $this->m_upload->simpan_upload($judul,$image);
            echo json_decode($result);die;
        }
		echo "disana";die;
		// echo json_encode($postData);die;
		// echo json_encode($postData);die;
		// $this->input->post('signed');
		// $this->input->post('nik');
		// $this->input->post('name');
		// $this->input->post('phoneNumber');

		$folderPath = "img-upload/";
	
		$image_parts = explode(";base64,", $postData['signed']);
		print_r($image_parts);die;
		// $image_type_aux = explode("image/", $image_parts[0]);
		
		// $image_type = $image_type_aux[1];
		
		// $image_base64 = base64_decode($image_parts[1]);
		
		// $file = $folderPath . uniqid() . '.'.$image_type;
		
		// file_put_contents($file, $image_base64);
		// echo "<h3><i>Upload Tanda Tangan Berhasil..</i><h3>";
	}
	//END STEP 2

	//STEP 3
	public function vote($key)
	{
		$nik = base64_decode($key);

		$userVote = $this->uservoteModels->getUserVote($nik);

		$session['nik'] = $userVote['identity_code'];
		$session['name'] = $userVote['name'];
		$session['phoneNumber'] = $userVote['phone_number'];
		$session['role'] = 'Voters';
		$this->session->set('user', $session);

		$candidate = $this->candidateModels->getCandidate(1);

		$data = [];

		$data['candidate'] = $candidate;

		$masterpage_data['title'] = 'Beranda';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('HomeView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}
	//END STEP 3


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
