<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include database and object files
require('../config/database.php');
require('../objects/feeder.php');

$database = new Database();
$db = $database->getConnection();
$feeding = new Feeding($db);

// Make sure data is not empty
if($feeding->addFeed() && !empty($_GET["start_hour"]) && !empty($_GET["start_min"]) && !empty($_GET["end_hour"]) && !empty($_GET["end_min"]) && !empty($_GET["delay"])) {
    // 201 Created
    http_response_code(201);
    echo json_encode(array("message" => "Feed schedule was successfully created."));
}
else {
    // 404 Bad Request
    http_response_code(404);
    echo json_encode(array("report" => "Failed to create feeding scheduler."));
}
?>
