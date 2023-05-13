<?php
include '../includes/db_connection.php';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $discounted_price = $_POST["discounted_price"];
    $qty = $_POST["qty"];
    $category = $_POST["category"];

    // Upload images to the server
    $targetDirectory = "uploads/";
    $images = array();

    // Check if any files were uploaded
    if (!empty($_FILES["images"]["name"])) {
        $totalFiles = count($_FILES["images"]["name"]);

        // Loop through each file
        for ($i = 0; $i < $totalFiles; $i++) {
            $fileName = basename($_FILES["images"]["name"][$i]);
            $targetFilePath = $targetDirectory . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $fileSize = $_FILES["images"]["size"][$i];
            $maxFileSize = 10 * 1024 * 1024; // 5 MB (adjust as needed)

            // Check if the file size exceeds the limit
            if ($fileSize > $maxFileSize) {
                // Handle the error or display a message to the user
                echo "Error: File size exceeds the limit.";
                exit;
            }

            // Check if the file is a valid image
            $allowTypes = array("jpg", "JPG", "jpeg", "png", "gif");
            if (in_array($fileType, $allowTypes)) {
                // Upload the file to the server
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], $targetFilePath)) {
                    $images[] = $fileName;
                } else {
                    // Handle the upload error or display a message to the user
                    echo "Error: Failed to upload the file.";
                    exit;
                }
            } else {
                // Handle the error or display a message to the user
                echo "Error: Invalid file type.";
                exit;
            }
        }
    }

    // Prepare and execute the SQL statement to insert data into the products table
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, discounted_price, qty, category, images) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddiss", $name, $description, $price, $discounted_price, $qty, $category, implode(',', $images));
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Redirect to a success page
    header("Location: success.php");
    exit();
}
?>


