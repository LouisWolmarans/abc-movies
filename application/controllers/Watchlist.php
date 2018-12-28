<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Watchlist extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('MovieModel');
    }
	
	public function index()
	{
		$movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : "";
		$data['page_title'] = 'Watchlist';
        $this->load->view('header', $data);
		$this->load->view('app/watchlist',[
            'watchlist' => $this->MovieModel->getWatchList($this->session->userdata('user_id')),
        ]);
		$this->load->view('footer');
	}
	
	public function is_on_watchlist(){
 
        $data = array(			
			'user_id' => $this->session->userdata('user_id'),
			'movie_id' => $this->input->post('movieid'),
        );        
		
		$watchlist_check = $this->MovieModel->watchlist_check($data);
		 
		if($watchlist_check){
			echo json_encode(["Message" => "true"]);
		}else{
		    echo json_encode(["Message" => "false"]);  			
		}
				
	}
	
	public function addToWatchList(){
 
        $data = array(			
			'user_id' => $this->session->userdata('user_id'),
			'movie_id' => $this->input->post('movieid'),
			'movie_title' => $this->input->post('movie_title'),
			'movie_overview' => $this->input->post('movie_overview'),
			'poster_path' => $this->input->post('poster_path'),
        );        
		
		$watchlist_check = $this->MovieModel->addToWatchList($data);
				
	}
	
	public function deleteFromWatchList(){
 
        $data = array(			
			'user_id' => $this->session->userdata('user_id'),
			'movie_id' => $this->input->post('movieid'),			
        );        
		
		$this->MovieModel->deleteFromWatchList($data);
				
	}
	
}
