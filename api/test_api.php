<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'Api.php';

$api = new API();

if($_GET["action"] == 'fetch_all'){
	$data = $api->fetch_all();
}

echo json_encode($data);

?>