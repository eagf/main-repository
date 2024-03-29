<?php
// DBConfig.php
class Database {
    private $host = "localhost";
    private $db_name = "libeer-vastgoed-db";
    private $username = "root";
    private $password = "";
    public $conn;

    // Verbinding maken met de database
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Database connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}


