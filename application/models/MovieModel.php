<?php

class MovieModel extends CI_Model {
	
	private $APIUrl = 'https://api.themoviedb.org/3/';
	private $movieAPIKey = MOVIE_API_KEY;	

    public function __construct() {
        parent::__construct();        	
    }
	
	public function getPopularMovies(){
				
		$fields = array(
			'api_key' => $this->movieAPIKey,
		);
		
		//url-ify the data for the POST
		$fields_string = $this->prepareData($fields);
		
		//send cURL request
		$ch = curl_init();
		$json = $this->sendCURLRequest($fields, $fields_string, $ch, "movie/popular");
		//close connection
		curl_close($ch);
		return $json;
	}
	
	public function searchMovies($post) {		
		
        $fields = array(
			'api_key' => $this->movieAPIKey,
			'query' => $_POST['searchText'],
		);
		
		//url-ify the data for the POST
		$fields_string = $this->prepareData($fields);
		
		//send cURL request
		$ch = curl_init();
		$json = $this->sendCURLRequest($fields, $fields_string, $ch, "search/movie");
		//close connection
		curl_close($ch);
		return $json;
    }
	
	public function prepareData($fields){
		$fields_string = "";		
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		return rtrim($fields_string, '&');
	}
	
	public function sendCURLRequest($fields, $fields_string, $ch, $url){
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $this->APIUrl.$url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute post
		$result = curl_exec($ch);
		return $result;
	}
	
	public function getWatchList($user_id){
		$this->db->select('*');
        $this->db->from('mv_watchlist');
        $this->db->where("user_id", $user_id);
        if ($result = $this->db->get()) {
            return $result->result_array();
        }
        return null;
	}
	
	public function watchlist_check($data){
		$this->db->select('*');
		$this->db->from('mv_watchlist');
		$this->db->where('user_id',$data['user_id']);
		$this->db->where('movie_id',$data['movie_id']);
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return true;
		}
		
		return false;			
	}
	
	public function addToWatchList($data){  		
		$this->db->insert('mv_watchlist', $data);				
		echo json_encode(["Message" => "Success"]);				
	}
	
	public function deleteFromWatchList($data){
		$this->db->where('user_id', $data['user_id']);
		$this->db->where('movie_id', $data['movie_id']);
		$this->db->delete('mv_watchlist');					
		echo json_encode(["Message" => "Success"]);				
	}
	
}
