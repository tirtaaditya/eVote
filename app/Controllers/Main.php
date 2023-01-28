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
		$postData = $this->request->getPost();

		$folderPath = "assets/media/signature";
	
		$image_parts = explode(";base64,", $postData['signed']);
		$image_type_aux = explode("image/", $image_parts[0]);
		
		$image_type = $image_type_aux[1];
		
		$image_base64 = base64_decode($image_parts[1]);
		
		$file = $folderPath . uniqid() . '.'.$image_type;

		$fix = file_put_contents($file, $image_base64);
		if(!$fix)
		{
			echo "error";
			die;
		}
		// $pemberiKuasa = $postData['pemberiKuasa'];
		$pemberiKuasa = '002122,002123,002123,002122';
		if(!empty($pemberiKuasa))
		{
			$pemberiKuasaNik = explode(",", $pemberiKuasa );
			$pemberiKuasaNik =	array_unique($pemberiKuasaNik);

			foreach ($pemberiKuasaNik as $key => $value) {
				
				if(strlen($value) > 6 || strlen($value) < 6)
				{
					echo "error";
					die;
				}
			}
		}

		$data = array(
			'nik' => $postData['nik'],
			'phoneNumber' => $postData['phoneNumber'],
			'nama' => $postData['nama'],
			'nik' => $postData['nik'],
			'kuasa' => $postData['kuasa'],
			'pemberiKuasa' => $pemberiKuasa ?? "",
			'signature' => $file,
		);

		$save = $this->$this->submitFormModel->insertForm($data);

		if(!$save)
		{
			echo "error";
			die;
		}
		
		$nik = $postData['nik'];
		$paths = 'coba/'.base64_encode($nik);
		$link = base_url($paths);
		$message = "Silahkan Klik Link Berikut : ". $link;
		$nomorWhatsapp = "089643666840";
		
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

		$logWhatsapp['module'] = 'OTP';
		$logWhatsapp['phone_number'] = $nomorWhatsapp;
		$logWhatsapp['message'] = $message;
		$logWhatsapp['response'] = $result;
		
		$this->whatsappModels->insertLogWA($logWhatsapp);

		echo "disitu";die;
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
