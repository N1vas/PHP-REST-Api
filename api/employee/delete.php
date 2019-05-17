<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    //set id to update
    $employee->id = $data->id;



    //delete the post

    if($employee->delete()) {

        echo json_encode(
            array ('message' => 'Empdeleted')
        );

    } else {
        echo json_encode(
            array ('message' => 'Emp not Deleted')
        );
    } 
