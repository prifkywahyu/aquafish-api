<?php

class Feeding{
    // Database connection and table name
    private $conn;
    private $table_name = "feeder";

    public $id;
    public $start_hour;
    public $start_min;
    public $end_hour;
    public $end_min;
    public $delay;

    public function __construct($db){
        $this->conn = $db;
    }

	function getFeed(){
        $query = "SELECT * FROM feeder ORDER BY id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->start_hour = $row['start_hour'];
        $this->start_min = $row['start_min'];
        $this->end_hour = $row['end_hour'];
        $this->end_min = $row['end_min'];
        $this->delay = $row['delay'];
    }

    function addFeed(){
        $query = "INSERT INTO feeder (start_hour, start_min, end_hour, end_min, delay) VALUES (:start_hour, :start_min, :end_hour, :end_min, :delay)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':start_hour', $getOneHr);
        $stmt->bindParam(':start_min', $getOneMn);
        $stmt->bindParam(':end_hour', $getTwoHr);
        $stmt->bindParam(':end_min', $getTwoMn);
        $stmt->bindParam(':delay', $getDelay);

        if (isset($_GET["start_hour"]) && !empty($_GET["start_hour"])) {
            $getOneHr = $_GET["start_hour"];
        }
        if (isset($_GET["start_min"]) && !empty($_GET["start_min"])) {
            $getOneMn = $_GET["start_min"];
        }
        if (isset($_GET["end_hour"]) && !empty($_GET["end_hour"])) {
            $getTwoHr = $_GET["end_hour"];
        }
        if (isset($_GET["end_min"]) && !empty($_GET["end_min"])) {
            $getTwoMn = $_GET["end_min"];
        }
        if (isset($_GET["delay"]) && !empty($_GET["delay"])) {
            $getDelay = $_GET["delay"];
        }

        // Executed query
        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }
}
?>
