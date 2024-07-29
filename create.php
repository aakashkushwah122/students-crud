<?php
    include "connection.php";

    // Debugging output
    // if ($conn->ping()) {
    //     echo "Connection is alive.";
    // } else {
    //     echo "Connection is not available.";
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $file = $conn->real_escape_string($_POST['file']);

    $query = "INSERT INTO students (name, email, address, file) VALUES('$name', '$email', '$address', '$file')";
    $result = $conn->query($query);

    if($result){
        echo "user create successfullly";
    }else{
        echo "Error Creating User: " .$conn->error;
    }
}  

// real_escape_string() = This function is used to create a legal SQL string that can be used in an SQL statement. -->

// PHP Wordpress
// JavaScript, ECMAScript, jQuery, 
// Java 
?>