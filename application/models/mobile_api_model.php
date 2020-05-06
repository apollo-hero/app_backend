<?php
class Mobile_api_model extends CI_Model {


    //-- Check for register -----
    public function validate($table_name,$email) {
        $this->db->where('email', $email);
        $query = $this->db->get($table_name);
        if ($query->num_rows() == 1) {
            return false;
        }
        else{
            return true;
        }
    }

    //-- Get counts of any table by condions or without condions -----
    public function get_total_counts($table_name, $condion=array()) {
        $this->db->select('COUNT(*) As counts');
        if (isset($condion) && is_array($condion) && !empty($condion) && count($condion) > 0) {
            foreach ($condion as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        $query = $this->db->get($table_name);
        if ($query->num_rows() >= 1) {
            $row=$query->row();
            return $row->counts;
        }
        else{
            return 0;
        }
    }

    //-- Get listings with while condion or without conditions -----
    public function getlisting($table_name,$condion=array(),$orderby=0,$order="ASC",$limit=0) {
        $this->db->select('*');
        if (isset($condion) && is_array($condion) && !empty($condion) && count($condion) > 0) {
            foreach ($condion as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        if (isset($orderby)  && !empty($orderby)) {
           $this->db->order_by($orderby,$order);
        }
        if (isset($limit)  && !empty($limit)) {
            $this->db->limit($limit);
        }
        $query = $this->db->get($table_name);
        return $query->result_array();
    }

    //-- Like listings with while condion or without conditions -----
    public function get_all_data_with_like($tableName,$returnkey,$key,$value,$match='both',$condions) {
        $this->db->select($returnkey);
        $this->db->like($key,$value, $match);
        $this->db->from($tableName);
        $this->db->where($condions);
        $query = $this->db->get();
        return $query->result_array();
    }

    //-- Get a single row from table as array ----
    public function get_single_row($tableName,$whileCondition=array()){
        $this->db->select('*');
        $query = $this->db->get_where($tableName, $whileCondition);
        return $row=$query->row_array();
    }

    //-- Like Get a single row from table as array -----
    public function get_single_row_with_like($tableName,$returnkey,$key,$value,$match='both') {
        $this->db->select($returnkey);
        $this->db->like($key,$value, $match);
        $this->db->from($tableName);
        $query = $this->db->get();
        return $row=$query->row_array();
    }

    //-- Upadte data Using table condions as array
    public function update_data($tableName,$data,$condions) {
        $this->db->where($condions);
        $this->db->update($tableName, $data); 
        return $this->db->affected_rows();
    }

    //--  Update in any table -----
    public function update_data_key($table_name, $colume_name,$columevalue, $data) {
        $this->db->where($colume_name, $columevalue);
        $this->db->update($table_name, $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    //-- store data in table by array and table name -----
    public function store_data($table_name, $data) {
        $insert = $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }

    //-- Get single key as return value from any table condional array -----
    public function getsinglecolumevalue_array($tableName,$whileCondition,$returnkey){
        $this->db->select($returnkey);
        $query = $this->db->get_where($tableName, $whileCondition);
        $row=$query->row();
        if (is_array($row)) {
           return 0;
        } 
        else{
           return $row->$returnkey;
        }
    }

    //-- Like single key as return value from any table -----
    public function get_single_colum_with_like($tableName,$returnkey,$key,$value,$match='both') {
        //after  match%
        //before %match
        //both %match%
        $this->db->select($returnkey);
        $this->db->like($key,$value, $match);
        $this->db->from($tableName);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           $row=$query->row_array();
            return $row[$returnkey];
        }
        else{
            return 0;
        }
        return 0;
    }

    
    //-- GCM notifications sending -----
   public function send_ios($idarray = array(),$message) {
        $CI = & get_instance();
        try {
            if ($message != "" && $idarray != NULL) {
                
                $ctx = stream_context_create();
                if ($CI->config->item('IS_WEB_LIVE')) {
                    stream_context_set_option($ctx, 'ssl', 'local_cert',FCPATH.'/third_party/'. $CI->config->item('PUSH_LIVE_NAME'));
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $CI->config->item('PUSH_LIVE_PASSPHRASE'));
                    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                } else {
                    stream_context_set_option($ctx, 'ssl', 'local_cert', FCPATH.'/third_party/'.$CI->config->item('PUSH_DEV_NAME'));
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $CI->config->item('PUSH_DEV_PASSPHRASE'));
                    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                }
                if (!$fp) {
                } else {
                    $body['aps'] = array(
                       'alert' =>array('title'=>'' ,'type'=>"1",'body'=> $message),
                       'message' => $message,
                       'sound' => 'default.mp3',
                       'mutable-content'=>1,
                       'content-available'=>1,
                       'badge'=>1,
                       'priority'=>'high',
                    );

                    // Encode the payload as JSON
                    $payload = json_encode($body);
                    // Build the binary notification
                    foreach ($idarray as $key => $value) {
                                   
                    $msg = chr(0) . pack('n', 32) . pack('H*', $value) . pack('n', strlen($payload)) . $payload;
                    // Send it to the server
                    $result_notification = fwrite($fp, $msg, strlen($msg));
                    //push log
                   }
                    fclose($fp);
                }
            } else {
            }
        } catch (Exception $e) {
        }
    }


    //-- get distance between to lat and long points -----
    public function get_distance($point1,$point2) {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$point1."&destinations=".$point2."&mode=driving&key=".GOOGLE_MAP_API_KEY;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);
        if ($response_a['status']== 'OK') {
            $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
            $time = $response_a['rows'][0]['elements'][0]['duration']['text'];
            return array('distance' => $dist, 'time' => $time);
        }
        else{
            return array('distance' => 0, 'time' => 0);
        }
    }

    //-- google map api  for get lat long -----
    public function get_latitude_longitude_by_address_or_postalcode($address){
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key='.GOOGLE_MAP_API_KEY);
        $output= json_decode($geocode);
        if (($output->status!= 'REQUEST_DENIED' || $output->status!='ZERO_RESULTS') && $output->status== 'OK' ) {
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;
        }
        else{
            $latitude = 0;
            $longitude =0;
        }
        return array('latitude'=>$latitude,'longitude'=>$longitude);
    }
    // Get About Us...............................................
    public function get_about_us()
    {
        $sql = "SELECT * FROM ".TABLE_CONTENT_MGMT." ORDER BY content_management_id DESC ";
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }
}
