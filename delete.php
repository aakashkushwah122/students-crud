<?php
    include 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $conn->real_escape_string($_POST['id']);

        $sql = "DELETE FROM students WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo 'User deleted successfully!';
        } else {
            echo 'Error deleting user: ' . $conn->error;
        }
    }
?>