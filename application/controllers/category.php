<?php

class Category extends CI_Controller {
    private $form_error = FALSE;
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


    //-- Add Category -----
    public function add_category() {
        $this->load->helper('file');

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('category_name', 'Catergory Name', 'required');
            $this->form_validation->set_rules('category_description', 'Category Description', 'required');
            $this->form_validation->set_rules('category_status', 'achivements post', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-close="alert"></button><strong>', '</strong></div>');
            if (!$this->form_validation->run() == FALSE) {
                $data_to_store = array(
                    'category_name' => $this->input->post('category_name'),
                    'category_status' => $this->input->post('category_status'),
                    'category_description' => $this->input->post('category_description'),
                    'category_created_date' => date('Y-m-d'),
                    'category_image' => "",
                );
                $category_name=$this->input->post('category_name');
                $check_category = $this->Mobile_api_model->get_total_counts(TABLE_CATEGORY,array('category_name'=>$category_name));
                if ($check_category) {
                    $session_data = array(
                        'error_message' => "This Category is alredy exist."
                    );
                    $this->session->set_userdata($session_data);
                    redirect('admin/category');

                } 
                else {
                    // Upload Image -----
                    if ($_FILES['image']['tmp_name'] != "") {
                        $image_upload_response = $this->upload->uploadImage('image', CATEGORY_IMG_UPLOAD);
                        if ($image_upload_response['error'] == TRUE) {
                            $upload_img_error = $image_upload_response['msg'];
                            $session_data = array(
                                'error_message' => $upload_img_error
                            );
                            $this->session->set_userdata($session_data);
                        } else {
                            $data_to_store['category_image'] = $image_upload_response['file_name'];
                        }
                    }
                    else{
                        $data_to_store['category_image'] = 'no_image.png';
                    }
                    //if the insert has returned true then we show the flash message
                    $insert_id= $this->Mobile_api_model->store_data(TABLE_CATEGORY,$data_to_store);
                    $idarray_ios=array();
                    $setdataarray=array();
                    $message='New Category is added';
                    //$gcm_user_ios=$this->Mobile_api_model->getlisting(TABLE_GCM_USERS,array('gcm_id' => ""));
                
                    foreach ($gcm_user_ios as $key => $value) {
                      array_push($idarray_ios, $value['device_id']);
                    }
                    if (count($idarray_ios)>0) {
                      $this->Mobile_api_model->send_ios($idarray_ios,$message);
                     }
                    if ($insert_id) {
                        $session_data = array(
                            'success_message' => "Category added successfully.",
                            'error_message' => ""
                        );
                        $this->session->set_userdata($session_data);
                        redirect('admin/category');
                    }
                }
            }
        }
        
        $data['main_content'] = 'admin/category/add_category';
        $data['page_title'] = 'Add Category';
        $data['page_heading'] = 'Add Category';
        $this->load->view('includes/template', $data);
    }

    //-- Add Category -----
    public function update_category() {
    	$id = $this->uri->segment(4);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
            $this->form_validation->set_rules('category_name', 'Category Name', 'required');
            $this->form_validation->set_rules('category_status', 'Category Status', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-close="alert"></button><strong>', '</strong></div>');
            // Compare password and confirm_password value..
            if ($this->form_validation->run() && $this->form_error == FALSE) {
                $data_to_store = array(
                    'category_name' => $this->input->post('category_name'),
                    'category_status' => $this->input->post('category_status'),
                    'category_description' => $this->input->post('category_description'),
                );
                $check_category = $this->Mobile_api_model->get_total_counts(TABLE_CATEGORY,$this->input->post('category_name'));

                // Upload Image -----
                if ($_FILES['image']['tmp_name'] != "") {
                    $image_upload_response = $this->upload->uploadImage('image', CATEGORY_IMG_UPLOAD);
                    if ($image_upload_response['error'] == TRUE) {
                        $upload_img_error = $image_upload_response['msg'];
                        $session_data = array(
                            'error_message' => $upload_img_error
                        );
                        $this->session->set_userdata($session_data);
                    } else {
                        $data_to_store['category_image'] = $image_upload_response['file_name'];
                    }
                }

                //if the insert has returned true then we show the flash message
                if ($this->Mobile_api_model->update_data(TABLE_CATEGORY,$data_to_store,array('category_id'=>$id))) {
                    $session_data = array(
                        'success_message' => "Category updated successfully."
                    );
                    $this->session->set_userdata($session_data);
                    redirect('admin/category');
                }
            }
        }
        //category data
        $data['category'] = $this->Mobile_api_model->get_single_row(TABLE_CATEGORY,array('category_id'=>$id));
        // if invalid category id than redirect to category list page
        if (!isset($data['category']['category_id'])) {
            redirect('admin/category');
            exit;
        }
        $data['main_content'] = 'admin/category/add_category';
        $data['page_title'] = 'Update Category';
        $data['page_heading'] = 'Update Category';
        $this->load->view('includes/template', $data);
    }

    // -- Remove Image -----
    public function removeCategoryImage() {
        $id = $this->input->post('id');
        $data_to_store['category_image'] = 'no_image.png';
        if ($id > 0) {
            $this->Mobile_api_model->update_data(TABLE_CATEGORY,$data_to_store,array('category_id'=>$id));
        }
        return true;
    }

    // -- Delete Category -----
    public function delete_category() {
        $id = $this->uri->segment(4);
        $data['category'] = $this->Mobile_api_model->get_single_row(TABLE_CATEGORY,array('category_id'=>$id));
        // if invalid category id than redirect to category list page
        if (!isset($data['category']['category_id'])) {
            redirect('admin/category');
            exit;
        }
        // Delete category by ID		
        $this->db->query("DELETE FROM ".TABLE_CATEGORY." WHERE category_id=".$id);
        $this->db->query("DELETE FROM ".TABLE_ITEM." WHERE category_id=".$id);
        $session_data = array(
            'success_message' => "category deleted successfully."
        );
        $this->session->set_userdata($session_data);
        redirect('admin/category');
    }
	
	//-- Main category list page -----
	public function manage_category(){
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
        $db_data = $this->Search_model->get_category_list($params);
        $data['page'] = $page;
        $data['search_with_date'] = 1;
        $array = array(
            'u.category_id' => 'ID',
            'u.category_name' => 'Category Name',
        );
        $data['search_columns'] = $array;
        $data['list_url'] = base_url()."admin/category";
        $data['category'] = $db_data['records'];        
        $data['total_records'] = $db_data['total_records'];        
        $data['number_of_pages'] = $db_data['num_of_pages'];                
        $data['main_content'] = 'admin/category/manage_category';
        $data['page_title'] = 'Category';
        $data['page_heading'] = 'Manage Category';
        $_POST=array();
        $this->load->view('includes/template', $data);
	}
}
