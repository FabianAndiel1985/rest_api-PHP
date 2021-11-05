<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once './database.php';
include_once './employee.php';


$database = new Database();

$db = $database->getConnection();
  

$employee = new Employee($db);

$receivedData = json_decode(file_get_contents("php://input"));
    
$allowedKeys = ["id","firstname","lastname"];

function checkKeyValidity($receivedData, $allowedKeys) {
        $valueContained = true;
        foreach ($receivedData as $key => $value){
            if(in_array($key, $allowedKeys , $strict = false)){
            $valueContained = true;
            }
    
            else {
                $valueContained = false;
                return false;
            }
        }
        return $valueContained;
}

function checkValueIsEmpty($receivedData)  {  
        foreach($receivedData as $value){
            if(empty($value)){
                    return false;
            }
        }
        return true;
}


$keyValidity = checkKeyValidity($receivedData, $allowedKeys);

$valueIsEmpty =  checkValueIsEmpty($receivedData);



if(
    $keyValidity && $valueIsEmpty
){

    
    foreach($receivedData as $key => $value){
        $employee->$key = $receivedData->$key;
    }


    if($employee->update($receivedData)){

        http_response_code(201);

        echo json_encode(array("message" => "employee was created"));
    }
      
    else{  

        http_response_code(503);

        echo json_encode(array("message" => "Unable to create employee."));
    }
  }
  
// else{
  
//     // set response code - 400 bad request
//     http_response_code(400);
  
//     // tell the user
//     echo json_encode(array("message" => "employee data wasn`t full"));
// }


