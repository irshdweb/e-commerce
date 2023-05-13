<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET["id"]) && isset($_GET["order"])) {
    $orderId = $_GET["id"];
    $status = $_GET["order"];

    include '../includes/db_connection.php';

    // Update the status of the order in the "orders" table
    $sql = "UPDATE orders SET status = '$status' WHERE id = $orderId";
    $conn->query($sql);

    // Close the database connection
    $conn->close();

    // Redirect back to the order detail page
    header("Location: orders.php");
    exit();
} else {
    echo "Invalid request";
}
?>
