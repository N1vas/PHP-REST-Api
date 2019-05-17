<?php

class Database{

    //Database parameters
    private $host = 'localhost';
    private $db_name = 'employee_details';
    private $username = 'root';
    private $password = '';
    private $conn;

    //Database connection
    public function connect(){

        $this->conn = null;

        try{

            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,$this->username, $this->password);
           // $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo 'Connection Error' . $e->getMessage();
        }

        return $this->conn;
    }



}

?>


