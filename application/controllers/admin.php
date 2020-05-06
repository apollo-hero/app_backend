<?php

class Admin extends CI_Controller {
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
	    parent::__construct();
    }

	
	public function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('admin/dashboard');
        }else{
			$data = array(
				'main_content' => 'admin/login',
				'page_title' => 'Admin - Login',
				'page_heading' => 'Login',
			);
			$this->load->view('admin/login',$data); 
        }
	}
	
	
    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	
	
	//-- DASHBOARD -----
	function dashboard()
	{
		if(!$this->session->userdata('is_logged_in')){
	        redirect('admin/index');
        }
		$data = array(
			'main_content' => 'admin/dashboard',
			'page_title' => 'Dashboard',
			'page_heading' => 'Dashboard',
		);
		$data['latest_category']=$this->Mobile_api_model->getlisting(TABLE_CATEGORY,array(),0,"DESC",5);
		$data['latest_items']=$this->Mobile_api_model->getlisting(TABLE_ITEM,array(),0,"DESC",5);
		$data['total_user']=$this->Mobile_api_model->get_total_counts(TABLE_GCM_USERS);
		$data['total_item']=$this->Mobile_api_model->get_total_counts(TABLE_ITEM);
		$data['total_category']=$this->Mobile_api_model->get_total_counts(TABLE_CATEGORY);
		$data['total_session']=$this->Mobile_api_model->get_total_counts(TABLE_SESSION);

		$this->load->view('includes/template', $data);  
	}
	
	function validate_credentials()
	{ 
		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));
		$is_valid = $this->Users_model->validate(TABLE_ADMIN_USER,$user_name, $password);
		if($is_valid)
		{
			$role=$this->Mobile_api_model->getsinglecolumevalue_array(TABLE_ADMIN_USER,array('username'=>$user_name),'user_type_id');
			$data = array(
				'is_logged_in' => TRUE,
				'user_name' => $user_name,
				'role'=>$role
			);
			$this->session->set_userdata($data);
			redirect('admin/dashboard');
		}
		else
		{
			$data = array(
				'message_error' => TRUE,
				'page_title' => 'Login',	
				'main_content' => 'admin/login',
				'page_heading' => 'Login'
			);
			$this->load->view('admin/login', $data);  
		}
	}		
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}

	
	public function send_notifications()
	{
		if(!$this->session->userdata('is_logged_in')){
	        redirect('admin/index');
        }
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
		    $data_to_store = array(
		        'send_notifications'=>$this->input->get_post('send_notifications'),
		    );
			$idarray=array();
			$setdataarray=array();
			$idarray_ios=array();
			$message=$this->input->get_post('send_notifications');
	       
	        $gcm_user_ios=$this->Mobile_api_model->getlisting(TABLE_GCM_USERS,array('gcm_id' => ""));
	       
                 foreach ($gcm_user_ios as $key => $value) {
                    array_push($idarray_ios, $value['device_id']);
                }
                 if (count($idarray_ios)>0) {
                    $this->Mobile_api_model->send_ios($idarray_ios,$message);
                }
	        $session_data = array(
	                'success_message' => "Notifications send successfully."
	            );
	        $this->session->set_userdata($session_data);
	        unset($_POST);
	            redirect('admin/send_notifications');
		}
		$data['page_heading'] = 'Send Notifications';
		$data['main_content'] = 'admin/send_notifications';
		$data['page_title'] = 'Send Notifications';
		$data['list_url'] = base_url()."admin/send_notifications";
		$this->load->view('includes/template', $data);
	}
	
	public function about_us()
	{
	    if ($this->input->server('REQUEST_METHOD') === 'POST') {
	        $data_to_store = array(
	            'about_us'=>$this->input->get_post('about_us'),
	        );
	        $id= $this->input->get_post('content_management_id');
	        if (count($id)>0) {
	            $this->db->query("UPDATE ".TABLE_CONTENT_MGMT." SET about_us='".$this->input->get_post('about_us')."'");
	            $session_data = array(
	                    'success_message' => "about us updated successfully."
	                );
	            $this->session->set_userdata($session_data);
	            unset($_POST);
	            redirect('admin/about_us');
	        }
	        else{
	            unset($_POST);
	            redirect('admin/about_us');
	        }
	    }
	    $data['page_heading'] = 'About Us';
	    $db_data = $this->Mobile_api_model->get_about_us();
	    $data['main_content'] = 'admin/about_us';
	    $data['page_title'] = 'About Us';
	    $data['content_management'] = $db_data;
	    $data['list_url'] = base_url()."admin/about_us";
	    $this->load->view('includes/template', $data);
	}

	public function terms_and_conditions()
	{
	    if ($this->input->server('REQUEST_METHOD') === 'POST') {
	        $data_to_store = array(
	            'about_us'=>$this->input->get_post('about_us'),
	        );
	        $id= $this->input->get_post('content_management_id');
	        if (count($id)>0) {
	            $this->db->query("UPDATE ".TABLE_CONTENT_MGMT." SET terms_conditions='".$this->input->get_post('terms_conditions')."'");
	            $session_data = array(
	                    'success_message' => "Terms and Conditions us updated successfully."
	                );
	            $this->session->set_userdata($session_data);
	            unset($_POST);
	            redirect('admin/terms_and_conditions');
	        }
	        else{
	            unset($_POST);
	            redirect('admin/terms_and_conditions');
	        }
	    }
	    $data['page_heading'] = 'Terms & Conditions';
	    $db_data = $this->Mobile_api_model->get_about_us();
	    $data['main_content'] = 'admin/terms_and_conditions';
	    $data['page_title'] = 'Terms & Conditions';
	    $data['content_management'] = $db_data;
	    $data['list_url'] = base_url()."admin/terms_and_conditions";
	    $this->load->view('includes/template', $data);
	}
	
	//-- Main user list page -----
	public function manage_user(){
		$page = $this->input->get_post('page');        
        $page = $page >= 1 ? $page:1;
        $record_per_page = 10000;
        $params = array(            
            'page' => $page,
            'record_per_page' => $record_per_page,                    
            'search_column' => $this->input->get_post('search_column'),    
            'search_text' => $this->input->get_post('search_text'),    
            'from_date' => $this->input->get_post('from_date'),    
            'to_date' => $this->input->get_post('to_date'),    
            'sort_by' => $this->input->get_post('sort_by'),    
            'sort_order' => $this->input->get_post('sort_order'),                
        );
        $db_data = $this->Search_model->get_user_list($params);
        $data['page'] = $page;
        $data['search_with_date'] = 1;
        $array = array(
            'u.gcm_user_id' => 'ID',
            'u.username' => 'User Name',
        );
        $data['search_columns'] = $array;
        $data['list_url'] = base_url()."admin/users";
        $data['user'] = $db_data['records'];        
        $data['total_records'] = $db_data['total_records'];        
        $data['number_of_pages'] = $db_data['num_of_pages'];                
        $data['main_content'] = 'admin/user/manage_user';
        $data['page_title'] = 'User';
        $data['page_heading'] = 'Manage User';
        $_POST=array();
        $this->load->view('includes/template', $data);
	}

	// -- Delete User -----
	public function delete_user() {
		$id = $this->uri->segment(4);
		$data['user'] = $this->Mobile_api_model->get_single_row(TABLE_GCM_USERS,array('gcm_user_id'=>$id));
		// if invalid category id than redirect to category list page
		if (!isset($data['user']['gcm_user_id'])) {
			redirect('admin/users');
			exit;
		}
		// Delete category by ID		
		$this->db->query("DELETE FROM ".TABLE_GCM_USERS." WHERE gcm_user_id=".$id);
		// $this->db->query("DELETE FROM ".TABLE_ITEM." WHERE gcm_user_id=".$id);
		$session_data = array(
			'success_message' => "user deleted successfully."
		);
		$this->session->set_userdata($session_data);
		redirect('admin/users');
	}

	// -------------- sessions -------------

	public function sessions(){
		$page = $this->input->get_post('page');        
        $page = $page >= 1 ? $page:1;
        $record_per_page = 10000;
        $params = array(            
            'page' => $page,
            'record_per_page' => $record_per_page,                    
            'search_column' => $this->input->get_post('search_column'),    
            'search_text' => $this->input->get_post('search_text'),    
            'from_date' => $this->input->get_post('from_date'),    
            'to_date' => $this->input->get_post('to_date'),    
            'sort_by' => $this->input->get_post('sort_by'),    
            'sort_order' => $this->input->get_post('sort_order'),                
        );
        $db_data = $this->Search_model->get_session_list($params);
        $data['page'] = $page;
        $data['search_with_date'] = 1;
        $array = array(
            'u.session_id' => 'ID',
            'u.user_id' => 'User ID',
        );
        $data['search_columns'] = $array;
        $data['list_url'] = base_url()."admin/sessions";
        $data['session'] = $db_data['records'];        
        $data['total_records'] = $db_data['total_records'];        
        $data['number_of_pages'] = $db_data['num_of_pages'];                
        $data['main_content'] = 'admin/sessions';
        $data['page_title'] = 'Session';
        $data['page_heading'] = 'Session';
        $_POST=array();
        $this->load->view('includes/template', $data);
	}

	// -- Delete Session -----
	public function delete_session() {
		$id = $this->uri->segment(4);
		$data['session'] = $this->Mobile_api_model->get_single_row(TABLE_SESSION,array('session_id'=>$id));
		// if invalid category id than redirect to category list page
		if (!isset($data['session']['session_id'])) {
			redirect('admin/sessions');
			exit;
		}
		// Delete category by ID		
		$this->db->query("DELETE FROM ".TABLE_SESSION." WHERE session_id=".$id);
		// $this->db->query("DELETE FROM ".TABLE_ITEM." WHERE gcm_user_id=".$id);
		$session_data = array(
			'success_message' => "Session deleted successfully."
		);
		$this->session->set_userdata($session_data);
		redirect('admin/sessions');
	}
	
}
