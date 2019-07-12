<?php
// Required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
header("Refresh: 5");

// Include database and object files
include_once ('../api/config/database.php');
include_once ('../api/objects/sensor.php');
 
// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initialize object
$sensor = new Sensor($db);

$sensor->type = isset($_GET['type']) ? $_GET['type'] : die();
$sensor->read();

if($sensor->type!=null){
    $sensors_arr = array(
        "value" => $sensor->value,
        "status" => $sensor->status,
    );
 
    http_response_code(200); 
    echo json_encode($sensors_arr);
}

else {
    http_response_code(404);
 
    echo json_encode(
        array("message" => "Sensor data is not found")
    );
}
?>