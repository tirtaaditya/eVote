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

	public function login()
	{
		if(!empty($this->session->user))
		{
			return redirect()->to(base_url()."/pemilihan/hasil");
		}
		
		return view('LoginView');		
	}

	public function loginAuth()
	{
		$response = [];
		$dataUser = [];
		$errorMessage = "";

		try
		{
			$postData = $this->request->getPost();

			$id = $postData['email'];
	       	$password = $postData['password'];

			if($id == 'admin@evote.com' && $password == 'P@ssw0rd132!?')
			{
				$session['nik'] = '000000';
				$session['name'] = 'Administrator';
				$session['role'] = 'Admin';
				$this->session->set('user', $session); 
			}			
			else
			{
				$errorMessage = "Email dan Password tidak ditemukan";
			}

		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
			$this->auditHelper->writeAuditErrorSystem(get_class(), $e, '0000');
        }

		$response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage;

		return json_encode($response);
	}
	
	public function sendOTP()
	{
		$errorMessage = "";
		$successMessage = "";

		try
		{
			$postData = $this->request->getPost();

			$nomorWhatsapp = $postData['nomorWhatsapp'];
			
			$sub_phoneNumber = substr($nomorWhatsapp,0,4);
			if($sub_phoneNumber == '6208')
			{
				$nomorWhatsapp = "62".substr($nomorWhatsapp,3,1000);
			}				

			$nik = $postData['nik'];
			$otp = rand(100000, 999999);
			$message = $otp." adalah kode OTP anda untuk Form Absensi";
			
			$userVote = $this->uservoteModels->getUserVote($nik);
			$userVotePresent = $this->uservoteModels->getUserPresentAndKuasa($nik);
			$phoneNumberUse = $this->uservoteModels->getPhonenumber($nomorWhatsapp);
			
			$errorMessage = (empty($userVote)) ? "NIK salah/tidak ditemukan" : "";
			$errorMessage = (empty($userVotePresent)) ? "" : "Anda telah ".$userVotePresent['isPresent'];
			$errorMessage = (empty($phoneNumberUse)) ? "" : "Nomor Whatsapp telah digunakan";
			
			if(empty($errorMessage))
			{
				$errorMessage = $this->whatsappHelper->sendWhatsapp('OTP', $nomorWhatsapp, $message);
				
				if(empty($errorMessage))
				{
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
			$phoneNumber = "";

			$nik = $postData['nik'];
			$otp = $postData['otp'];
			$kodeKehadiran = $postData['kodeKehadiran'];
			$userValidate = $this->uservoteModels->getUserValidateOTP($nik, $otp);
			if(!empty($userValidate))
			{
				$phoneNumber = $userValidate['phone_number'];
			}
						
			$sub_phoneNumber = substr($phoneNumber,0,4);
			if($sub_phoneNumber == '6208')
			{
				$phoneNumber = "62".substr($phoneNumber,3,1000);
			}				
			
			$userVote = $this->uservoteModels->getUserVote($nik);
			$userVotePresent = $this->uservoteModels->getUserPresentAndKuasa($nik);
			$getkodeKehadiran = $this->uservoteModels->getKodeKehadiran($kodeKehadiran);
			$phoneNumberUse = $this->uservoteModels->getPhonenumber($phoneNumber);
			
			$errorMessage = (empty($userVote)) ? "NIK salah/tidak ditemukan" : "";
			$errorMessage = (empty($userVotePresent)) ? "" : "Anda telah ".$userVotePresent['isPresent'];
			$errorMessage = (empty($kodeKehadiran)) ? "" : (empty($getkodeKehadiran) ? "Kode kehadiran tidak sesuai" : "");
			$errorMessage = (empty($phoneNumberUse)) ? "" : "Nomor Whatsapp telah digunakan";
			
			if(!empty($getkodeKehadiran))
			{
				$errorMessage = (!empty($getkodeKehadiran['identity_code'])) ? "Kode kehadiran telah digunakan user lain" : "";
			}			
			
			if(empty($errorMessage))
			{
				$userValidate = $this->uservoteModels->getUserValidateOTP($nik, $otp);

				if(empty($userValidate))
				{
					$errorMessage = "OTP Tidak Sesuai";
				}
				else
				{
					if(!empty($kodeKehadiran))
					{
						$dataKehadiran['kode_kehadiran'] = $kodeKehadiran;
						$dataKehadiran['identity_code'] = $nik;
						$dataKehadiran['use_on'] = date("Y-m-d H:i:s");

						$useKodeKehadiran = $this->uservoteModels->updateKodeKehadiran($dataKehadiran);
						
						if(!$useKodeKehadiran)
						{
							$errorMessage = "Gagal menggunakan kode kehadiran";
						}
					}
					
					if(empty($errorMessage))
					{
						$successMessage = "OTP Sesuai";

						$session['nik'] = $nik;
						$session['name'] = $userValidate['name'];
						$session['phoneNumber'] = $userValidate['phone_number'];
						$this->session->set('user', $session);						
					}					
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

			$cekNik = $this->uservoteModels->getUserPresentAndKuasa($postData['nik']);
			if(!empty($cekNik))
			{
				$message = "NIK ".$postData['nik']." Sudah Di Gunakan";
				$this->session->set('errorMessage', $message);
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

			$readyPresent =$this->uservoteModels->getUserPresentAndKuasa($postData['nik']);
			if(!empty($readyPresent))
			{
				$this->session->set('errorMessage', "NIK Kuasa Sudah Di Gunakan");
				$this->session->markAsFlashdata('errorMessage');

				
				unlink($file);
				return redirect()->to(base_url()."/submitform");
			}	
			
			if(!empty($pemberiKuasa))
			{
				$pemberiKuasaNik = explode(",", $pemberiKuasa );
				$pemberiKuasaNik =	array_unique($pemberiKuasaNik);
	
				foreach ($pemberiKuasaNik as $key => $value) {
					
					if($value == $postData['nik'] || strlen($value) > 6 || strlen($value) < 6)
					{
						$this->session->set('errorMessage', "NIK Pemberi Kuasa Harus 6 Karakter dan Berbeda Dengan NIK Pemegang Kuasa");
						$this->session->markAsFlashdata('errorMessage');
	
						
						unlink($file);
						return redirect()->to(base_url()."/submitform");
					}
					
					$cek =$this->uservoteModels->getUserPresentAndKuasa($value);
					if(!empty($cek))
					{
						$message = "NIK ".$value." Kuasa Sudah Di Gunakan";
						$this->session->set('errorMessage', $message);
						$this->session->markAsFlashdata('errorMessage');
	
						
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
	
				
				unlink($file);
				return redirect()->to(base_url()."/submitform");
			}
			
			$userBlackList = array("610208", "600861", "600509", "621076", "623095", "631616", "650416", "651146", "651232", "651240");
			$nik = $postData['nik'];			
			if (in_array($nik, $userBlackList))
			{
				$message = "Anda berhasil absen, Tetapi saat ini Anda tidak dapat melakukan Voting Pengurus dan Bawas. Terima Kasih";				
			}
			else
			{
				$link = 'https://evote.internpos.com/?unicode='.base64_encode($nik);
				$message = "Gunakan link berikut untuk melakukan pemilihan : ".$link." (Balas OK untuk mengaktifkan link vote)";
			}
			$nomorWhatsapp = $postData['phoneNumber'];
			
			$errorMessage = $this->whatsappHelper->sendWhatsapp('Send URL Vote', $nomorWhatsapp, $message);				
			if(empty($errorMessage))
			{
				$this->session->set('successMessage', "Data Berhaasil Di Submit Silahkan Cek Whatsapp anda !");
				$this->session->markAsFlashdata('successMessage');
				
				$this->session->destroy();
				return redirect()->to(base_url('/sukses'));
			}
			else
			{
				$this->session->set('errorMessage', "Submit Gagal Di Proses Silahkan Coba Lagi");
				$this->session->markAsFlashdata('errorMessage');
	
				
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

		$setVote = $this->candidateModels->getVoteStart();

		$candidate = $this->candidateModels->getCandidate(1);
		$candidateBawas = $this->candidateModels->getCandidate(2);

		$data = [];
		$data['candidate'] = $candidate;
		$data['candidateBawas'] = $candidateBawas;

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

			$idPengurus = $postData['pengurusId'];
			$idPengawas = $postData['pengawasId'];
			$nik = $this->session->user['nik'];
			
			$validateUserNotVote = $this->uservoteModels->getUserValidateVote($nik);
			$validatePesertaHadir = $this->uservoteModels->getPesertaHadir($nik);

			$errorMessage = (!empty($validateUserNotVote)) ? "NIK sudah melakukan voting" : "";
			$errorMessage = (empty($validatePesertaHadir)) ? "NIK belum melakukan absen" : "";

			$userBlackList = array("610208", "600861", "600509", "621076", "623095", "631616", "650416", "651146", "651232", "651240");
			if (in_array($nik, $userBlackList))
			{
				$errorMessage = "Anda tidak dapat melakukan voting";				
			}
			

			if(empty($errorMessage))
			{
				$dataSessionPengurus['master_candidate_vote_id'] = $idPengurus;
				$dataSessionPengurus['identity_code'] = $nik;
				array_push($dataVote, $dataSessionPengurus);

				$dataSessionPengawas['master_candidate_vote_id'] = $idPengawas;
				$dataSessionPengawas['identity_code'] = $nik;
				array_push($dataVote, $dataSessionPengawas);

				
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
		if(empty($this->session->user))
		{
			$this->session->set('errorMessage', "Kamu Belum Login, Silahkan Login Terlebih Dahulu");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		$data = [];
		$dataCalon1 = [];
		$dataHasil1 = [];

		$hasilVote = $this->candidateModels->getHasilVote();
		foreach ($hasilVote as $key => $value) 
		{			
			array_push($dataCalon1, $value['name']);
			array_push($dataHasil1, $value['total_suara']);
		}
		
		$dataCalon2 = [];
		$dataHasil2 = [];

		$hasilVote2 = $this->candidateModels->getHasilVote2();
		foreach ($hasilVote2 as $key => $value) 
		{			
			array_push($dataCalon2, $value['name']);
			array_push($dataHasil2, $value['total_suara']);
		}

		$data['dataCalon'] = $dataCalon1;
		$data['dataHasil'] = $dataHasil1;
		$data['dataCalon2'] = $dataCalon2;
		$data['dataHasil2'] = $dataHasil2;		

		$masterpage_data['title'] = 'Hasil Pemilihan';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('HasilView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}

	public function peserta()
	{
		if(empty($this->session->user))
		{
			$this->session->set('errorMessage', "Kamu Belum Login, Silahkan Login Terlebih Dahulu");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		if($this->session->user['role'] !== 'Admin')
		{
			$this->session->set('errorMessage', "Unauthorized!");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		$dataPeserta = $this->uservoteModels->getDataPeserta();
		$data['dataPeserta'] = $dataPeserta;

		$masterpage_data['title'] = 'Daftar Peserta';
		$masterpage_data['content'] = view('DaftarPesertaView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}
	
	public function kodeKehadiran()
	{
		if(empty($this->session->user))
		{
			$this->session->set('errorMessage', "Kamu Belum Login, Silahkan Login Terlebih Dahulu");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		if($this->session->user['role'] !== 'Admin')
		{
			$this->session->set('errorMessage', "Unauthorized!");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		$dataKode = $this->uservoteModels->getListKodeKehadiran();
		$data['dataKode'] = $dataKode;

		$masterpage_data['title'] = 'Kode Kehadiran';
		$masterpage_data['content'] = view('DaftarKodeKehadiranView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}	

	public function daftarPaslon()
	{
		if(empty($this->session->user))
		{
			$this->session->set('errorMessage', "Kamu Belum Login, Silahkan Login Terlebih Dahulu");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		if($this->session->user['role'] !== 'Admin')
		{
			$this->session->set('errorMessage', "Unauthorized!");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		$pager = \Config\Services::pager();
        $model = new ModelPaslon();
        $data['paslon'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['page'] = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
		$data['masterVote'] = $this->modelPaslon->getMasterVote();

		$masterpage_data['title'] = 'Daftar Paslon';
		$masterpage_data['error'] = isset($errorMessage) ? $errorMessage : '';
		$masterpage_data['content'] = view('PaslonView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}

	public function waktu()
	{
		if(empty($this->session->user))
		{
			$this->session->set('errorMessage', "Kamu Belum Login, Silahkan Login Terlebih Dahulu");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

		if($this->session->user['role'] !== 'Admin')
		{
			$this->session->set('errorMessage', "Unauthorized!");
			$this->session->markAsFlashdata('errorMessage');

			return redirect()->to(base_url());	
		}

        $data['votingStart'] = $this->uservoteModels->getVoteStart();

		$postData = $this->request->getPost();
		if(!empty($postData))
		{
			$param['master_vote_id'] = 1;
			$param['start_date'] = $postData['startVote'];
			$param['end_date'] = $postData['endVote'];

			$updateVoteDate = $this->candidateModels->updateVoteDate($param);
				
			if(!$updateVoteDate)
			{
				$this->session->set('errorMessage', "Gagal menyimpan data");
				$this->session->markAsFlashdata('errorMessage');
			}
			else
			{
				$this->session->set('successMessage', "Waktu voting berhasil disimpan");
				$this->session->markAsFlashdata('successMessage');
			}
		}

		$masterpage_data['title'] = 'Waktu Voting';
		$masterpage_data['content'] = view('VotingStartView', $data);
		
		return view('MasterPageView', $masterpage_data);
	}

	public function resendLink($id)
	{
		$nik = $id;
		$userVote = $this->uservoteModels->getUserVote($nik);	

		$paths = 'vote/'.base64_encode($nik);
		$link = base_url($paths);
		$message = "Gunakan link berikut untuk melakukan pemilihan : ".$link." (Balas OK untuk mengaktifkan link vote)";
		$nomorWhatsapp = $userVote['phone_number'];
		
		$errorMessage = $this->whatsappHelper->sendWhatsapp('Send URL Vote', $nomorWhatsapp, $message);	
				
		if(!empty($errorMessage))
		{
			$this->session->set('errorMessage', "Resend Link gagal");
			$this->session->markAsFlashdata('errorMessage');
		}
		else
		{
			$this->session->set('successMessage', "Resend Link berhasil");
			$this->session->markAsFlashdata('successMessage');
		}

		return redirect()->to(base_url().'/pemilihan/peserta');
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

	public function deletePaslon()
	{
		$postData = $this->request->getPost();
	
		$data = $this->modelPaslon->deletePaslon($postData['id']);

		return json_encode($data);
	}

	public function reset()
	{	
		$data = $this->modelPaslon->reset();

		return json_encode($data);
	}

	
	//END STEP 3
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

	public function messageSuccess()
	{
		return view('SuccessMessageView');
	}
}
