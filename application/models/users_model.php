<?php

class Users_model extends CI_Model {

	//-- Check for login -----
    public function validate($table_name,$user_name, $password) {
        $this->db->where('username', $user_name);
        $this->db->where('password', $password);
        $query = $this->db->get($table_name);
        if ($query->num_rows() == 1) {
            return true;
        }
        else{
        	return false;
        }
    }

    //----Check for login email------
    public function validate_email($table_name,$email) {
        $this->db->where('email', $email);
        $query = $this->db->get($table_name);
        if ($query->num_rows() == 1) {
            return true;
        }
        else{
        	return false;
        }
    }

    //---- Check for Gcm User login ----
    public function validate_gcm_user($table_name,$email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get($table_name);
        if ($query->num_rows() == 1) {
            return true;
        }
        else{
        	return false;
        }
    }

}
