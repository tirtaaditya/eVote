<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class Main extends BaseController
{
	public function index()
	{
		// $this->session->destroy();
		if($this->session->has('user'))
		{
			if( $this->session->user['working_unit']=='KC')
			{
				if( $this->session->user['open_close']=='pendingClose')
				{
					$this->session->set('errorMessage', 'Belum dilakukan close branch pada hari sebelumnya. Harap lakukan opname kas dan close branch agar dapat bertransaksi');
					$this->session->markAsFlashdata('errorMessage');
				}
			}

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

		try
		{
			$postData = $this->request->getPost();

			$params['user_type'] = $postData['user_type'];
	       	$params['user_id'] = $postData['user_id'];
	       	$params['password'] = $postData['password'];

			$response = $this->client->request('POST', $this->urlHelper->login, 
						[
						    'form_params' => $params
						]);
			
			$response = json_decode($response->getBody(), true);
		}
		catch (\Exception $e)
        {
        	$response['code'] = '04';
        	$response['message'] = $e->getMessage();
        }

		if($response['code'] == '00')
		{
			$response_data = $response['data'];
			
			$user_session['user_id'] = $response_data['user_id'];
			$user_session['user_type'] = $response_data['user_type'];
			$user_session['fullname'] = $response_data['fullname'];
			$user_session['gender'] = $response_data['gender'];
			$user_session['working_unit'] = $response_data['working_unit'];
			$user_session['division'] = $response_data['division'];
			$user_session['group'] = $response_data['group'];
			$user_session['job_position'] = $response_data['job_position'];
			$user_session['level'] = $response_data['level'];
			$user_session['role_id'] = $response_data['role_id'];
			$user_session['role_name'] = $response_data['role_name'];
			$user_session['authority_id'] = $response_data['authority_id'];
			$user_session['authority_name'] = $response_data['authority_name'];
			$user_session['authority_menu'] = $response_data['authority_menu'];
			$user_session['branch'] = $response_data['branch'];

			if(!in_array($response_data['working_unit'], ['Kanwil', 'Kanpus']))
			{
				$user_session['branch_id'] = $response_data['branch_id'];
				$user_session['open_close'] = $response_data['close_open'];
			}
			
			$sessionid = session_id();
			$user_session['sessionid'] = $sessionid;

			$str_current_datetime = strtotime(date('Y-m-d H:i:s'));
			$user_session['sessionmodified'] = $str_current_datetime;

			$this->session->set('user', $user_session);

			// Get mandatory banknotes file user parameter
			$param['id'] = "mandatory_banknotes_file";

		 	$responseUserParameter = $this->client->setHeader('Content-Type', 'application/json')
								->request('GET', $this->urlHelper->userParameter,
								[
								'query' => $param
								]);

			$responseUserParameter = json_decode($responseUserParameter->getBody(), true);

			$userParameter = $responseUserParameter['data'];

			foreach ($userParameter as $key => $value)
			{
				$user_parameter_session[$value['user_parameter_id']] = $value['data'];
			}

			$this->session->set('user_parameter', $user_parameter_session);
		}
		else
		{
			$this->session->set('errorMessage', $this->appHelper->getErrorMessageAPI($response['message']));
			$this->session->markAsFlashdata('errorMessage');
		}

		return redirect()->to(base_url());
	}

	public function logout()
	{
		try
        {
            $params['user_type'] = $this->session->user['user_type'];
            $params['user_id'] = $this->session->user['user_id'];

			$response = $this->client->request('POST', $this->urlHelper->logout, 
						[
						    'form_params' => $params
						]);

			$response = json_decode($response->getBody(), true);
        }
        catch (\Exception $e)
        {
        }

		$this->session->destroy();

		return redirect()->to(base_url().'/main');
	}

	public function old()
	{
		$masterpage_data['content'] = view('DashboardView');
		$masterpage_data['postback_url'] = base_url()."/dashboard";

		return view('MasterPageView-old', $masterpage_data);
	}

}
