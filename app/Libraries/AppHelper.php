<?php

namespace App\Libraries;

class AppHelper
{
	function getCurrentDate()
    {
        $currentDate = Date('Y-m-d');

        return $currentDate;
    }

    function getCurrentDatetime()
	{
		$currentDateTime = Date('Y-m-d H:i:s');

		return $currentDateTime;
	}

	function getBreadCrumb()
	{
		$uri = service('uri');
		$totalSegmentURL = $uri->getTotalSegments();
		$totalSegmentURL = $totalSegmentURL > 6 ? 6 : $totalSegmentURL;

		$breadcrumb = "Home";

		if($uri->getSegment(1) != 'home')
		{
			for($i = 1; $i <= $totalSegmentURL; $i++)
			{
				$item = $uri->getSegment($i); 

				if(!empty($item) || $item != 'index')
				{
					if($breadcrumb != "")
					{
						$breadcrumb .= "/";
					}

					$item = $this->getMappingCustomBreadcumb($item);

					if($i == $totalSegmentURL && (is_numeric($item) || strpos($item, "_") !== false))
					{
						$breadcrumb .= $item;
					}
					else
					{
						$breadcrumb .= ucfirst($item);
					}
				}
			}
		}

		$arr_breadcrumb = explode("/", $breadcrumb);

		return $arr_breadcrumb;
	}

	function getMappingCustomBreadcumb($key)
	{
		$breadcrumbs['userparameter'] = "User Parameter";
		$breadcrumbs['systemparameter'] = "System Parameter";
		$breadcrumbs['auditesb'] = "Audit ESB";
		$breadcrumbs['auditinterface'] = "Audit Interface";
		$breadcrumbs['auditsystem'] = "Audit System";

		return array_key_exists($key, $breadcrumbs) ? $breadcrumbs[$key] : $key;
	}

	function getPrefixURL($max_segment)
	{
		$prefix_url = "";
		$uri = service('uri');

		for($i = 1; $i <= $max_segment; $i++)
		{
			if($prefix_url != "")
			{
				$prefix_url .= "/";
			}

			$prefix_url .= $uri->getSegment($i);
		}

		return base_url().'/'.$prefix_url;
	}

	function getErrorMessageAPI($errorMessageAPI)
	{
		$errorMessage = "";

		if(is_array($errorMessageAPI))
		{
			foreach ($errorMessageAPI as $key => $value)
			{
				if($errorMessage != "")
				{
					$errorMessage .= "<br />";
				}
				
				$errorMessage .= $value;
			}
		}
		else
		{
			$errorMessage = $errorMessageAPI;
		}

		return $errorMessage;
	}

	function removeCurrencyFormat($amount)
	{
		$arr_amount = explode(".", $amount);
		$tmp_amount = str_replace(",", "", $arr_amount[0]);

		return $tmp_amount;
	}

	function getURLAuthorityMenu($menu)
	{
		$result = [];

		foreach ($menu as $key => $value)
		{
			if(!empty($value['url']))
			{
				array_push($result, $value['url']);
			}
			
			if(!empty($value['submenu']))
			{
				$result = $this->getURLAuthoritySubmenu($value['submenu'], $result);
			}
		}

		return $result;
	}

	function getURLAuthoritySubmenu($subMenu, $urlMenus)
	{
		$result = $urlMenus;

		foreach ($subMenu as $key => $value)
		{
			if(!empty($value['url']))
			{
				array_push($result, $value['url']);
			}
			
			if(!empty($value['submenu']))
			{
				$result = $this->getURLAuthoritySubmenu($value['submenu'], $result);
			}
		}

		return $result;
	}
}