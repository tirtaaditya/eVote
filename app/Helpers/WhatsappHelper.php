<?php

namespace App\Helpers;

use App\Models\WhatsappModel;

class WhatsappHelper
{
	function __construct()
    {
		$this->whatsappModels = new WhatsappModel();
	}

	function sendWhatsapp($module, $nomorWhatsapp, $message)
	{
		$url = "https://server.wa-bisnis.com/send-message";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		   "Content-Type: application/json",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = <<<DATA
		{
			"api_key" : "EmnGeVLVlVrmWlWZYN7ttXmtvSAaRP",
			"sender" : "6287867551080",
			"number" : "$nomorWhatsapp",
			"message" : "$message"
		}
		DATA;

		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($curl);
		curl_close($curl);
				
		$logWhatsapp['module'] = $module;
		$logWhatsapp['phone_number'] = $nomorWhatsapp;
		$logWhatsapp['message'] = $message;
		$logWhatsapp['response'] = $result;
		
		$this->whatsappModels->insertLogWA($logWhatsapp);
	}

}
