<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';
    
    //instantiate database and connect it
    $database = new Database();
    $db = $database->connect();

    //instantiate  obj
    
    $employee = new Employee($db);

    //
    $result = $employee->read();

    //get row count
    $num = $result->rowCount();

    //chck posts
    if($num>0){
        $employees_arr = array();
        $employees_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $employee_item = array(
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'age' => $age,
                'contact_number' => $contact_number 
            );

            //push to data
            array_push($employees_arr['data'], $employee_item);
        }

        //turn to json and output
        echo json_encode($employees_arr);

    }else{
        //when no emps data available
        echo json_encode(
            array('message' => 'No posts found')
        );
    }

?>

