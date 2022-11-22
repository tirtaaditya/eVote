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

        $data['notificationMenuURL'] = base_url()."/notification";
        $data['notificationURL'] = base_url()."/notification/getlistnotification";

		$masterpage_data['title'] = 'Home';
		$masterpage_data['content'] = view('HomeView', $data);

		return view('MasterPageView', $masterpage_data);
	}

}
