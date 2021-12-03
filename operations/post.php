<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'models/employee.php';

$database = new Database();

$db = $database->getConnection();
  
$employee = new Employee($db);

$perparedStatement = $employee->create();

$data = json_decode(file_get_contents("php://input"));
  
if(
    !empty($data->firstname) &&
    !empty($data->lastname) 
){
  
    $employee->firstname = $data->firstname;
    $employee->lastname = $data->lastname;

  
    if($employee->create()){
  

        http_response_code(201);
  
  
        echo json_encode(array("message" => "employee was created"));
    }
  
    else{
  

        http_response_code(503);
  
        echo json_encode(array("message" => "Unable to create employee."));
    }

  }
  
else{
  
  
    http_response_code(400);
  

    echo json_encode(array("message" => "employee data wasn`t full"));
}


