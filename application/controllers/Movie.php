<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('MovieModel');
    }
	
	public function index()
	{
		$movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : "";
		$data['page_title'] = 'Movie';
        $this->load->view('header', $data);
		$this->load->view('app/movie',[
            'movie_id' => $movie_id,
        ]);
		$this->load->view('footer');
	}
	
	public function getMovieDetails($movie_id) {        
		echo json_encode($this->MovieModel->getMovieDetails($movie_id));
    }
	
}
