<?php
include 'connection.php';


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Retrieve and sanitize POST data
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $file = $conn->real_escape_string($_POST['file']);

    // Prepare the SQL query
    $query = "UPDATE students SET name='$name', email='$email', address='$address', file='$file' WHERE id='$id'";
    
    // Execute the query
    if ($conn->query($query)) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

// Close the connection
$conn->close();

?>