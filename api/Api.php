<?php

class API {
	
	 private $conn = '';

	 public function __construct() {
		$this->DB_conn();
	 }

	 public function DB_conn()
	 {
		$this->conn = new PDO("mysql:host=localhost;dbname=geekaby1_movies", "geekaby1_movies", "!X2GkR]1y8Cr");
	 }
	
	 //can be accessed via http://movies.geekabyte-testing.co.za/api/test_api.php?action=fetch_all
	 public function fetch_all(){
		$query = "SELECT * FROM mv_watchlist ORDER BY watchlist_id";
		$stmt = $this->conn->prepare($query);
		if($stmt->execute()){
		   while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			   $data[] = $row;
		   }
		   return $data;
		}
	 }

}
