<?php

class Mobile_api extends CI_Controller {
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }

        /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	
    
    //-- Get category list 
    public function get_category(){
    	$returnStatus = 1;
        $msg = "category list!...";
        $data = array();
        // input parameters
        $flag = 1;
        if ($flag) {
    		$category=$this->Mobile_api_model->getlisting(TABLE_CATEGORY,array('category_status'=>1),'category_id');
            if (count($category)) {
                foreach ($category as $key => $value) {
                    $info['category_id']=$value['category_id'];
                    $info['category_name']=$value['category_name'];
                    $info['category_image']=base_url().CATEGORY_IMG_UPLOAD.$value['category_image'];
                    array_push($data, $info);
                }
            }
            else{
                $returnStatus=0;  
                $msg='Oops no category is found!...';
            }
        }
        $response = array(
            'status' => $returnStatus,
            'msg' => $msg,
            'data' => $data
        );
        echo json_encode($response);
        exit;
    }

    // -- Get category_name ----
    /**
    * @return mixed
    */
    function get_category_name($category_id)
    {
        $category=$this->Mobile_api_model->getlisting(TABLE_CATEGORY,array('category_status'=>1,'category_id'=>$category_id),'category_id');
        if (count($category)) {
            foreach ($category as $key => $value) {
                $info['name']=$value['category_name'];
            }
        }
        else{
            $returnStatus=0;  
            $msg='Oops no category is found!...';
        }
        return $info['name'];
    }

    // -- Set favorite ---

    public function set_favorite() { 
        // $input_data = json_decode(trim(file_get_contents('php://input')), true);
        // $user_id = $input_data['user_id'];
        // $item_id = $input_data['item_id'];
        // $status = $input_data['status'];
        $item_id = $this->input->get_post('item_id');
        $user_id = $this->input->get_post('user_id');
        $status = $this->input->get_post('status');
        $array = $this->Mobile_api_model->get_single_row(TABLE_GCM_USERS, array('gcm_user_id'=>$user_id));
        $data_to_store = array();
        $favorite_items = $array['favorite_items'];
        if ($status == true) {
            if ($favorite_items == ""){
                $data = $item_id;
            }else{
                $data = $favorite_items.",".$item_id; 
            }
           
        } else {
            $data = "";
            $favor_arr = explode (",", $favorite_items);

            foreach ($favor_arr as $value){
                if ($value != $item_id) {
                    if ($data == ""){
                        $data = $value;
                    }else{
                        $data = $data . "," . $value;     
                    }
                    
                }
                
            }
        }
        
        $data_to_store=array('favorite_items'=>$data);

        $conditions=array('gcm_user_id'=>$user_id);

        $update = $this->Mobile_api_model->update_data(TABLE_GCM_USERS,$data_to_store,$conditions);
        if ($update){
            $msg='Your favorite_item is updated Successfully!...';
        } else{
            $msg='update failed!...';
        }

         $response = array(
          'msg' => $msg,
          'data' => ""
      );
      echo json_encode($response);
      exit;

    }

    // --- Get favorite item -----

    public function get_favorite_item(){
        $msg = "";
        $user_id = $this->input->get_post('user_id');
        $array = $this->Mobile_api_model->get_single_row(TABLE_GCM_USERS, array('gcm_user_id'=>$user_id));
        $favorite_items = $array['favorite_items'];
        $favor_arr = explode (",", $favorite_items);
        $data = array();
        foreach ($favor_arr as $value){
            $item_array=$this->Mobile_api_model->getlisting(TABLE_ITEM,array('item_status'=>1,'item_id'=>$value),'category_id','item_id');
            
            if (count($item_array)) {
                foreach ($item_array as $key => $value) {
                    $info['category_name'] = $this->get_category_name($value['category_id']);
                    $info['item_id']=$value['item_id'];
                    $info['download_name']=str_replace(' ', '_', $value['item_name']);
                    $info['item_name']=$value['item_name'];
                    $info['item_description']=$value['item_description'];
                    $info['item_file']= $value['item_url'] == "" ? base_url().ITEM_FILE_UPLOAD.$value['item_file'] : $value['item_url'];
                    $info['item_image']=base_url().ITEM_IMG_UPLOAD.$value['item_image'];
                    $info['video_url']=base_url().ITEM_VIDEO_UPLOAD.$value['item_video'];
                  
                  //  $duration = $this->load->library("duration");
                    $info['duration'] = "";
                    array_push($data, $info);
                }
            }
        }

        $response = array(
            //'status' => $returnStatus,
            'msg' => $msg,
            'data' => $data
        );
        echo json_encode($response);
        exit;        

    }

    // --- Get favorite item without response ------
    public function get_favorite_item1($user_id){
        $msg = "";
        $array = $this->Mobile_api_model->get_single_row(TABLE_GCM_USERS, array('gcm_user_id'=>$user_id));
        $favorite_items = $array['favorite_items'];
        $favor_arr = explode (",", $favorite_items);
        $data = array();
        foreach ($favor_arr as $value){
            $item_array=$this->Mobile_api_model->getlisting(TABLE_ITEM,array('item_status'=>1,'item_id'=>$value),'category_id','item_id');
            
            if (count($item_array)) {
                foreach ($item_array as $key => $value) {
                    $info['category_name'] = $this->get_category_name($value['category_id']);
                    $info['item_id']=$value['item_id'];
                    $info['download_name']=str_replace(' ', '_', $value['item_name']);
                    $info['item_name']=$value['item_name'];
                    $info['item_description']=$value['item_description'];
                    $info['item_file']= $value['item_url'] == "" ? base_url().ITEM_FILE_UPLOAD.$value['item_file'] : $value['item_url'];
                    $info['item_image']=base_url().ITEM_IMG_UPLOAD.$value['item_image'];
                    $info['video_url']=base_url().ITEM_VIDEO_UPLOAD.$value['item_video'];
                  
                  //  $duration = $this->load->library("duration");
                    $info['duration'] = "";
                    array_push($data, $info);
                }
            }
        }
        
        return $data;

    }


    // -- Get item list by category ----

    public function get_item(){
        $user_id = $this->input->get_post('user_id');
        $favorite = $this->get_favorite_item1($user_id);
        $flag = 1;
        $returnStatus = 1;
        $msg = "Category's item list!...";
        $data = array();
        $data1 = array();
        array_push($data1, array('category_name'=>"Favorites","items" => $favorite));

        if ($flag) {
            $category=$this->Mobile_api_model->getlisting(TABLE_CATEGORY,array('category_status'=>1),'category_id');
            foreach ($category as $key1 => $value1){
                $item_array=$this->Mobile_api_model->getlisting(TABLE_ITEM,array('item_status'=>1,'category_id'=>$value1['category_id']),'category_id','item_id');
                $data = array();
                if (count($item_array)) {
                    foreach ($item_array as $key => $value) {
                        $info['category_name'] = $this->get_category_name($value['category_id']);
                        $info['item_id']=$value['item_id'];
                        $info['download_name']=str_replace(' ', '_', $value['item_name']);
                        $info['item_name']=$value['item_name'];
                        $info['item_description']=$value['item_description'];
                        $info['item_file']= $value['item_url'] == "" ? base_url().ITEM_FILE_UPLOAD.$value['item_file'] : $value['item_url'];
                        // $info['item_file']= $value['item_file'];                        
                        $info['item_image']=base_url().ITEM_IMG_UPLOAD.$value['item_image'];
                        $info['video_url']=base_url().ITEM_VIDEO_UPLOAD.$value['item_video'];
                      
                      //  $duration = $this->load->library("duration");
                        $info['duration'] = "";
                        array_push($data, $info);
                    }
                }
                else{
                    $returnStatus=0;  
                    $msg='Oops no item is found in this category!...';
                }
                $category_name = $this->get_category_name($value1['category_id']);
                array_push($data1, array('category_name'=>$category_name,"items" => $data));
            }

        }
        $response = array(
            'status' => $returnStatus,
            'msg' => $msg,
            'data' => $data1
        );
        echo json_encode($response);
        exit;
    }

    // -- Get item list by category id ----
    public function get_item_by_cat_id()
    {
        $flag = 1;
        $returnStatus = 1;
        $msg = "Category's item list!...";
        $data = array();
        if (empty($this->input->get_post('category_id')) || $this->input->get_post('category_id')<=0) {
            $returnStatus = 0;
            $flag=0;
            $msg = "category id is required!...";
        }
        if ($flag) {
            $category_id=$this->input->get_post('category_id');
            $item_array=$this->Mobile_api_model->getlisting(TABLE_ITEM,array('item_status'=>1,'category_id'=>$category_id),'item_id');
            if (count($item_array)) {
                foreach ($item_array as $key => $value) {
                    $info['item_id']=$value['item_id'];
                    $info['download_name']=str_replace(' ', '_', $value['item_name']);
                    $info['item_name']=$value['item_name'];
                    $info['item_description']=$value['item_description'];
                    $info['item_file']= $value['item_url'] == "" ? base_url().ITEM_FILE_UPLOAD.$value['item_file'] : $value['item_url'];
                    $info['item_image']=base_url().ITEM_IMG_UPLOAD.$value['item_image'];
                    $info['video_url']=base_url().ITEM_VIDEO_UPLOAD.$value['item_video'];
                  
                  //  $duration = $this->load->library("duration");
                    $info['duration'] = "";
                    array_push($data, $info);
                }
            }
            else{
                $returnStatus=0;  
                $msg='Oops no item is found in this category!...';
            }
        }
        $response = array(
            'status' => $returnStatus,
            'msg' => $msg,
            'data' => $data
        );
        echo json_encode($response);
        exit;
    }
    
    function getDuration($file){

            ## open and read video file
            $handle = fopen($file, "r");

            ## read video file size
            $contents = fread($handle, filesize($file));
            fclose($handle);
            $make_hexa = hexdec(bin2hex(substr($contents,strlen($contents)-3)));
            if (strlen($contents) > $make_hexa){
                $pre_duration = hexdec(bin2hex(substr($contents,strlen($contents)-$make_hexa,3))) ;
                $post_duration = $pre_duration/1000;
                $timehours = $post_duration/3600;
                $timeminutes =($post_duration % 3600)/60;
                $timeseconds = ($post_duration % 3600) % 60;
                $timehours = explode(".", $timehours);
                $timeminutes = explode(".", $timeminutes);
                $timeseconds = explode(".", $timeseconds);
                $duration = $timehours[0]. ":" . $timeminutes[0]. ":" . $timeseconds[0];}
                return $duration;
            
  
    }

    // -- Gcm login -----

    public function gcm_login()
    {
        $returnStatus = 1;
        $msg = "Login Successfully!---";
        $token = "";
        // input parameters
        $email = $this->input->get_post('email');
        $password = $this->__encrip_password($this->input->get_post('password'));
        $is_valid_email = $this->Users_model->validate_email(TABLE_GCM_USERS,$email);
        // $is_valid = $this->Users_model->validate_gcm_user(TABLE_GCM_USERS,$email, $password);
        if (!$is_valid_email) {
            $msg= "Login faild!  Invalid email!";
            $returnStatus = 0;

            $response = array(
                'status' => $returnStatus,
                'msg' => $msg    
            );
        } else {
            $is_valid = $this->Users_model->validate_gcm_user(TABLE_GCM_USERS,$email, $password);
            if ($is_valid) {
                $token = base64_encode(random_bytes(32));
                $array = $this->Mobile_api_model->get_single_row(TABLE_GCM_USERS, array('email'=>$email));
                $user_id = $array['gcm_user_id'];
                $extra_time = $array['extra_time'];
                $username = $array['username'];

                $response = array(
                    'status' => $returnStatus,
                    'msg' => $msg,
                    'token' => $token,
                    'user_id'=>$user_id,
                    'extra_time'=>$extra_time,
                    'username' =>$username
        
                );
    
            } else {
                $returnStatus = 0;
                $msg = "Login faild!  Invalid password!";

                $response = array(
                    'status' => $returnStatus,
                    'msg' => $msg        
                );
            }
        }

        echo json_encode($response);
        exit;

    }

    // ---Gcm Delete -------

    public function gcm_delete(){
        $user_id = $this->input->get_post('user_id');
        $this->db->query("DELETE FROM ".TABLE_GCM_USERS." WHERE gcm_user_id=".$user_id);
        $msg = "User is deleted successfully!";
        $response = array(
            'status' => 1,
            'msg' => $msg
        );
        echo json_encode($response);
        exit;

    }

    // -- Gcm register -----
    public function gcm_register()
    {
        $returnStatus = 1;
        $msg = "Register Successfully!...";
        $token = "";
        // input parameters
        $username = $this->input->get_post('username');
        $email = $this->input->get_post('email');
        $password_origin = $this->input->get_post('password');
        $password = $this->__encrip_password($this->input->get_post('password'));
        $flag = 1;

        if (trim($username) == "" || trim($email) == "" || $password_origin == ""){
            $returnStatus = 0;
            $flag = 0;
            $msg = "Please fill the input feilds!";
        }

        if ($flag) {
            $returnStatus = 1;
            $is_valid = $this->Mobile_api_model->validate(TABLE_GCM_USERS, $email);
            if ($is_valid) {
                $data_to_store=array('username'=>$username,'email'=>$email, 'password'=>$password, 'user_created_date' => date('Y-m-d'));
                $this->Mobile_api_model->store_data(TABLE_GCM_USERS,$data_to_store);
                $token = base64_encode(random_bytes(32));
                $array = $this->Mobile_api_model->get_single_row(TABLE_GCM_USERS, array('email'=>$email));
                $user_id = $array['gcm_user_id'];
                $extra_time = $array['extra_time'];
                $username = $array['username'];
            }
            else{
                $returnStatus = 0;
                $msg = "Same email already exist!!";
            }
        }
        $response = array(
            'status' => $returnStatus,
            'msg' => $msg,
            'token' => $token,
            'user_id'=>$user_id,
            'extra_time'=>$extra_time,
            'username' =>$username

        );
        echo json_encode($response);
        exit;
    }

    // -- Get About us information and Terms and conditon
    public function get_about_us()
    {
        $returnStatus = 1;
        $msg = "Your About us.";
        $data = array();
        if ($returnStatus == 1) {
            $array = $this->Mobile_api_model->get_single_row(TABLE_CONTENT_MGMT,array('content_management_id'=>1));
            $data = array(
                'content_management_id' => $array['content_management_id'],
                'about_us' => $array['about_us'],
                'terms_conditions' => $array['terms_conditions']
            );
        }
        $response = array(
            'status' => $returnStatus,
            'msg' => $msg,
            'data' => $data
        );
        echo json_encode($response);
        exit;
    }
    
   // -- Update song staus as depends on flag // 0 = download and 1 = listen
    public function update_song_status()
    {
        
        $item_id = $this->input->get_post('item_id');
        $flag = $this->input->get_post('flag'); // 0 = download and 1 = listen

        if (trim($item_id) == "") {
            $returnStatus = 0;
            $flag = 0;
            $msg = "item ID is required!...";
        }
        else if (trim($flag) == "") {
            $returnStatus = 0;
            $flag = 0;
            $msg = "flag is required!...";
        }

        $array = $this->Mobile_api_model->get_single_row(TABLE_ITEM, array('item_id'=>$item_id));
        $count = 0;
        $data_to_store = array();
        if (trim($flag) == "0")
        {
            // increase count of downlaod
                $count = $array['number_of_download'] + 1; 
               $data_to_store=array('number_of_download'=>$count);
        }
        else
        {
            // increase count of listen
             $count = $array['number_of_play'] + 1;
             $data_to_store=array('number_of_play'=>$count);
        } 
        
          $conditions=array('item_id'=>$item_id);
          $this->Mobile_api_model->update_data(TABLE_ITEM,$data_to_store,$conditions);
          $msg='Song Status is updated Successfully!...';
           $response = array(
            'status' => 1,
            'msg' => $msg,
            'data' => ""
        );
        echo json_encode($response);
        exit;
    }
    
    
    // -- Search Song By Item_Name
    public function search_song()
    {
        $item_name = $this->input->get_post('item_name');
       // 
        if (trim($item_name) == "") {
           $response = array(
            'status' => 0,
            'msg' => "item_name is required!...",
            'data' => ""
        );
           echo json_encode($response);
           exit;
        }
        
        $item_array = $this->Mobile_api_model->get_all_data_with_like(TABLE_ITEM, "*","item_name", $item_name,"both",array('item_status'=>1));
       
       $data = array();
       
       if (count($item_array)) {
                foreach ($item_array as $key => $value) {
                    $info['item_id']=$value['item_id'];
                    $info['download_name']=str_replace(' ', '_', $value['item_name']);
                    $info['item_name']=$value['item_name'];
                    $info['item_description']=$value['item_description'];
                    $info['item_file']= $value['item_url'] == "" ? base_url().ITEM_FILE_UPLOAD.$value['item_file'] : $value['item_url'];
                    $info['item_image']=base_url().ITEM_IMG_UPLOAD.$value['item_image'];
                    $info['video_url']=base_url().ITEM_VIDEO_UPLOAD.$value['item_video'];
                    $info['duration'] = "";
                    $cat_array = $this->Mobile_api_model->get_single_row(TABLE_CATEGORY, array('category_id'=>$value['category_id']));
                    $info['category_id']=$cat_array['category_id'];
                    $info['category_name']=$cat_array['category_name'];
                    $info['category_image']=base_url().CATEGORY_IMG_UPLOAD.$cat_array['category_image'];
                    array_push($data, $info);
                }
            }
            else{
             
                $response = array(
                    'status' => 0,
                    'msg' => 'Oops no Song found!...',
                    'data' => ""
                  );
                 echo json_encode($response);
                 exit;
            }
            $msg='Song Foud Successfully!...';
            $response = array(
            'status' => 1,
            'msg' => $msg,
            'data' => ""
        );
        echo json_encode($data);
        exit;
            
    }
    
    // ----set duration -----
    public function set_duration(){
        $user_id = $this->input->get_post('user_id');
        $duration = $this->input->get_post('duration');
        $array = $this->Mobile_api_model->get_single_row(TABLE_EXERCISE, array('gcm_user_id'=>$user_id));
        if (count($array)) {
                $total_duration = $array['total_duration'] + $duration;
    
                $total_exercise = $array['total_exercise']+1;
                
                $week_num = $array['created_week'];
                if ($week_num == date("W")){
                    $week_duration = $array['week_duration']+$duration;
                    $week_exercise = $array['week_exercise']+1;
                }else{
                    $week_duration = $duration;
                    $week_exercise = 1;
                    $week_num = date("W");
                }
                $data_to_store=array('total_duration'=>$total_duration, 'week_duration'=>$week_duration, 'total_exercise'=>$total_exercise, 'week_exercise'=>$week_exercise, 'created_week'=>$week_num);

                $conditions=array('gcm_user_id'=>$user_id);
                $this->Mobile_api_model->update_data(TABLE_EXERCISE,$data_to_store,$conditions);
        } else{
            $total_duration = $duration;
    
            $total_exercise =  1;
            
            $week_duration = $duration;
            $week_exercise = 1;
            $week_num = date("W");

            $data_to_store=array('gcm_user_id'=>$user_id,'total_exercise'=>$total_exercise,'total_duration'=>$total_duration, 'week_exercise'=>$week_exercise, 'week_duration'=>$week_duration, 'created_week'=>$week_num);
            $this->Mobile_api_model->store_data(TABLE_EXERCISE,$data_to_store);

        }

        $msg='Exercise duration is updated Successfully!...';
         $response = array(
          'status' => 1,
          'msg' => $msg,
          'data' => ""
        );
        echo json_encode($response);
        exit;

    }

    //----- Get duration -------

    public function get_duration(){
        $user_id = $this->input->get_post('user_id');
        $week_num = date("W");
        $total_duration = 0;
        $week_duration = 0;
        $array = $this->Mobile_api_model->getlisting(TABLE_SESSION, array('user_id'=>$user_id));
        if (count($array)) {
            $total_exercise = count($array);
            foreach ($array as $key => $value) {
                $total_duration = $total_duration + $value['playing_time'];
            }

            $array1 = $this->Mobile_api_model->getlisting(TABLE_SESSION, array('user_id'=>$user_id, 'week_num'=>$week_num));
            if (count($array1)) {
                $week_exercise = count($array1);
                foreach ($array1 as $key => $value) {
                    $week_duration = $week_duration + $value['playing_time'];
                }
            }

            $response = array(
                'total_exercise' => $total_exercise,
                'total_duration' => $total_duration,
                'week_exercise' => $week_exercise,
                'week_duration' => $week_duration
            );
           
        } else {
            $response = array(
                'total_exercise' => 0,
                'total_duration' => 0,
                'week_exercise' => 0,
                'week_duration' => 0
            );
        }
          echo json_encode($response);
          exit;
 
    }

    // ----- Set Extra -------
    public function set_extra(){
        $user_id = $this->input->get_post('user_id');
        $extra_time = $this->input->get_post('extra_time');

        $data_to_store=array('extra_time'=>$extra_time);

        $conditions=array('gcm_user_id'=>$user_id);
        $update = $this->Mobile_api_model->update_data(TABLE_GCM_USERS,$data_to_store,$conditions);
        if ($update){
            $response = array(
                'status' => 1,
                'msg' => "success!",
    
            );
        } else {
            $response = array(
                'status' => 0,
                'msg' => "error!",
    
            );
        }

        echo json_encode($response);
        exit;
    }

    // -------Update User------------

    public function update_user(){
        $user_id = $this->input->get_post('user_id');
        $username = $this->input->get_post('username');
        $email = $this->input->get_post('email');
        $password = $this->__encrip_password($this->input->get_post('password'));
        $data_to_store=array('username'=>$username, 'email'=>$email, 'password'=>$password);

        $conditions=array('gcm_user_id'=>$user_id);
        $this->Mobile_api_model->update_data(TABLE_GCM_USERS,$data_to_store,$conditions);

        $response = array(
            'status' => 1,
            'msg' => "success!",

        );
        echo json_encode($response);
        exit;
    }

    // -------Reset Password------------

    public function reset_password(){
        $email = $this->input->get_post('email');

        $is_valid_email = $this->Users_model->validate_email(TABLE_GCM_USERS,$email);

        if (!$is_valid_email) {
            $msg= "reset password faild! the email doesn't exist!";
            $returnStatus = 0;

            $response = array(
                'status' => $returnStatus,
                'msg' => $msg    
            );
        } else {

            $new_password = $this->randomPassword();
            $password =$this->__encrip_password($new_password) ;

            $data_to_store=array('password'=>$password);
    
            $conditions=array('email'=>$email);
            $update = $this->Mobile_api_model->update_data(TABLE_GCM_USERS,$data_to_store,$conditions);
    
            if ($update){
                $response = array(
                    'status' => 1,
                    'msg' => "success!  please check your email inbox",
                    'new_password' => $new_password
        
                );
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => "faild!",
        
                );
            }
        }

        echo json_encode($response);
        exit;
    }

    // --------- Generate new password ------------

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    // ----- Set Session -------
    public function set_Session(){
        $session_id = $this->input->get_post('session_id');
        $user_id = $this->input->get_post('user_id');
        $item_id = $this->input->get_post('item_id');
        $playing_time = $this->input->get_post('playing_time');

        $array1 = $this->Mobile_api_model->get_single_row(TABLE_ITEM,array('item_id'=>$item_id));

        $array = $this->Mobile_api_model->get_single_row(TABLE_SESSION, array('session_id'=>$session_id));

        if ($array) {

            $data_to_store=array('playing_time'=>$playing_time);

            $conditions=array('session_id'=>$session_id);

            $result = $this->Mobile_api_model->update_data(TABLE_SESSION,$data_to_store,$conditions);

            $session_id = $array['session_id'];

            $msg = "Session is updated successfully!";

        } else {

            $date = date('Y-m-d H:i:s');

            $week_num = date("W");

            $item_name = $array1['item_name'];

            $data_to_store=array('user_id'=>$user_id,'item_id'=>$item_id,'playing_time'=>$playing_time,'timestamp' => $date, 'week_num' => $week_num, 'item_name' =>$item_name);

            $result = $this->Mobile_api_model->store_data(TABLE_SESSION,$data_to_store); 

            $array = $this->Mobile_api_model->get_single_row(TABLE_SESSION, array('timestamp'=>$date));

            $session_id = $array['session_id'];

            $msg = "Session is set successfully!";

        }



        if ($result){
            $response = array(
                'status' => 1,
                'msg' => $msg,
                'session_id' => $session_id
            );
        } else {
            $response = array(
                'status' => 0,
                'msg' => "error!",
    
            );
        }

        echo json_encode($response);
        exit;
    }
    
    

}