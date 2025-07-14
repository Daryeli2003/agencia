<?php

class Database {
    private $host = 'localhost'; 
    private $db_name = 'agencia';    
    private $username = 'root';   
    private $password = '';      
    
    protected $conn;

    public function getConnection() {
        $this->conn = null; 

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8';
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {

            throw new Exception('Error de Conexión: ' . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>