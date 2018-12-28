<?php

class LoginModel extends CI_Model {	

    public function __construct() {
        parent::__construct();        	
    }
	
	public function userLoggedIn(){		
		if($this->session->userdata('user_id') == ''){
			echo "false";
		}else{
			echo "true";
		}		
	}
	
	public function login_user($user){
				
		$this->db->select('*');
		$this->db->from('mv_users');
		$this->db->where('user_email',$user['user_email']);
		$this->db->where('user_password',$user['user_password']);
		
		if($query = $this->db->get()){
			return $query->row_array();
		}else{
			return false;
		}	
	}
	
}
