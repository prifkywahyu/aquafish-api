<?php
class Sensor{
 
    // Database connection and table name
    private $conn;
    private $table_name = "sensors";
 
    public $id;
    public $type;
    public $value;
    public $status;
    public $created;
 
    // Constructor as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	function read(){
        $query = "SELECT * FROM $this->table_name WHERE type = ? ORDER BY created DESC LIMIT 0,1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->type);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->id = $row['id'];
        $this->type = $row['type'];
        $this->value = $row['value'];
        $this->status = $row['status'];
        $this->created = $row['created'];
    }
    
    function gets(){
        $query = "SELECT * FROM $this->table_name WHERE type = ? ORDER BY created ASC";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->type);
        $stmt->execute();

        return $stmt;
    }
    
    function create(){
        $query = "INSERT INTO ". $this->table_name ." SET type=:type, value=:value, status=:status, created=:created";
        $stmt = $this->conn->prepare($query);
     
        $this->type=htmlspecialchars(strip_tags($this->type));
        $this->value=htmlspecialchars(strip_tags($this->value));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->created=htmlspecialchars(strip_tags($this->created));
     
        // Binding values
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":created", $this->created);
     
        // Executed query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}
?>