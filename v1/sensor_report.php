<?php
// Required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
header("Refresh: 5");

// Include database and object files
require_once('../config/database.php');
require_once('../objects/sensor.php');
 
// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initialize object
$sensor = new Sensor($db);

$sensor->type = isset($_GET['type']) ? $_GET['type'] : die();
$stmt = $sensor->gets();
$num = $stmt->rowCount();

if($num>0){
    $sensors_arr=array();
    $sensors_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $sensor_item=array(
            "type" => $type,
            "value" => $value,
            "status" => $status,
            "created" => $created,
        );
 
        array_push($sensors_arr["records"], $sensor_item);
    }
 
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