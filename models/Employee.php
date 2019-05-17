<?php

    class Employee {

        //Database stuff
        private $conn;
        private $table = 'employees';

        //Properties of employeee
        public $id;
        public $first_name;
        public $last_name;
        public $age;
        public $contact_number;

        //constructor with database
        public function __construct($db) {
            $this->conn = $db;
        }

        //GET employee

        public function read() {

            $query = 'SELECT * FROM '  .$this->table ;

            //prepared statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;

        }

        
        public function read_single(){
            $query = "SELECT  * FROM employees as e 
            WHERE e.id = ? 
            LIMIT 0,1";
    
            // prepare statement
            $stmt = $this->conn->prepare($query);
    
            // bind id
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
    
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // SET PROPERTIES
    
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
           
            $this->age = $row['age'];
            $this->contact_number = $row['contact_number'];
        } 
    

        //createpost

        public function create() {

            $query = 'INSERT INTO ' .       $this->table . '
            SET
                first_name = :first_name,
                last_name = :last_name,
                age = :age,
                contact_number = :contact_number';


            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
         
            //bind data
            $stmt->bindParam(':first_name',$this->first_name);
            $stmt->bindParam(':last_name',$this->last_name);
            $stmt->bindParam(':age',$this->age);
            $stmt->bindParam(':contact_number',$this->contact_number);

            //execute query
            if($stmt->execute()) {
                return true;
            } 

            //print error
            printf("Error: %s.\n", $stmt->error);

            return false;


        }



        //updatepost

        public function update() {

            $query = 'UPDATE ' .       $this->table . '
            SET
                first_name = :first_name,
                last_name = :last_name,
                age = :age,
                contact_number = :contact_number
                WHERE
                 id = :id';


            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->first_name = htmlspecialchars(strip_tags($this->first_name));
            $this->last_name = htmlspecialchars(strip_tags($this->last_name));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
            $this->id = htmlspecialchars(strip_tags($this->id));
         
            //bind data
            $stmt->bindParam(':first_name',$this->first_name);
            $stmt->bindParam(':last_name',$this->last_name);
            $stmt->bindParam(':age',$this->age);
            $stmt->bindParam(':contact_number',$this->contact_number);
            $stmt->bindParam(':id',$this->id);

            //execute query
            if($stmt->execute()) {
                return true;
            } 

            //print error
            printf("Error: %s.\n", $stmt->error);

            return false;


        }


        //Delete post
        public function delete() {
            // $query = 'DELETE FROM ' . $this->table . 'WHERE id = :id';
            $query = "DELETE FROM employees WHERE id = :id";

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind data
           
            $stmt->bindParam(':id', $this->id);


            //execute query
            if($stmt->execute()) {
                return true;
            } 

            //print error
            printf("Error: %s.\n", $stmt->error);

            return false;



        }


    }


?>