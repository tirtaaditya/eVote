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
		$url =  "https://api.kirimwa.id/v1/messages";
		$data = array("phone_number" => $nomorWhatsapp, "message" => $message, "device_id" => "samsungmod", "message_type" => "text");
		$options = array(
		'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $data ),
			'header'=>  "Content-Type: application/json\r\n" .
						"Accept: application/json\r\n" .
				"Authorization: Bearer qtkl44hm/c2FdwgDzxBDKx5NYbs+GUgkVdr55Hd6UJwIJIANexmUTSBByiugRMAg-tirta\r\n"
			)
		);
		$context  = stream_context_create( $options );
		$result = file_get_contents( $url, false, $context );

		$logWhatsapp['module'] = $module;
		$logWhatsapp['phone_number'] = $nomorWhatsapp;
		$logWhatsapp['message'] = $message;
		$logWhatsapp['response'] = $result;
		
		$this->whatsappModels->insertLogWA($logWhatsapp);
	}

}