<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_db";

$conn = new mysqli($servername, $username, $password, $database);

// if($conn){       // error because mysqli constructor does not return true or false—instead, it returns a mysqli object
if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}
// else{
//     echo "Connection Successful";
// }

// $conn->close();

?>