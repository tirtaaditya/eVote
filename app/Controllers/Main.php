<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\AuditHelper;
use App\Helpers\WhatsappHelper;

use App\Models\AuthModel;
use App\Models\AuditModel;
use App\Models\UservoteModel;
use App\Models\CandidateModel;
use App\Models\SubmitFormModel;
use App\Models\WhatsappModel;

class Main extends BaseController
{
	public function __construct()
    {
        $this->models = new AuthModel();
		$this->auditModels = new AuditModel();
		$this->uservoteModels = new UservoteModel();
		$this->candidateModels = new CandidateModel();
		$this->submitFormModel = new SubmitFormModel();
		$this->whatsappModels = new WhatsappModel();
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
			$userVotePresent = $this->uservoteModels->getUserPresentAndKuasa($nik);
			
			$errorMessage = (empty($userVote)) ? "NIK salah/tidak ditemukan" : "";
			$errorMessage = (empty($userVotePresent)) ? "" : "Anda telah "+$userVotePresent['isPresent'];
			
			if(empty($errorMessage))
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

	public function submitForm()
	{
		if(empty($this->session->user))
		{
			$this->session->set('errorMessage', "Kamu Belum Login, Silahkan Login Terlebih Dahulu");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		$data['sendOTPUrl'] = base_url()."/main/sendOTP";
		$data['dataSession'] = $this->session->user;
		$data['postbackURL'] = base_url()."/submit";
		return view('SubmitForm', $data);	
	}

	public function submit()
	{
		try {
			$postData = $this->request->getPost();

			$folderPath = "assets/media/signature/";
		
			$image_parts = explode(";base64,", $postData['signed']);
			$image_type_aux = explode("image/", $image_parts[0]);
			
			$image_type = $image_type_aux[1];
			
			$image_base64 = base64_decode($image_parts[1]);
			
			$file = $folderPath . uniqid() . '.'.$image_type;
	
			$fix = file_put_contents($file, $image_base64);
	
			if(!$fix)
			{
				$this->session->set('errorMessage', "Gagal Memproses Signature");
				$this->session->markAsFlashdata('errorMessage');
	
				return redirect()->to(base_url()."/submitform");
			}
	
			$pemberiKuasa = $postData['pemberiKuasa'];
			$kuasa = array();
	
			if(!empty($pemberiKuasa))
			{
				$pemberiKuasaNik = explode(",", $pemberiKuasa );
				$pemberiKuasaNik =	array_unique($pemberiKuasaNik);
	
				foreach ($pemberiKuasaNik as $key => $value) {
					
					if($value == $postData['nik'] || strlen($value) > 6 || strlen($value) < 6)
					{
						$this->session->set('errorMessage', "NIK Pemberi Kuasa Harus 6 Karakter dan Berbeda Dengan NIK Pemegang Kuasa");
						$this->session->markAsFlashdata('errorMessage');
	
						chmod($folderPath, 0777);
						unlink($file);
						return redirect()->to(base_url()."/submitform");
					}
	
					$listkuasa['identity_code'] = $postData['nik']; 
					$listkuasa['identity_code_kuasa'] = $value; 
	
					array_push($kuasa, $listkuasa);
				}
			}
	
			$dataMaster = array(
				'identity_code' => $postData['nik'],
				'phone_number' => $postData['phoneNumber'],
				'name' => $postData['nama'],
				'signature' => $file,
				'isPresent' => 1
			);	
	
			$save = $this->submitFormModel->insertForm($dataMaster, $kuasa);
	
			if(!$save)
			{
				$this->session->set('errorMessage', "Gagal Save Data Silahkan Ulang Kembali");
				$this->session->markAsFlashdata('errorMessage');
	
				chmod($folderPath, 0777);
				unlink($file);
				return redirect()->to(base_url()."/submitform");
			}
			
			$nik = $postData['nik'];
			$paths = 'vote/'.base64_encode($nik);
			$link = base_url($paths);
			$message = "Silahkan Klik Link Berikut untuk melakukan Vote: ".$link;
			$nomorWhatsapp = $postData['phoneNumber'];
			
			$urlWa =  "https://api.kirimwa.id/v1/messages";
			$dataWa = array("phone_number" => $nomorWhatsapp, "message" => $message, "device_id" => "samsungmod", "message_type" => "text");
			$options = array(
			'http' => array(
				'method'  => 'POST',
				'content' => json_encode( $dataWa ),
				'header'=>  "Content-Type: application/json\r\n" .
							"Accept: application/json\r\n" .
					"Authorization: Bearer qtkl44hm/c2FdwgDzxBDKx5NYbs+GUgkVdr55Hd6UJwIJIANexmUTSBByiugRMAg-tirta\r\n"
				)
			);
			$context  = stream_context_create( $options );
			$result = file_get_contents( $urlWa, false, $context );
	
			$logWhatsapp['module'] = 'OTP';
			$logWhatsapp['phone_number'] = $nomorWhatsapp;
			$logWhatsapp['message'] = $message;
			$logWhatsapp['response'] = $result;
			
			$logWa = $this->whatsappModels->insertLogWA($logWhatsapp);
	
			if($logWa)
			{
				$this->session->set('successMessage', "Data Berhaasil Di Submit Silahkan Cek Whatsapp anda !");
				$this->session->markAsFlashdata('successMessage');
				
				$this->session->destroy();
				return redirect()->to(base_url());
			}
			else
			{
				$this->session->set('errorMessage', "Submit Gagal Di Proses Silahkan Coba Lagi");
				$this->session->markAsFlashdata('errorMessage');
	
				chmod($folderPath, 0777);
				unlink($file);
				return redirect()->to(base_url()."/submitform");
			}
		} catch (\Exception $e) {
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $postData['nik']);

			return redirect()->to(base_url()."/submitform");
		}
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
