<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class Main extends BaseController
{
	public function __construct()
    {
        $this->validation =  \Config\Services::validation();

        $this->models = new AuthModel();
    }

	public function index()
	{
		// $this->session->destroy();
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
			}

		}
		catch (\Exception $e)
        {
        	$errorMessage = $e->getMessage();
        }

		$response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage;
        $response['data'] = $dataUser;

		return json_encode($response);
	}

	public function logout()
	{
		$this->session->destroy();

		return redirect()->to(base_url().'/main');
	}
}
