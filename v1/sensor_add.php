<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../objects/PHPMailer/src/Exception.php');
require_once('../objects/PHPMailer/src/PHPMailer.php');
require_once('../objects/PHPMailer/src/SMTP.php');

$conn = mysqli_connect("localhost", "fedmeeco_aquafish", "Jakarta*13", "fedmeeco_aquafish");
date_default_timezone_set("Asia/Jakarta");

if ($conn) {
    $turbidity = $_GET["turbid"];
    $temperature = $_GET["temper"];
    $water_level = $_GET["water"];

    $normal = "Normal";
    $low_level = "Low Volume";
    $high_level = "High Volume";
    $type_turbid = "Turbid Water";
    $low_temperature = "Low Temperature";
    $high_temperature = "High Temperature";

    $query_turbidity = "INSERT INTO sensor (type, value, status) VALUES ('202', ?, ?)";
    $query_temperature = "INSERT INTO sensor (type, value, status) VALUES ('101', ?, ?)";
    $query_water_level = "INSERT INTO sensor (type, value, status) VALUES ('303', ?, ?)";

    if (empty($turbidity) || empty($temperature) || empty($water_level)) {
        http_response_code(400);
        echo "All sensor data must be required";
    }
    elseif (!empty($turbidity) && !empty($temperature) && !empty($water_level)) {
        $prep_turbidity = $conn->prepare($query_turbidity);
        $prep_temperature = $conn->prepare($query_temperature);
        $prep_water_level = $conn->prepare($query_water_level);

        $temp_status_turbidity = "";
        $temp_status_temperature = "";
        $temp_status_water_level = "";

        if ($turbidity < 0 || $turbidity > 14) {
            $temp_status_turbidity = $type_turbid;
        }
        elseif ($temperature < 20) {
            $temp_status_temperature = $low_temperature;
        }
        elseif ($temperature > 30) {
            $temp_status_temperature = $high_temperature;
        }
        elseif ($water_level < 14) {
            $temp_status_water_level = $low_level;
        }
        elseif ($water_level > 23) {
            $temp_status_water_level = $high_level;
        }
        else {
            $temp_status_turbidity = $normal;
            $temp_status_temperature = $normal;
            $temp_status_water_level = $normal;
        }

        $prep_turbidity->bind_param("ss", $turbidity, $temp_status_turbidity);
        $prep_temperature->bind_param("ss", $temperature, $temp_status_temperature);
        $prep_water_level->bind_param("ss", $water_level, $temp_status_water_level);

        $prep_turbidity->execute();
        $prep_temperature->execute();
        $prep_water_level->execute();

        http_response_code(201);
        echo "Sensor data was successfully created";
    }
    else {
        http_response_code(400);
        echo "Failed to create sensor data";
    }
}
?>