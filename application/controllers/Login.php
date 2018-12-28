<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('LoginModel');
    }
	
	public function index()
	{
		$movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : "";
		$data['page_title'] = 'Login';
        $this->load->view('header', $data);
		$this->load->view('app/login',[
            'movie_id' => $movie_id,
        ]);
		$this->load->view('footer');
	}
	
	public function userLoggedIn() {        
		echo $this->LoginModel->userLoggedIn();
    }
	
	public function do_login(){
 
        $user = array(			
			'user_email' => $this->input->post('user_email'),
			'user_password' => sha1($this->input->post('user_password')),			
        );        
		
		$login_check = $this->LoginModel->login_user($user);
		 
		if(!$login_check){
			echo json_encode(["Message" => "Error"]);
		}else{
			$userdata = array(
				'user_id' => $login_check['user_id'],
				'user_email' => $login_check['user_email'],
				'user_role' => $login_check['user_role'],				
			);
			$this->session->set_userdata($userdata);
		    echo json_encode(["Message" => "Success"]);  			
		}
				
	}
	
	public function do_logout(){
		$this->session->sess_destroy();
		echo json_encode(["Message" => "Success"]);
	}
	
}
