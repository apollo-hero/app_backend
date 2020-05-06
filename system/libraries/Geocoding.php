<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * GeoCoding Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
 
Class CI_Geocoding
{
	private $lat = "";
	private $lng = "";	
	private $address = "";
	private $url = "";
	private $refrence = "";
	private $googleKey = "AIzaSyC7quNkbkGIVyt6pEf56q9QW9iXarsdntU";
	//AIzaSyCssWR3AsRH5ouJxA1eLuiGcbBs35yZKvA SEVER KEY  for mobilitytesting.com
	
	public function getDetails($addr,$refrence=null,$returnType="array",$latitude="",$longitude="")
	{
		$this->address = $addr;
		
		if($refrence!=null)
		{
			$this->refrence = $refrence;
		}
		
		if($latitude!="" && $longitude!="")
		{
			$this->lat = $latitude;
			$this->lng = $longitude;
			$this-> makeUrl1();		
		}
		else
		{
			$this-> makeUrl();
		}
		
		$final = $this->parseGeoData();		
		
		if($returnType == "json")
		{
			return $this->makeJson($final);	
		}
		else
		{		
			return $final;
		}
	}
	
	
	private function makeJson($data)
	{
		return json_encode($data);
	}
	
	private function makeUrl()
	{
		$this->address = str_replace(" ", "+",$this->address);
		//$this->url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$this->address."&sensor=false";
		if($this->refrence!="")
		{
			$this->url = "https://maps.googleapis.com/maps/api/place/details/json?reference=".$this->refrence."&key=".$this->googleKey;
		}
		else
		{
			$this->url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$this->address."&sensor=false&key=".$this->googleKey;
		}
		//$this->url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=12.9746239,77.6097423";
	}


	private function makeUrl1()
	{
		$this->url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$this->lat.",".$this->lng."&key=".$this->googleKey;
	}

	
	private function parseGeoData()
	{
		//echo $this->url;exit;
		$data = file_get_contents($this->url);
		$result = json_decode($data);
		
		/*echo "<Pre>";
		print_r($result);*/
		
		
		if($result->status == "OK")
		{
			if($this->refrence!="" || ($this->lat!= "" && $this->lng!=""))
			{	
				$pincode = "";
				$data = $result->results[0]->address_components;
				if($data)
				{
					foreach($data as $key => $val)
					{
						$long_name = $val->long_name;
						$type = "";
						if(is_array($val->types) AND count($val->types) > 0)
						{
						   $type = $val->types[0];
						}
						
						if($type=="postal_code")
						{
							$pincode = $long_name;
						}
					}	
				}	
				//echo "postal code".$pincode;exit;			
				return $pincode;
			}
			else
			{
				if($result->results[0]->geometry->location)
				{
					$addressFromGoogle = $result->results[0]->formatted_address;
					$lat = $result->results[0]->geometry->location->lat;
					$lng = $result->results[0]->geometry->location->lng;
					$reference = $result->results[0]->reference;
					
					$resultFromGl['status'] = $result->status;
					$resultFromGl['address'] = $addressFromGoogle;
					$resultFromGl['lat'] = $lat;
					$resultFromGl['lng'] = $lng;
					$resultFromGl['reference'] = $reference;
	
					
					return $resultFromGl;
				}
				else
				{
					$resultFromGl['status'] = "Address not found";
				}
			}
		}
		else
		{
			if($this->refrence!="" || ($this->lat!= "" && $this->lng!="") && $result->status!= "ZERO_RESULTS")
			{
				return $data = $result->error_message;
			}
			else
			{		
				$resultFromGl['status'] = "Address not found";
			}	
		}	
	}
	
}
 
// END Geocoding Class