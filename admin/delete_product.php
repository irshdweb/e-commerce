<?php
include '../includes/db_connection.php';

// Process the delete request if the product ID is provided
if (isset($_GET["id"])) {
    $productID = $_GET["id"];

    // Prepare and execute the SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the product list page
    header("Location: products.php");
    exit();
}

// Close the database connection
$conn->close();
?>
