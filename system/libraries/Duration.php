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
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Uploads
 * @author		ExpressionEngine Dev Team
 */
class CI_Duration {

    
    protected $mp3data;
    protected $fileDirectory;
    protected $bitRate;
    protected $blockMax;
     
    public function __construct()
    {
        
    }   
     
    public function get_mp3_duration($filename, $bitrate = null) {
        $this->mp3data = array();
        $this->mp3data['filesize'] = $this->get_size_of_file($filename);
        $this->fileDirectory = fopen($filename, "r");
        $this->blockMax = 1024;
         
        if($bitrate) 
            $this->bitRate = $bitrate;
        else
            $this->bitRate= 128;
         
        $this->set_data();
        return $this->mp3data['duration'];
    }    
     
 
    public function get_mp3_filesize() {
        return $this->mp3data['filesize'];
    }
 
    protected function get_size_of_file($url) { 
        if (substr($url,0,4)=='http') { 
             
            $x = array_change_key_case(get_headers($url, 1),CASE_LOWER); 
             
            if ( strcasecmp($x[0], 'HTTP/1.1 200 OK') != 0 ) { 
                $x = $x['content-length'][1]; 
            } 
            else { 
                $x = $x['content-length']; 
            } 
        } 
        else { 
            $x = @filesize($url); 
        } 
     
        return $x; 
    }      
     
     
    protected function set_data() {
        $this->mp3data['length'] = $this->get_duration($this->mp3data, $this->tell(), $this->bitRate);
        $this->mp3data['duration'] = $this->get_formatted_time($this->mp3data['length']);
    }
    protected function tell()
    {
        return ftell($this->fileDirectory)-$this->blockMax - 1;
    }    
     
    protected function get_duration(&$mp3,$startat, $bitrate)
    {
        if ($bitrate > 0)
        {
            $KBps = ($bitrate * 1000)/8;
            $datasize = ($mp3['filesize'] - ($startat/8));
            $length = $datasize / $KBps;
            return sprintf("%d", $length);
        }
        return "";
    }
 
    protected function get_formatted_time($duration)
    {
        $hours = floor($duration / 3600);
        $minutes = floor( ($duration - ($hours * 3600)) / 60);
        $seconds = $duration - ($hours * 3600) - ($minutes * 60);
        return sprintf("%02d:%02d:%d", $hours, $minutes,  $seconds);
    } 	   


}
// END Duration Class

/* End of file Duration.php */
/* Location: ./system/libraries/Duration.php */
