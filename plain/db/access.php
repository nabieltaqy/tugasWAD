<?php
namespace DB;

class ConnectionDB {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new \mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed to database");
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>