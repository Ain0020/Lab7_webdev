<?php
class Database
{
    public $host = "localhost";
    public $db_name = "lab_7";
    public $username = "root";
    public $password = "";
    public $conn;

    // Method to get the database connection
    public function getConnection()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            // echo "Connected successfully";
        }

        return $this->conn;
    }
}