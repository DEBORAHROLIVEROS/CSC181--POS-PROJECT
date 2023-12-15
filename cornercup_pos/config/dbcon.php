<?php

define('DB_SEVER',"localhost");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"");
define('DB_DATABASE',"pos_system_php");

$conn = mysqli_connect(DB_SEVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}

?>
