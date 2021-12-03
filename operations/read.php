<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once 'database.php';
include_once 'models/employee.php';


$database = new Database();

$db = $database->getConnection();
  

$employee = new Employee($db);
  

$perparedStatement = $employee->read();



$numOfRows = $perparedStatement->rowCount();


$employeeArray = array();

if($numOfRows>0) {
    
    while ($row = $perparedStatement->fetch()){
        extract($row);

        $employee = array(
            "id"=>$id,
            "firstname"=>$firstname,
            "lastname"=>$lastname,
            "created_at"=>$created_at
        );
        
        array_push( $employeeArray, $employee);
    }

    http_response_code(200);
 
 echo json_encode($employeeArray);
}


else{
   
    http_response_code(404);
  
    
    echo json_encode(
        array("message" => "No employees found.")
    );
}
