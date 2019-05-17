<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';
    
    //instantiate database and connect it
    $database = new Database();
    $db = $database->connect();

    //instantiate  obj
    
    $employee = new Employee($db);

    // get the raw posted data

    $data = json_decode(file_get_contents("php://input"));

    $employee->first_name = $data->first_name;
    $employee->last_name = $data->last_name;
    $employee->age = $data->age;
    $employee->contact_number = $data->contact_number;


    //create the post

    if($employee->create()) {

        echo json_encode(
            array ('message' => 'EmpCreated')
        );

    } else {
        echo json_encode(
            array ('message' => 'EmpnotCreated')
        );
    } 
