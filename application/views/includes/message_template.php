<?php

   echo validation_errors();	
									  
  if($this->session->userdata('success_message')){
	echo '<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
			<strong>Success!</strong> '.$this->session->userdata('success_message').'
		  </div>';
	$success_message = array(
		'success_message' => ""
	);
	$this->session->unset_userdata($success_message);
  }			  

  
  if($this->session->userdata('error_message')){
	echo '<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<strong>Error!</strong> '.$this->session->userdata('error_message').'
		  </div>';
	$error_message = array(
		'error_message' => ""
	);
	$this->session->unset_userdata($error_message);
  }			  


?>