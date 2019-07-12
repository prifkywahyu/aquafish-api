<?php
class Database{
 
    // Specify your own database credentials
    private $host = "localhost";
    private $db_name = "id10042464_sensor";
    private $username = "id10042464_aquafish";
    private $password = "aquafish2019";
    public $conn;
 
    // Get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            } catch(PDOException $exception) {
                echo "Connection error " . $exception->getMessage();
                }
 
        return $this->conn;
    }
}
?>