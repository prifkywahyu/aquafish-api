<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once('../objects/PHPMailer/src/Exception.php');
    require_once('../objects/PHPMailer/src/PHPMailer.php');
    require_once('../objects/PHPMailer/src/SMTP.php');

    $conn = mysqli_connect("localhost","fedmeeco_aquafish","Jakarta*13","fedmeeco_aquafish");
    date_default_timezone_set("Asia/Jakarta");

if($conn) {
    $temper = $_GET["suhuy"];
    $turbid = $_GET["keruh"];
    $watery = $_GET["water"];

    $normal     = "Normal";
    $loweTemper = "Low Temperature";
    $highTemper = "High Temperature";
    $typeTurbid = "Turbid Water";
    $lowerLevel = "Low Volume";
    $highsLevel = "High Volume";

    $query_temper = "INSERT INTO sensor (type, value, status) VALUES ('101', ?, ?)";
    $query_turbid = "INSERT INTO sensor (type, value, status) VALUES ('202', ?, ?)";
    $query_watery = "INSERT INTO sensor (type, value, status) VALUES ('303', ?, ?)";

    if((!empty($temper) && $temper >= 20 && $temper <= 30) && (!empty($turbid) && $turbid >= 0 && $turbid <= 14) && (!empty($watery) && $watery >= 14 && $watery <= 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $normal);
        $test->bind_param("ss", $turbid, $normal);
        $gety->bind_param("ss", $watery, $normal);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($temper) && $temper >= 20 && $temper <= 30) && (!empty($turbid) && $turbid < 0) && (!empty($watery) && $watery < 14)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $normal);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $lowerLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($temper) && $temper >= 20 && $temper <= 30) && (!empty($turbid) && $turbid > 14) && (!empty($watery) && $watery > 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $normal);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $highsLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid >= 0 && $turbid <= 14) && (!empty($temper) && $temper < 20) && (!empty($watery) && $watery < 14)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $loweTemper);
        $test->bind_param("ss", $turbid, $normal);
        $gety->bind_param("ss", $watery, $lowerLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid >= 0 && $turbid <= 14) && (!empty($temper) && $temper > 30) && (!empty($watery) && $watery > 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $highTemper);
        $test->bind_param("ss", $turbid, $normal);
        $gety->bind_param("ss", $watery, $highsLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid < 0) && (!empty($temper) && $temper < 20) && (!empty($watery) && $watery >= 14 && $watery <= 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $loweTemper);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $normal);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid > 14) && (!empty($temper) && $temper > 30) && (!empty($watery) && $watery >= 14 && $watery <= 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $highTemper);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $normal);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid >= 0 && $turbid <= 14) && (!empty($temper) && $temper >= 20 && $temper <= 30) && (!empty($watery) && $watery < 14)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $normal);
        $test->bind_param("ss", $turbid, $normal);
        $gety->bind_param("ss", $watery, $lowerLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid >= 0 && $turbid <= 14) && (!empty($temper) && $temper >= 20 && $temper <= 30) && (!empty($watery) && $watery > 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $normal);
        $test->bind_param("ss", $turbid, $normal);
        $gety->bind_param("ss", $watery, $highsLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid >= 0 && $turbid <= 14) && (!empty($temper) && $temper < 20) && (!empty($watery) && $watery >= 14 && $watery <= 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $loweTemper);
        $test->bind_param("ss", $turbid, $normal);
        $gety->bind_param("ss", $watery, $normal);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid >= 0 && $turbid <= 14) && (!empty($temper) && $temper > 30) && (!empty($watery) && $watery >= 14 && $watery <= 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $highTemper);
        $test->bind_param("ss", $turbid, $normal);
        $gety->bind_param("ss", $watery, $normal);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid < 0) && (!empty($temper) && $temper <= 30 && $temper >= 20) && (!empty($watery) && $watery >= 14 && $watery <= 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $normal);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $normal);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($turbid) && $turbid > 14) && (!empty($temper) && $temper <= 30 && $temper >= 20) && (!empty($watery) && $watery >= 14 && $watery <= 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $normal);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $normal);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($temper) && $temper < 20) && (!empty($turbid) && $turbid < 0) && (!empty($watery) && $watery < 14)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $loweTemper);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $lowerLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    elseif((!empty($temper) && $temper > 30) && (!empty($turbid) && $turbid > 14) && (!empty($watery) && $watery > 23)) {
        $stmt = $conn->prepare($query_temper);
        $test = $conn->prepare($query_turbid);
        $gety = $conn->prepare($query_watery);

        $stmt->bind_param("ss", $temper, $highTemper);
        $test->bind_param("ss", $turbid, $typeTurbid);
        $gety->bind_param("ss", $watery, $highsLevel);

        $stmt->execute();
        $test->execute();
        $gety->execute();

        http_response_code(200);
        echo "Sensor data was successfully created";
    }
    else {
        http_response_code(400);
        echo "Failed to create sensor data";
    }
}
?>
