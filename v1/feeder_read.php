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
require_once('../objects/feeder.php');

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initialize object
$feed = new Feeding($db);
$feed->getFeed();

if ($feed->id != null) {
    $feeding_arr = array(
        "start_hour" => $feed->start_hour,
        "start_min" => $feed->start_min,
        "end_hour" => $feed->end_hour,
        "end_min" => $feed->end_min,
        "delay" => $feed->delay
    );

    http_response_code(200); 
    echo json_encode($feeding_arr);
}

else {
    http_response_code(404); 
    echo json_encode(array("message" => "Feeding scheduler is not found on database."));
}
?>
