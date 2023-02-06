<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\AuditHelper;
use App\Helpers\WhatsappHelper;

use App\Models\AuthModel;
use App\Models\AuditModel;
use App\Models\UservoteModel;
use App\Models\CandidateModel;
use App\Models\SubmitFormModel;
use App\Models\ModelPaslon;
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
		$this->modelPaslon = new ModelPaslon();
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
			$errorMessage = (empty($userVotePresent)) ? "" : "Anda telah ".$userVotePresent['isPresent'];
			
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
			
			$userVote = $this->uservoteModels->getUserVote($nik);
			$userVotePresent = $this->uservoteModels->getUserPresentAndKuasa($nik);
			
			$errorMessage = (empty($userVote)) ? "NIK salah/tidak ditemukan" : "";
			$errorMessage = (empty($userVotePresent)) ? "" : "Anda telah ".$userVotePresent['isPresent'];
			
			if(empty($errorMessage))
			{
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
			if(empty($postData['signed']) || empty($postData['kuasa']))
			{
				$this->session->set('errorMessage', "Input Semua Field");
				$this->session->markAsFlashdata('errorMessage');
	
				return redirect()->to(base_url()."/submitform");
			}

			if($postData['kuasa'] == "Ya" && empty($postData['pemberiKuasa']))
			{
				$this->session->set('errorMessage', "Input Semua Field");
				$this->session->markAsFlashdata('errorMessage');
	
				return redirect()->to(base_url()."/submitform");
			}

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
			
			$logWa = $this->whatsappHelper->sendWhatsapp('Send URL Vote', $nomorWhatsapp, $message);
			/*	
			if($logWa)
			{
			*/
				$this->session->set('successMessage', "Data Berhaasil Di Submit Silahkan Cek Whatsapp anda !");
				$this->session->markAsFlashdata('successMessage');
				
				$this->session->destroy();
				return redirect()->to(base_url());
			/*
			}
			else
			{
				$this->session->set('errorMessage', "Submit Gagal Di Proses Silahkan Coba Lagi");
				$this->session->markAsFlashdata('errorMessage');
	
				chmod($folderPath, 0777);
				unlink($file);
				return redirect()->to(base_url()."/submitform");
			}
			*/
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

		$setVote = $this->candidateModels->getVoteStart();

		$candidate = $this->candidateModels->getCandidate(1);

		$data = [];

		$data['candidate'] = $candidate;
		$data['startVote'] = $setVote['start_date'];
		$data['endVote'] = $setVote['end_date'];
		$data['processVoteUrl'] = base_url()."/main/processVote";

		$masterpage_data['title'] = 'Beranda';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('HomeView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}

	public function processVote()
	{
		$errorMessage = "";
		$successMessage = "";
		$dataVote = [];

		try
		{
			$postData = $this->request->getPost();

			$idCalon = $postData['idCalon'];
			$nik = $this->session->user['nik'];
			
			$validateUserNotVote = $this->uservoteModels->getUserValidateVote($nik);

			if(!empty($validateUserNotVote))
			{
				$errorMessage = "NIK sudah melakukan voting"; 
			}

			if(empty($errorMessage))
			{
				$dataSession['master_candidate_vote_id'] = $idCalon;
				$dataSession['identity_code'] = $nik;
				array_push($dataVote, $dataSession);

				$getKuasa = $this->uservoteModels->getDataKuasa($nik);

				if(!empty($getKuasa))
				{
					foreach ($getKuasa as $key => $value) {
							
						$listkuasa['master_candidate_vote_id'] = $idCalon; 
						$listkuasa['identity_code'] = $value['identity_code_kuasa']; 
		
						array_push($dataVote, $listkuasa);
					}
				}

				$processVoting = $this->uservoteModels->saveUserVote($dataVote);
				
				if(!$processVoting)
				{
					$errorMessage = "Gagal Melakukan Sync Voting";
				}
				else
				{
					$successMessage = 'Voting Berhasil';
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

	public function hasil()
	{
		$data = [];
		$dataCalon = [];
		$dataHasil = [];
		$userVote = $this->uservoteModels->getUserVote($this->session->user['nik']);

		$hasilVote = $this->candidateModels->getHasilVote();
		foreach ($hasilVote as $key => $value) 
		{			
			array_push($dataCalon, $value['name']);
			array_push($dataHasil, $value['total_suara']);
		}

		$data['dataCalon'] = $dataCalon;
		$data['dataHasil'] = $dataHasil;		

		$masterpage_data['title'] = 'Hasil Pemilihan';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('HasilView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}

	public function daftar()
	{
		$pager = \Config\Services::pager();
        $model = new ModelPaslon();
        $data['paslon'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['page'] = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

		$masterpage_data['title'] = 'List Paslon';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('PaslonView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}

	public function getPaslon()
	{
		$errorMessage = "";
		$successMessage = "";

		try {
			helper(['form', 'url']);
			$postData = $this->request->getPost();			
			if($postData['action'] == "Create")
			{
				$imageFile = $this->request->getFile('file');

				$process = $this->insertPaslon($imageFile, $postData);
				if($process)
				{
					$successMessage = "Data Berhasil Di Simpan";
				}
			}
			else
			{
				if(empty($postData['upload']))
				{
					$imageFile = $this->request->getFile('file');
					$process = $this->editPaslon($imageFile, $postData);
				}
				else
				{
					$imageFile = "";
					$process = $this->editPaslon($imageFile, $postData);
				}
				
				if($process)
				{
					$successMessage = "Data Berhasil Di Edit";
				}
			}
			
		} catch (\Exception $e) {
			$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, 0);
		}

		$response['code'] = $errorMessage == '' ? '00' : '04';
		$response['message'] = $errorMessage == '' ? $successMessage : $errorMessage;

		return json_encode($response);
	}

	public function insertPaslon($imageFile, $postData)
	{
		$pathDestination = "assets/media/candidate/";

		if(!is_dir($pathDestination))
		{
			if(mkdir($pathDestination, 0777, TRUE))
			{
				chmod($pathDestination, 0777);
			}
			else
			{
				throw new \Exception("Error while create directory!", 1);
			}
		}
		else
		{
			chmod($pathDestination, 0777);
		}
		$imageFile->move($pathDestination);

		$fullPathDestination = $pathDestination.'/'.$imageFile->getClientName();

		$data = [
			'picture' => $pathDestination.'/'.$imageFile->getClientName(),
			'name' => $postData['name'],
			'description' => $postData['description'],
			'master_vote_id' => $postData['master_vote'],
		];

		$save = $this->modelPaslon->insertPaslon($data);

		if($save)
		{
			return TRUE;
		}
		else
		{
			throw new \Exception("Error Processing Request", 1);
			
		}
	}

	public function editPaslon($imageFile, $postData)
	{
		if(!empty($imageFile))
		{
			$pathDestination = "assets/media/candidate/";

			if(!is_dir($pathDestination))
			{
				if(mkdir($pathDestination, 0777, TRUE))
				{
					chmod($pathDestination, 0777);
				}
				else
				{
					throw new \Exception("Error while create directory!", 1);
				}
			}
			else
			{
				chmod($pathDestination, 0777);
			}
			
			$imageFile->move($pathDestination);


			$fullPathDestination = $pathDestination.'/'.$imageFile->getClientName();
		}
		else
		{
			$fullPathDestination = $postData['upload'];
		}

		$data = [
			'picture' => $fullPathDestination,
			'name' => $postData['name'],
			'description' => $postData['description'],
			'master_vote_id' => $postData['master_vote'],
		];

		$save = $this->modelPaslon->updatePaslon($data, $postData['id']);

		if($save)
		{
			return TRUE;
		}
		else
		{
			throw new \Exception("Error Processing Request", 1);
			
		}

	}

	public function getData()
	{
		$postData = $this->request->getPost();
		
		$data = $this->modelPaslon->list($postData['id']);

		return json_encode($data);
	}

	public function detailPaslon()
	{
		$data = [];
		$dataCalon = [];
		$dataHasil = [];
		$userVote = $this->uservoteModels->getUserVote($this->session->user['nik']);

		$hasilVote = $this->candidateModels->getHasilVote();
		foreach ($hasilVote as $key => $value) 
		{			
			array_push($dataCalon, $value['name']);
			array_push($dataHasil, $value['total_suara']);
		}

		$data['dataCalon'] = $dataCalon;
		$data['dataHasil'] = $dataHasil;		

		$masterpage_data['title'] = 'Hasil Pemilihan';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('HasilView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}

	// public function procesDaftar()
	// {
	// 	helper(['form', 'url']);

	// 	$postData = $this->request->getPost();
         
    //     $validateImage = $this->validate([
    //         'file' => [
    //             'uploaded[file]',
    //             'mime_in[file, image/png, image/jpg,image/jpeg, image/gif]',
    //             'max_size[file, 4096]',
    //         ],
	// 		'name' => ['required'],
	// 		'master_vote_id' => ['required']
    //     ]);
    
    //     $response = [
    //         'success' => false,
    //         'data' => '',
    //         'msg' => "Image could not upload"
    //     ];
    //     if ($validateImage) {
    //         $imageFile = $this->request->getFile('file');
    //         $imageFile->move(WRITEPATH . 'uploads');
    //         $data = [
    //             'img_name' => $imageFile->getClientName(),
    //             'file'  => $imageFile->getClientMimeType(),
	// 			'name' => $
    //         ];
    //         // $save = $builder->insert($data);
    //         $response = [
    //             'success' => true,
    //             'data' => $save,
    //             'msg' => "Image successfully uploaded"
    //         ];
    //     }
    //     return $this->response->setJSON($response);
	// }
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
			$dataActivity = $this->auditModels->getListAuditActivity($this->session->user['nik']);			
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $this->session->user['nik']);
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
			$this->auditHelper->writeAuditActivity("Logout", "Logout", $this->session->user['nik']);
			$this->session->destroy();	
		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, $this->session->user['nik']);
        }

		return redirect()->to(base_url().'/main');
	}
}
