<?php
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type:application/json");
include_once 'database.php';
include_once 'api\light\Read.php';
#require "data.php";

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();



$method = $_SERVER['REQUEST_METHOD'];
handleVerb($method);


function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}

function handleVerb($verb) {
	switch ($verb) {
		case 'GET':
			
			$data['command']=$_GET['command'];
			if($data['command'] == "all"){
				//include_once 'api/light/read_all.php';
				$readObj = new Read();
				$readObj->readAllLights();
			break;
			}elseif($data['command'] == "array1"){
				$readObj = new Read();
				$readObj->readOneLightArray(1);
			break;
			}
			$data['verb sent'] = "GET";
			return response(200,"Request Found",$data);
			break;
		case 'POST':
			$data['command']=$_GET['command'];
			$data['verb sent'] = "POST";
			return response(200,"Request Found",$data);
			break;
		case 'DELETE':
			$data['command']=$_GET['command'];
			$data['verb sent'] = "DELETE";
			return response(200,"Request Found",$data);
			break;
		case 'PUT':
			$data['command']=$_GET['command'];
			$data['verb sent'] = "PUT";
			return response(200,"Request Found",$data);
			break;
		default:
			return response(400,"Invalid Request!",NULL);
			break;
	}
}