<?php
session_start();
include "connect_db.php";

//taking input into vriables

$username=$_POST['uname'];
$password=$_POST['pass'];

var_dump($username);
echo "<br>";
var_dump($password);
echo "<br>";
//querying the database admin

$sql="select * from employees";
$result=$connection->query($sql);
echo "<br>";
var_dump($result);
echo "<br>";
while($row = $result->fetch_assoc()) {
         var_dump($row['username'],$row['password'],$row['id']);
         echo "<br>";
         var_dump($row['Dept']);
         echo "<br>";
         if(($username == $row["username"]) && ($password == $row["password"]))
         {
             echo "<br><h4>hello if condition is right</h4><br>";
             echo "<br>";
             $_SESSION['clientuser'] = $username;
             $_SESSION['dept'] = $row['Dept'];
             //header('location:home.php');
         }
         else {
          header('location:client_index.php?err='.urlencode('Username Or Password Incorrect'));
        }
}


?>