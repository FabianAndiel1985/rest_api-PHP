<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once './database.php';
include_once './employee.php';
  
// instantiate database and product object
$database = new Database();
//connection aktivieren
$db = $database->getConnection();
  
// initialize object
$employee = new Employee($db);
  
// read products will be here
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
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No employees found.")
    );
}
