<?php

class RegistrationModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();		
    }
	
	public function register_user($user){		
		$this->db->insert('mv_users', $user);				
		echo json_encode(["Message" => "Success"]);
	}
	
	public function email_check($email){		
		$this->db->select('*');
		$this->db->from('mv_users');
		$this->db->where('user_email',$email);
		$query = $this->db->get();
		 
		if($query->num_rows() > 0){
			return false;
		}else{
			return true;
		}	 
	}	

	
}
