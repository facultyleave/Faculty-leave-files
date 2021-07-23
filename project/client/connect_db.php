<?php
$servername="localhost";
$username="root";
$password="";
$database="leave_db";

//create connection

$connection = new mysqli($servername,$username,$password,$database);

//check connection

if($connection->connect_error){
    die("connection is unsuccessful".$connection->connect_error);
}
echo "connected succesfully";
?>