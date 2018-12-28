<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('MovieModel');
    }
	
	public function index()
	{
		$data['page_title'] = 'ABC Movies';
        $this->load->view('header', $data);		
		$this->load->view('app/index',[
            'popular_movies' => json_decode($this->MovieModel->getPopularMovies()),
        ]);
		$this->load->view('footer');
	}
	
	public function searchMovies() {        
		echo $this->MovieModel->searchMovies($_POST);
    }
	
	public function getMovieDetails() {        
		echo $this->MovieModel->getMovieDetails($this->input->post('movieid'));		
    }
}
