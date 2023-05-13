<?php
include './includes/db_connection.php';
// PHP code to save the form data into the "Inquiry" table
    // Establish a connection to the MySQL databas
    
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];

    // Insert the form data into the "Inquiry" table
    $sql = "INSERT INTO user (name, email, password, address, mobile, role) VALUES ('$name', '$email', '$password', '$address', '$tel', 'user')";

    if ($conn->query($sql) === TRUE) {
        header("Location: success-reg.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

?>