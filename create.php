<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './database.php';
include_once './employee.php';


$database = new Database();

$db = $database->getConnection();
  

$employee = new Employee($db);

$perparedStatement = $employee->create();

// get posted data
$data = json_decode(file_get_contents("php://input"));
  
if(
    !empty($data->firstname) &&
    !empty($data->lastname) 
){
  
    // set product property values
    $employee->firstname = $data->firstname;
    $employee->lastname = $data->lastname;

  
    if($employee->create()){
  

        http_response_code(201);
  
  
        echo json_encode(array("message" => "employee was created"));
    }
  
    // if unable to create the product, tell the user
    else{
  

        http_response_code(503);
  

        echo json_encode(array("message" => "Unable to create employee."));
    }

  }
  
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "employee data wasn`t full"));
}


