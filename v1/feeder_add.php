<?php
// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include database and object files
require('../config/database.php');
require('../objects/feeder.php');

// Initialize database and object
$database = new Database();
$db = $database->getConnection();
$feeding = new Feeding($db);

// Business logic
if ($feeding->addFeed() && !empty($_GET["start_hour"]) && !empty($_GET["start_min"]) && !empty($_GET["end_hour"]) && !empty($_GET["end_min"]) && !empty($_GET["delay"])) {
    http_response_code(201);
    echo json_encode(array("message" => "Feeding scheduler was successfully created."));
}
else {
    http_response_code(400);
    echo json_encode(array("report" => "Failed to create feeding scheduler."));
}
?>