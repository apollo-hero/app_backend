<?php

class Items extends CI_Controller {
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
    	parent::__construct();
    	if(!$this->session->userdata('is_logged_in')){
	        redirect('admin/index');
        }
    }
    function updatevideoorder(){
			//$ids = $this->Video_model->updatevideoorder($_POST);
			$data_to_store = array('sort_order' => $this->input->post('value'));

			$updated=$this->Mobile_api_model->update_data(TABLE_ITEM,$data_to_store,array('item_id'=>$this->input->post('data-id')));
						echo $updated; die();

		}
	
    //-- Add Items -----
    public function add_item() {
        $this->load->helper('file');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $_POST['image'] = $_FILES['image']['name'];
            $_POST['item_file'] = $_FILES['item_file']['name'];
            //form validation
            $this->form_validation->set_rules('item_name', 'Items Name', 'required');
            $this->form_validation->set_rules('item_description', 'Item Description', 'required');
            $this->form_validation->set_rules('image', 'Image', 'required');
            $this->form_validation->set_rules('item_file', 'Audio File', 'required');
            $this->form_validation->set_rules('category_id', 'Category Id', 'required|numeric');
            $this->form_validation->set_rules('item_status', 'Items Status', 'required|numeric');
            //$this->form_validation->set_rules('image', 'Image', 'callback_file_selected_test');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-close="alert"></button><strong>', '</strong></div>');
            // Compare password and confirm_password value..

            if (!$this->form_validation->run() == FALSE && !empty($_FILES['image']['name']) && !empty($_FILES['item_file']['name']) ) {
                $data_to_store = array(
                    'item_name' => $this->input->post('item_name'),
                    'category_id' => $this->input->post('category_id'),
                    'item_status' => $this->input->post('item_status'),
                    'item_description' => $this->input->post('item_description'),
                    // 'item_url' => $this->input->post('item_url'),
                    'item_created_date' => date('Y-m-d'),
                    'item_image' => "",
                    'item_file' => "",
                    'item_video' => "",
                );
                // Upload Image -----
                if ($_FILES['image']['tmp_name'] != "") {
                    $image_upload_response = $this->upload->uploadImage('image', ITEM_IMG_UPLOAD);
                    if ($image_upload_response['error'] == TRUE) {
                        $upload_img_error = $image_upload_response['msg'];
                        $session_data = array(
                            'error_message' => $upload_img_error
                        );
                        $this->session->set_userdata($session_data);
                    } else {
                        $data_to_store['item_image'] = $image_upload_response['file_name'];
                    }
                }
                //file upload
                if ($_FILES['item_file']['name']!='') {
                    $file_upload_error = $this->upload->uploadAudio('item_file', ITEM_FILE_UPLOAD);
                    if ($file_upload_error['error'] == TRUE) {
                        $upload_img_error = $file_upload_error['msg'];
                        $session_data = array(
                            'error_message' => $upload_img_error
                        );
                        $this->session->set_userdata($session_data);
                    } 
                    else {
                        $data_to_store['item_file'] = $file_upload_error['file_name'];
                      
                    }
                }
                //Video upload
               /* if ($_FILES['item_video']['name']!='') {
                    $file_upload_error = $this->upload->uploadVideo('item_video', ITEM_VIDEO_UPLOAD);
                    
                    if ($file_upload_error['error'] == TRUE) {
                        $upload_img_error = $file_upload_error['msg'];
                        $session_data = array(
                            'error_message' => $upload_img_error
                        );
                        $this->session->set_userdata($session_data);
                    } 
                    else {
                        $data_to_store['item_video'] = $file_upload_error['file_name'];
                    }
                    
                          
                }*/
                //if the insert has returned true then we show the flash message
                $insert_id=$this->Mobile_api_model->store_data(TABLE_ITEM,$data_to_store);

                $idarray_ios=array();
                $setdataarray=array();
                $message='New '.$this->input->post("item_name").' is added into '.$this->Mobile_api_model->getsinglecolumevalue_array(TABLE_CATEGORY,array('category_id'=>$this->input->post('category_id')),'category_name');
                //$gcm_user_ios=$this->Mobile_api_model->getlisting(TABLE_GCM_USERS,array('gcm_id' => ""));
                foreach ($gcm_user_ios as $key => $value) {
                    array_push($idarray_ios, $value['device_id']);
                }
                 if (count($idarray_ios)>0) {
                    $this->Mobile_api_model->send_ios($idarray_ios,$message);
                }
               
                if ($insert_id) {
                    $session_data = array(
                        // 'success_message' => $message
                        'success_message' => "Items added successfully."
                    );
                    $this->session->set_userdata($session_data);
                    // redirect('admin/items/add');
                    redirect('admin/items');
                }
            }
        }

        // $session_data = array(
        //     // 'success_message' => $message
        //     'error_message' => "please check input field."
        // );
        // $this->session->set_userdata($session_data);

        $data['category']=$this->Mobile_api_model->getlisting(TABLE_CATEGORY,array('category_status'=>1));
        $data['main_content'] = 'admin/items/add_Items';
        $data['page_title'] = 'Add Item';
        $data['page_heading'] = 'Add Item';
        $this->load->view('includes/template', $data);
    }

    


    //-- update Items -----
    public function update_item() {
    	$id = $this->uri->segment(4);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('item_name', 'Item Name', 'required');
            $this->form_validation->set_rules('category_id', 'Category Id', 'required|numeric');
            $this->form_validation->set_rules('item_status', 'Item Status', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-close="alert"></button><strong>', '</strong></div>');
            // Compare password and confirm_password value..
            // var_dump($this->form_validation->run());exit();
            if ($this->form_validation->run() ) {
                $data_to_store = array(
                    'item_name' => $this->input->post('item_name'),
                    'category_id' => $this->input->post('category_id'),
                    'item_status' => $this->input->post('item_status'),
                    'item_description' => $this->input->post('item_description'),
                    // 'item_url' => $this->input->post('item_url'),
                );
                // Upload Image -----
                if ($_FILES['image']['tmp_name'] != "") {
                    $image_upload_response = $this->upload->uploadImage('image', ITEM_IMG_UPLOAD);
                    if ($image_upload_response['error'] == TRUE) {
                        $upload_img_error = $image_upload_response['msg'];
                        $session_data = array(
                            'error_message' => $upload_img_error
                        );
                        $this->session->set_userdata($session_data);
                    } 
                    else {
                        $data_to_store['item_image'] = $image_upload_response['file_name'];
                    }
                }
                //file upload
                if ($_FILES['item_file']['name']!='') {
                    $file_upload_error = $this->upload->uploadAudio('item_file', ITEM_FILE_UPLOAD);
                    if ($file_upload_error['error'] == TRUE) {
                        $upload_img_error = $file_upload_error['msg'];
                        $session_data = array(
                            'error_message' => $upload_img_error
                        );
                        $this->session->set_userdata($session_data);
                    } 
                    else {
                        $data_to_store['item_file'] = $file_upload_error['file_name'];
                    }
                }
                //Video upload
               /* if ($_FILES['item_video']['name']!='') {
                    $file_upload_error = $this->upload->uploadVideo('item_video', ITEM_VIDEO_UPLOAD);
                    
                    if ($file_upload_error['error'] == TRUE) {
                        $upload_img_error = $file_upload_error['msg'];
                        $session_data = array(
                            'error_message' => $upload_img_error
                        );
                        $this->session->set_userdata($session_data);
                    } 
                    else {
                        $data_to_store['item_video'] = $file_upload_error['file_name'];
                    }
                    
                          
                }*/
                //if the insert has returned true then we show the flash message
                $updated=$this->Mobile_api_model->update_data(TABLE_ITEM,$data_to_store,array('item_id'=>$id));

                if ($updated) {
                    $session_data = array(
                        'success_message' => "Items updated successfully."
                    );
                    $this->session->set_userdata($session_data);
                    redirect('admin/items');
                }
            }
        }
        //items data
        $data['items'] = $this->Mobile_api_model->get_single_row(TABLE_ITEM,array('item_id'=>$id));
        // if invalid Items id than redirect to Items list page
        if (!isset($data['items']['item_id'])) {
            redirect('admin/items');
            exit;
        }
        $data['category']=$this->Mobile_api_model->getlisting(TABLE_CATEGORY,array('category_status'=>1));
        $data['main_content'] = 'admin/items/add_Items';
        $data['page_title'] = 'Update Items';
        $data['page_heading'] = 'Update Items';
        $this->load->view('includes/template', $data);
    }

    // -- Remove Image -----
    public function removeItemImage() {
        $id = $this->input->post('id');
        $data_to_store['item_image'] = 'no_image.png';
        if ($id > 0) {
            $this->Mobile_api_model->update_data(TABLE_ITEM,$data_to_store,array('item_id'=>$id));
        }
        return true;
    }
    // -- Delete Items -----
    public function delete_item() {
        $id = $this->uri->segment(4);
        $data['items'] = $this->Mobile_api_model->get_single_row(TABLE_ITEM,array('item_id'=>$id));
        // if invalid Items id than redirect to Items list page
        if (!isset($data['items']['item_id'])) {
            redirect('admin/items');
            exit;
        }
        // Delete Items by ID		
        $this->db->query("DELETE FROM ".TABLE_ITEM." WHERE item_id=".$id);
        $session_data = array(
            'success_message' => "item deleted successfully."
        );
        $this->session->set_userdata($session_data);
        redirect('admin/items');
    }
	
	//-- Main Items list page -----
	public function manage_item(){
		$page = $this->input->get_post('page');        
        $page = $page >= 1 ? $page:1;
        $record_per_page = 100000;
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
        $db_data = $this->Search_model->get_items_list($params);
        $data['page'] = $page;
        $data['search_with_date'] = 1;
        $array = array(
            'u.item_id' => 'ID',
            'u.item_name' => 'Item Name',
        );
        $data['search_columns'] = $array;
        $data['list_url'] = base_url()."admin/items";
        $data['items'] = $db_data['records'];        
        $data['total_records'] = $db_data['total_records'];        
        $data['number_of_pages'] = $db_data['num_of_pages'];                
        $data['main_content'] = 'admin/items/manage_item';
        $data['page_title'] = 'Items';
        $data['page_heading'] = 'Manage Items';
        $_POST=array();
        $this->load->view('includes/template', $data);
	}	
}
