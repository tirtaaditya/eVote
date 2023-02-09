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
		$statusWhatsapp = "";
		
		$url = "https://api.kirimwa.id/v1/messages";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
		   "Authorization: Bearer qtkl44hm/c2FdwgDzxBDKx5NYbs+GUgkVdr55Hd6UJwIJIANexmUTSBByiugRMAg-tirta",
		   "Content-Type: application/json",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = <<<DATA
		{
			"phone_number":"$nomorWhatsapp",
			"message" : "$message",
			"device_id":"samsungmod",
			"message_type":"text"
		}
		DATA;

		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($curl);
		curl_close($curl);
		$kwid = json_decode($result);
		
		if(empty($kwid->id))
		{
			$url = "https://api.watsap.id/send-message";

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
				"id_device" : "4837",
				"api-key" : "f915c170b6ed54a006a1353a27cd1c3240716f94",
				"sender" : "6287867551080",
				"no_hp" : "$nomorWhatsapp",
				"pesan" : "$message"
			}
			DATA;

			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			//for debug only!
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$result = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			
			if($httpcode == 503)
			{
				$statusWhatsapp = "Server whatsapp is busy";
			}
		}
				
		$logWhatsapp['module'] = $module;
		$logWhatsapp['phone_number'] = $nomorWhatsapp;
		$logWhatsapp['message'] = $message;
		$logWhatsapp['response'] = $result;
		
		$this->whatsappModels->insertLogWA($logWhatsapp);
		
		return $statusWhatsapp;
	}

}
