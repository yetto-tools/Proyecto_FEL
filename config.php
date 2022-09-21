<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'Proyect_FEL');
 
/* Attempt to connect to MySQL database */
// $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// // Check connection
// if($db === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }

// define('USER', 'root');
// define('PASSWORD', '');
// define('HOST', 'localhost');
// define('DATABASE', 'Proyect_FEL');
 
// try {
//     $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
// } catch (PDOException $e) {
//     exit("Error: " . $e->getMessage());
// }

$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()){
    printf("%s\n", mysqli_connect_error());
    exit();
}




?>