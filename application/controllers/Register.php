<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('RegistrationModel');
    }
	
	public function index()
	{
		$data['page_title'] = 'Register';
        $this->load->view('header', $data);		
		$this->load->view('app/register');
		$this->load->view('footer');
	}
	
	public function register_user(){
 
        $user = array(
			'full_name' => $this->input->post('full_name'),
			'user_email' => $this->input->post('user_email'),
			'user_password' => sha1($this->input->post('user_password')),
			'user_role' => 'customer',			
        );        
		
		$email_check = $this->RegistrationModel->email_check($user['user_email']);
		 
		if($email_check){
		    $this->RegistrationModel->register_user($user);		  
		}else{
			echo json_encode(["Message" => "E-mail already exists"]);
		}
				
	}
	
}
