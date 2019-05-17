
<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Employee.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog employee object
  $employee = new Employee($db);

  //get id 

  $employee->id = isset($_GET['id']) ? $_GET['id'] : die();

  // get list
  $employee->read_single();

  //create array
  $employee_arr =array(
    'id' => $employee->id,
    'first_name' => $employee->first_name,
    'last_name' => $employee->last_name,
    
    'age' => $employee->age,
    'contact_number' => $employee->contact_number
  );

  // make json
  print_r(json_encode($employee)); 