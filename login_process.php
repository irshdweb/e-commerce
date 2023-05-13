<?php
session_start(); // Start the session (if not already started)

include './includes/db_connection.php';

// Get the values submitted from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute the SQL query
$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Login successful
    $row = $result->fetch_assoc();
    $_SESSION['role'] = $row['role']; 
    $_SESSION['user_id'] = $row['id']; 
    $_SESSION['address'] = $row['address']; 
    $_SESSION['phone'] = $row['mobile']; 
    $_SESSION['user_name_'] = $row['name']; 

    // Redirect the user based on their role
    if ($_SESSION['role'] == 'user') {
        header("Location: user");
    } elseif ($_SESSION['role'] == 'admin') {
        header("Location: admin");
    } else {
        // Invalid role
        echo "Invalid role.";
    }
} else {
    // Login failed
    echo "Invalid email or password.";
}

$conn->close(); // Close the database connection
?>
