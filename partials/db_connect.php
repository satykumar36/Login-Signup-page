<?php 
$server="localhost";
$username="admin";
$password="mysql123";
$database="users";

$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    die("Error".mysqli_connect_error());
}
else{
    // echo "Connected";
}



?>
