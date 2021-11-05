<?php

$pathParameter = $_SERVER['PATH_INFO'];

$query = str_replace( array( '\'', '"',
',',';', '<', '>' ), ' ', $pathParameter);

$routes = [
    "/getAll"=>[],
    ""=>[],
    ""=>[],
    ""=>[],
    ""=>[]
    ];

    // include_once './create.php';    
     include_once './update.php';