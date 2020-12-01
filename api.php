<?php
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type:application/json");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once 'database.php';
#require "data.php";

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();



$method = $_SERVER['REQUEST_METHOD'];
handleVerb($method);


function response($status, $status_message, $data)
{
	header("HTTP/1.1 " . $status);

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	$json_response = json_encode($response);
	echo $json_response;
}
/*
** GET COMMANDS
*/
//@param $command is uppercase
function handleGetVerb($command)
{
	include_once 'api\light\Read.php';
	$readObj = new Read();
	switch ($command) {
		case 'ALL':
			$readObj->readAllLights();
			break;
		case 'ARRAY1':
			$readObj->readOneLightArray(1);
			break;
		default:
			return response(400, "Invalid Request! GET command: \"$command\" not found.", NULL);
			break;
	}
}
/*
** PUT COMMANDS
*/
//@param $command is uppercase
function handlePutVerb($command)
{
include_once 'api\light\Write.php';
	$data = json_decode(file_get_contents("php://input"));
	$light_array_num = $data->array;	
	$writeObj = new Write();
	switch ($command) {
		case 'ALLON':
			if($writeObj->turnOnLightArray($light_array_num)){
				echo json_encode(
					array('message' => "lights for array: $light_array_num on")
				);
			}else{
				echo json_encode(
					array('message' => "error turning lights on for array: $light_array_num, no rows matched")
				);
			}
			break;
		case 'ALLOFF':
			if($writeObj->turnOffLightArray($light_array_num)){
				echo json_encode(
					array('message' => "lights for array: $light_array_num off")
				);
			}else{
				echo json_encode(
					array('message' => "error turning lights off for array: $light_array_num, no rows matched")
				);
			}
			break;
		case 'TURNON':
			$light_num = $data->lightNum;
			if($writeObj->turnOnSingleLight($light_array_num, $light_num)){
				echo json_encode(
					array('message' => "light $light_num for array: $light_array_num on")
				);

			}else{
				echo json_encode(
					array('message' => "error turning light $light_num on for array: $light_array_num, no rows matched")
				);
			}			
			break;
		case 'TURNOFF':
			$light_num = $data->lightNum;
			if($writeObj->turnOffSingleLight($light_array_num, $light_num)){
				echo json_encode(
					array('message' => "light $light_num for array: $light_array_num off")
				);

			}else{
				echo json_encode(
					array('message' => "error turning light $light_num off for array: $light_array_num, no rows matched")
				);
			}			
			break;
		default:
			return response(400, "Invalid Request! PUT command: \"$command\" not found.", NULL);
			break;
	}
}

function handleVerb($verb)
{
	$command = strtoupper($_GET['command']);
	switch ($verb) {
		case 'GET':
			handleGetVerb($command);
			break;
		case 'POST':
			$data['command'] = $command;
			$data['verb sent'] = "POST";
			return response(200, "Request Found", $data);
			break;
		case 'DELETE':
			$data['command'] = $_GET['command'];
			$data['verb sent'] = "DELETE";
			return response(200, "Request Found", $data);
			break;
		case 'PUT':
			handlePutVerb($command);
			break;
		default:
			return response(400, "Invalid Request!", NULL);
			break;
	}
}
