<?php

$routes = [
    "/read"=>['/read.php'],
    "/update"=>['/update.php'],
    "/post"=>['/post.php'],
    "/delete"=>['/delete.php']
    ];

    
if(array_key_exists( $_SERVER['PATH_INFO'], $routes)) {
    include_once './operations'.$_SERVER['PATH_INFO'].'.php';
} 

else{
    echo "path doesn`t exist";
   
}



