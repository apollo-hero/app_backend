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
 
Class CI_General_function
{
    /**
    * encript the password 
    * @return mixed
    */	
    public function __encrip_password($password) {
        return md5($password);
    }	
	

    public function isValidEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            return FALSE;
        }else{
            return TRUE;
        }
    }

        public function showImage($imageName,$imageWithPath,$id=0)
    {
		$html = '<div class="form-group">
					<label class="control-label col-md-3">&nbsp;</label>
						<div class="profile-userpic  col-md-2">
							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >
							<img alt="" class="img-responsive" src="'.$imageWithPath.'">
						</div>
						<button class="btn btn-danger remove_image" id="'.$id.'" type="button">Remove Image</button>
				</div>';
		return $html;
	}

	 public function showImage12($imageName,$imageWithPath,$id=0)
    {
		$html = '<div class="form-group">
					<label class="control-label col-md-3">&nbsp;</label>
						<div class="profile-userpic  col-md-2">
							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >
							<img alt="" class="img-responsive" src="'.$imageWithPath.'">
						</div>
						
				</div>';
		return $html;
	}

	  public function showImage1($imageName,$imageWithPath,$id=0)
    {
		$html = '<div class="form-group">
					<label class="control-label col-md-3">&nbsp;</label>
						<div class="profile-userpic  col-md-2">
							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >
							
							

							<audio controls>
								<source src="'.$imageWithPath.'" type="audio/ogg">
								
							Your browser does not support the audio element.
							</audio>
							
						</div>					
				</div>';
		return $html;
	}



    public function showImage112($imageName,$imageWithPath,$id=0)
    {
		$html = '<div class="form-group">
					<label class="control-label col-md-3">&nbsp;</label>
						<div class="profile-userpic  col-md-2">
							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >					

							<video controls>
							  <source src="'.$imageWithPath.'" type="video/mp4">
							   Your browser does not support the video tag.
							</video>
								<button class="btn btn-danger remove_file" id="'.$id.'" type="button">Remove File</button>
						</div>						
				</div>';
		return $html;
	}



	  public function showImage113($imageName,$imageWithPath,$id=0)
    {
		$html = '<div class="form-group">
					<label class="control-label col-md-3">&nbsp;</label>
						<div class="profile-userpic  col-md-2">
							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >					

							
							 
							  <embed src="'.$imageWithPath.'" width="500px" height="500px" />

								
							
						</div>					
				</div>';
		return $html;
	}





   public function getRandomStringNumber($len = 30) {
        // $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $chars = "0123456789";
        $r_str = "";
        for ($i = 0; $i < $len; $i++)
            $r_str .= substr($chars, rand(0, strlen($chars)), 1);

        if (strlen($r_str) != $len) {
            $r_str .= $this->getRandomStringNumber($len - strlen($r_str));
        }

        return $r_str;
    }
    
   public function sendHtmlMail($array) {

    $headers = "Content-type: text/html; charset=iso-8859-1";
    
      $from = 'john.smith001187@gmail.com';
      // if (isset($array['from'])) {
      $headers .= '\r\n From: ' . $from . '\r\n';
    

    @mail($array['to'], $array['subject'], $array['body'], $headers);
   }        





	//$db->send_push_notification(array($device_details['push_id']),
	//array("msg"=>"Someone request you to be his/her partner")); //Sending Push Notification
	
	public function send_android_push_notification($registatoin_ids, $message,$print=false)
	{
			// Set POST variables
			$url = 'https://android.googleapis.com/gcm/send';
	
			$fields = array(
				'registration_ids' => $registatoin_ids,
				'data' => $message,
			);
	
			$headers = array(
				'Authorization: key=' . ANDROID_PUSH_NOTIFICATION_KEY,
				'Content-Type: application/json'
			);
	
	
	
			//print_r($headers);
			// Open connection
			$ch = curl_init();
	
			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
	
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	
			// Execute post
			$result = curl_exec($ch);
			
			if($print==true)
			{
				print_r(json_decode($result));
			}
			
			if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
	
			// Close connection
			curl_close($ch);
			//echo $result;
		}



	function ios_push($deviceToken, $message,$print=false)
	{
	
		// Put your private key's passphrase here:
		$passphrase = 1234;
		
		// Put your alert message here:
		//$message = 'Babaa Push notificatin Testig Message';
		
		////////////////////////////////////////////////////////////////////////////////
		
		$ctx = stream_context_create();
		//stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'http://mobilitytesting.com/zestful/ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
	
		if($print==true)
		{
			echo 'Connected to APNS' . PHP_EOL;
		}
		
		// Create the payload body
		$body['aps'] = array(
			'alert' => $message,
			'sound' => 'default'
			);
		$body['message'] =$message;
		$body['id'] ="3"; //1 FOR ACTIVITY, 2 for order, 3 for chat.
		
		// Encode the payload as JSON
		$payload = json_encode($body);
		
		// Build the binary notification
		//$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		$msg = chr(0) . pack('n', 32) . self::hex2bin($deviceToken) . pack('n', strlen($payload)) . $payload;
		
		
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		if (!$result)
		{
			if($print==true)
			{
				echo 'Message not delivered' . PHP_EOL;
			}	
		}	
		else
		{
			if($print==true)
			{
				echo 'Message successfully delivered' . PHP_EOL;
			}	
		}
		// Close the connection to the server
		fclose($fp);
		
	}


	function send_ios_notification_old($deviceToken, $message,$print=false)
	{
		define("IOS_PASSPHRASE", "");
	
		// Put your private key's passphrase here:
		$passphrase = IOS_PASSPHRASE;
		
		// Put your alert message here:
		//$message = 'My first push notification!';
		
		////////////////////////////////////////////////////////////////////////////////
		
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		
		//echo 'Connected to APNS' . PHP_EOL;
		
		// Create the payload body
		$body['aps'] = array(
			'alert' => $message,
			'sound' => 'default'
			);
		
		// Encode the payload as JSON
		$payload = json_encode($body);
		
		

		// Build the binary notification
		//$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		$msg = chr(0) . pack('n', 32) . self::hex2bin($deviceToken) . pack('n', strlen($payload)) . $payload;
		
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		
		if (!$result)
		{
			if($print==true)
			{
				echo 'Message not delivered' . PHP_EOL;
				echo json_encode($result);
			}
			return false;
		}
		else
		{
			if($print==true)
			{
				echo json_encode($result);
				echo 'Message successfully delivered' . PHP_EOL;
			}	
			return true;
		}	
		// Close the connection to the server
		fclose($fp);
	}


	function hex2bin($hexdata) {
	   $bindata="";
	   for ($i=0;$i<strlen($hexdata);$i+=2) {
		  $bindata.=chr(hexdec(substr($hexdata,$i,2)));
	   }
	
	   return $bindata;
	}

	function isValidTimezone($timezone) {
	  return in_array($timezone, timezone_identifiers_list());
	}

	function get_distance_between_pincodes($pincode_default_country,$origins,$destinations)
	{
		$origins = str_replace(" ","%20",$origins);
		$destinations = str_replace(" ","%20",$destinations);
		
		$url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$pincode_default_country."+".$origins."&destinations=".$pincode_default_country."+".$destinations."&mode=driving&language=en-EN&sensor=false";
		$data   = @file_get_contents($url);
		$result = json_decode($data, true);
		
		
		if($result["rows"][0]["elements"][0]["status"]=="OK")
		{
			$kilometers = $result["rows"][0]["elements"][0]["distance"]["value"] / 1000;
		}
		else
		{
			$kilometers = "";
		}

		return $kilometers;
	}


	function send_ios_notification($deviceToken, $message,$print=false)
	{
		// Put your device token here (without spaces):
		//$deviceToken = '772da543e90a5a36a2eea62782ef29a4a366a3b89471f4c8e131bf84951918b9';
		
		
		// Put your private key's passphrase here:
		$passphrase = 'pushchat';
		
		// Put your alert message here:
		//$message = 'My first push notification 1!';
		
		////////////////////////////////////////////////////////////////////////////////
		
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ZestFulCertificate.pem');
		//stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		// Open a connection to the APNS server
		$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err,
								   $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
		if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);
		
		if($print==true)
		{
			echo 'Connected to APNS' . PHP_EOL;
		}
		
		// Create the payload body
		$body['aps'] = array(
							 'alert' => $message,
							 'sound' => 'default'
							 );
		
		// Encode the payload as JSON
		$payload = json_encode($body);
		
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		if (!$result)
		{
			if($print==true)
			{
				echo 'Message not delivered' . PHP_EOL;
			}	
		}	
		else
		{
			if($print==true)
			{
				echo 'Message successfully delivered' . PHP_EOL;
			}
		}		
		// Close the connection to the server
		fclose($fp);
	
	}

       /////// getDuration Code
        public function formatTime($duration) //as hh:mm:ss
	{
		//return sprintf("%d:%02d", $duration/60, $duration%60);
		$hours = floor($duration / 3600);
		$minutes = floor( ($duration - ($hours * 3600)) / 60);
		$seconds = $duration - ($hours * 3600) - ($minutes * 60);
		return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
	}
	//Read first mp3 frame only...  use for CBR constant bit rate MP3s
	public function getDurationEstimate()
	{
		return $this->getDuration($use_cbr_estimate=true);
	}
	//Read entire file, frame by frame... ie: Variable Bit Rate (VBR)
	public function getDuration($use_cbr_estimate=false, $file)
	{
		$fd = fopen($file, "rb");
		$duration=0;
		$block = fread($fd, 100);
		$offset = $this->skipID3v2Tag($block);
		fseek($fd, $offset, SEEK_SET);
		while (!feof($fd))
		{
			$block = fread($fd, 10);
			if (strlen($block)<10) { break; }
			//looking for 1111 1111 111 (frame synchronization bits)
			else if ($block[0]=="\xff" && (ord($block[1])&0xe0) )
			{
				$info = self::parseFrameHeader(substr($block, 0, 4));
				fseek($fd, $info['Framesize']-10, SEEK_CUR);
				$duration += ( $info['Samples'] / $info['Sampling Rate'] );
			}
			else if (substr($block, 0, 3)=='TAG')
			{
				fseek($fd, 128-10, SEEK_CUR);//skip over id3v1 tag size
			}
			else
			{
				fseek($fd, -9, SEEK_CUR);
			}
			if ($use_cbr_estimate && !empty($info))
			{ 
				return $this->estimateDuration($info['Bitrate'],$offset); 
			}
		}
		return round($duration);
	}
	public function estimateDuration($bitrate,$offset)
	{
		$kbps = ($bitrate*1000)/8;
		$datasize = filesize($this->filename) - $offset;
		return round($datasize / $kbps);
	}
	public function skipID3v2Tag(&$block)
	{
		if (substr($block, 0,3)=="ID3")
		{
			$id3v2_major_version = ord($block[3]);
			$id3v2_minor_version = ord($block[4]);
			$id3v2_flags = ord($block[5]);
			$flag_unsynchronisation  = $id3v2_flags & 0x80 ? 1 : 0;
			$flag_extended_header    = $id3v2_flags & 0x40 ? 1 : 0;
			$flag_experimental_ind   = $id3v2_flags & 0x20 ? 1 : 0;
			$flag_footer_present     = $id3v2_flags & 0x10 ? 1 : 0;
			$z0 = ord($block[6]);
			$z1 = ord($block[7]);
			$z2 = ord($block[8]);
			$z3 = ord($block[9]);
			if ( (($z0&0x80)==0) && (($z1&0x80)==0) && (($z2&0x80)==0) && (($z3&0x80)==0) )
			{
				$header_size = 10;
				$tag_size = (($z0&0x7f) * 2097152) + (($z1&0x7f) * 16384) + (($z2&0x7f) * 128) + ($z3&0x7f);
				$footer_size = $flag_footer_present ? 10 : 0;
				return $header_size + $tag_size + $footer_size;//bytes to skip
			}
		}
		return 0;
	}
	public function parseFrameHeader($fourbytes)
	{
		static $versions = array(
			0x0=>'2.5',0x1=>'x',0x2=>'2',0x3=>'1', // x=>'reserved'
		);
		static $layers = array(
			0x0=>'x',0x1=>'3',0x2=>'2',0x3=>'1', // x=>'reserved'
		);
		static $bitrates = array(
			'V1L1'=>array(0,32,64,96,128,160,192,224,256,288,320,352,384,416,448),
			'V1L2'=>array(0,32,48,56, 64, 80, 96,112,128,160,192,224,256,320,384),
			'V1L3'=>array(0,32,40,48, 56, 64, 80, 96,112,128,160,192,224,256,320),
			'V2L1'=>array(0,32,48,56, 64, 80, 96,112,128,144,160,176,192,224,256),
			'V2L2'=>array(0, 8,16,24, 32, 40, 48, 56, 64, 80, 96,112,128,144,160),
			'V2L3'=>array(0, 8,16,24, 32, 40, 48, 56, 64, 80, 96,112,128,144,160),
		);
		static $sample_rates = array(
			'1'   => array(44100,48000,32000),
			'2'   => array(22050,24000,16000),
			'2.5' => array(11025,12000, 8000),
		);
		static $samples = array(
			1 => array( 1 => 384, 2 =>1152, 3 =>1152, ), //MPEGv1,     Layers 1,2,3
			2 => array( 1 => 384, 2 =>1152, 3 => 576, ), //MPEGv2/2.5, Layers 1,2,3
		);
		//$b0=ord($fourbytes[0]);//will always be 0xff
		$b1=ord($fourbytes[1]);
		$b2=ord($fourbytes[2]);
		$b3=ord($fourbytes[3]);
		$version_bits = ($b1 & 0x18) >> 3;
		$version = $versions[$version_bits];
		$simple_version =  ($version=='2.5' ? 2 : $version);
		$layer_bits = ($b1 & 0x06) >> 1;
		$layer = $layers[$layer_bits];
		$protection_bit = ($b1 & 0x01);
		$bitrate_key = sprintf('V%dL%d', $simple_version , $layer);
		$bitrate_idx = ($b2 & 0xf0) >> 4;
		$bitrate = isset($bitrates[$bitrate_key][$bitrate_idx]) ? $bitrates[$bitrate_key][$bitrate_idx] : 0;
		$sample_rate_idx = ($b2 & 0x0c) >> 2;//0xc => b1100
		$sample_rate = isset($sample_rates[$version][$sample_rate_idx]) ? $sample_rates[$version][$sample_rate_idx] : 0;
		$padding_bit = ($b2 & 0x02) >> 1;
		$private_bit = ($b2 & 0x01);
		$channel_mode_bits = ($b3 & 0xc0) >> 6;
		$mode_extension_bits = ($b3 & 0x30) >> 4;
		$copyright_bit = ($b3 & 0x08) >> 3;
		$original_bit = ($b3 & 0x04) >> 2;
		$emphasis = ($b3 & 0x03);
		$info = array();
		$info['Version'] = $version;//MPEGVersion
		$info['Layer'] = $layer;
		//$info['Protection Bit'] = $protection_bit; //0=> protected by 2 byte CRC, 1=>not protected
		$info['Bitrate'] = $bitrate;
		$info['Sampling Rate'] = $sample_rate;
		//$info['Padding Bit'] = $padding_bit;
		//$info['Private Bit'] = $private_bit;
		//$info['Channel Mode'] = $channel_mode_bits;
		//$info['Mode Extension'] = $mode_extension_bits;
		//$info['Copyright'] = $copyright_bit;
		//$info['Original'] = $original_bit;
		//$info['Emphasis'] = $emphasis;
		$info['Framesize'] = self::framesize($layer, $bitrate, $sample_rate, $padding_bit);
		$info['Samples'] = $samples[$simple_version][$layer];
		return $info;
	}
	public function framesize($layer, $bitrate,$sample_rate,$padding_bit)
	{
		if ($layer==1)
			return intval(((12 * $bitrate*1000 /$sample_rate) + $padding_bit) * 4);
		else //layer 2, 3
			return intval(((144 * $bitrate*1000)/$sample_rate) + $padding_bit);
	}

}
 
// END General_function Class