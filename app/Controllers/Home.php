<?php namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
        if($this->checkSession())
        {
        	return redirect()->to(base_url().'/main/logout');
        }

		$data = [];

		$masterpage_data['title'] = 'Beranda';
		$masterpage_data['content'] = view('HomeView', $data);

		return view('MasterPageView', $masterpage_data);
	}

}
