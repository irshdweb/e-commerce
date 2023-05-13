<?php
session_start();

// Redirect if user is not logged in or not a user role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php"); 
    exit(); 
}

// Retrieve form data
$userID = $_POST['user_id'];
$name = $_POST['user_name'];
$address = $_POST['address'];
$telephone = $_POST['telephone'];

// Retrieve the serialized cart items and decode them into an array
$cartItems = json_decode($_POST['cart_items'], true);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myshop";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the INSERT statement
    $sql = "INSERT INTO orders (date, items_details, user_id, name, address, telephone, status)
            VALUES (NOW(), :items_details, :user_id, :name, :address, :telephone, 'process')";

    // Prepare the items details
    $itemsDetails = '';
    foreach ($cartItems as $item) {
        $itemsDetails .= "'[ " . $item['price'] . ", " . $item['url'] . ", " . $item['name'] . ", " . $item['quantity'] . "]', ";
    }
    $itemsDetails = rtrim($itemsDetails, ", "); // Remove the trailing comma and space

    // Execute the INSERT statement
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':items_details', $itemsDetails);
    $stmt->bindParam(':user_id', $userID);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->execute();

    // Redirect to a success page or display a success message
    header("Location: success.php");
    exit();
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
    exit();
}
?>
