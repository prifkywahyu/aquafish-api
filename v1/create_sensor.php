<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include database and object files
include_once ('../api/config/database.php');
include_once ('../api/objects/sensor.php');

$database = new Database();
$db = $database->getConnection();
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d H:i:s');

$sensor = new Sensor($db);
$data = json_decode(file_get_contents("php://input"));
 
// Make sure data is not empty
if(
    !empty($data->type) &&
    !empty($data->value) &&
    !empty($data->status)
){
    $sensor->type = $data->type;
    $sensor->value = $data->value;
    $sensor->status = $data->status;
    $sensor->created = $date;
 
    if($sensor->create()){
        // 201 created
        http_response_code(201);
        echo json_encode(array("message" => "Sensor was successfully created."));
    }
    else{ 
        // 503 service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create sensor data."));
    }
}
else{ 
    // 400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Data is required and mandatory."));
}
?>