<?php
//db credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'holy-spirit-website-db');

//connect with the database
function connect(){
    $connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($connect -> connect_errno){
        echo "Failed to connect to MySQL: " . $connect -> connect_error;
        exit();
    }

    return $connect;
}

$con = connect();

?>