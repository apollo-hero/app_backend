<?php
// Name of Class as mentioned in $hook['post_controller]
class Db_log {
 
    function __construct() {
       // Anything except exit() :P
    }
 
    // Name of function same as mentioned in Hooks Config
    function logQueries() {
 
        $CI = & get_instance();
        
        $filepath = APPPATH . 'logs/Query-log-' . date('Y-m-d h:i') . '.php';
        $message  = '';

        if ( ! file_exists($filepath))
        {
                $message .= "<"."?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?".">\n\n Start>>>>";
        }

        if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
        {
                return FALSE;
        }
        
 
       // $filepath = APPPATH . 'logs/Query-log-' . date('Y-m-d') . '.php'; // Creating Query Log file with today's date in application/logs folder
        //$handle = fopen($filepath, "a+");                 // Opening file with pointer at the end of the file
        $post ='';
        $get = '';
        flock($fp, LOCK_EX);
        @chmod($filepath, FILE_WRITE_MODE);
        
        if(isset($_POST) && $_POST != NULL)
        $post = json_encode($_POST);
        if(isset($_GET) && $_GET != NULL)
        $get = json_encode($_GET);
        
        $count = 1;
        if($count == 1)
        fwrite($fp, $CI->uri->uri_string()."\n\n".$message. "\n\n ".$post." \n\n ".$get." \n\n ");
        
        $times = $CI->db->query_times;                   // Get execution time of all the queries executed by controller
        
        foreach ($CI->db->queries as $key => $query) { 
            $sql = $query . " \n Execution Time:" . $times[$key]; // Generating SQL file alongwith execution time
            //fwrite($handle, $sql . "\n\n");              // Writing it in the log file
            
            
            if(count($CI->db->queries) == $count)
            $sql = $sql." \n \n \n END mahi889@gmail.com >>>>>"; 
            
            fwrite($fp, $CI->uri->uri_string()."\n\n".$sql. "\n\n");
            $count++;
            
        }
        flock($fp, LOCK_UN);
        fclose($fp);
       // fclose($handle);      // Close the file
    }
 
}

?>