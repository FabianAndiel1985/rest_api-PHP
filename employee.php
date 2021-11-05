<?php 

class Employee {
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    private $conn;
    private $table_name = "employees";

    public $firstname;
    public $lastname;
    

    
   public function read(){
        
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name;
      
        $stmt = $this->conn->prepare($query);
      
        $stmt->execute();
        return $stmt;
    }


public function create(){
 
    $stmt = $this->conn->prepare("INSERT INTO ".$this->table_name." (id,firstname,lastname,created_at) VALUES (null,:firstname, :lastname,null)");
  
    // sanitize
    $this->firstname=htmlspecialchars(strip_tags($this->firstname));
    $this->lastname=htmlspecialchars(strip_tags($this->lastname));
  
    // bind values
    $stmt->bindParam(":firstname", $this->firstname);
    $stmt->bindParam(":lastname", $this->lastname);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;     
}


public function update($receivedData){


    $stmt = $this->conn->prepare("UPDATE ".$this->table_name." SET firstname = :firstname, lastname = :lastname WHERE id = :id");

    // sanitize

     foreach($receivedData as $key => $value){
            $this->$key=htmlspecialchars(strip_tags($this->$key));
            $stmt->bindParam(":".$key, $this->$key);
     }
     
    // execute query
   
    if($stmt->execute()){
        return true;
    }
    return false;  

}

}