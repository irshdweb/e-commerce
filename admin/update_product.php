<?php
// Connection details to your MySQL server
include '../includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productID = $_POST["product_id"];
    $productName = $_POST["name"];
    $productDescription = $_POST["description"];
    $productPrice = $_POST["price"];
    $productDiscountedPrice = $_POST["discounted_price"];
    $productQty = $_POST["qty"];
    $productCategory = $_POST["category"];

    // Check if a new image is uploaded
    $totalFiles = count($_FILES["images"]["name"]);
    if ($totalFiles > 0 && !empty($_FILES["images"]["name"][0])) {
        // Remove existing images from the uploads folder
        $sql = "SELECT images FROM products WHERE product_id = " . $productID;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $existingImages = $row["images"];

            // Remove existing images from the uploads folder
            $imageUrls = explode(",", $existingImages);
            foreach ($imageUrls as $imageUrl) {
                $imagePath = "../uploads/" . $imageUrl;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        // Upload new images
        $imageNames = array();

        for ($i = 0; $i < $totalFiles; $i++) {
            $tmpFilePath = $_FILES["images"]["tmp_name"][$i];
            $fileName = $_FILES["images"]["name"][$i];

            // Check if the file size is within the allowed limit (10MB)
            $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
            if ($_FILES["images"]["size"][$i] > $maxFileSize) {
                echo "File size exceeds the limit of 10MB.";
                exit;
            }

            if ($tmpFilePath != "") {
                $newFilePath = "./uploads/" . $fileName;
                move_uploaded_file($tmpFilePath, $newFilePath);
                $imageNames[] = $fileName;
            }
        }

        // Update the images column in the database
        $newImages = implode(",", $imageNames);
        $sql = "UPDATE products SET images = '$newImages' WHERE product_id = " . $productID;
        $conn->query($sql);
    }

    // Update the product data in the database
    $sql = "UPDATE products SET name = '$productName', description = '$productDescription', price = $productPrice, discounted_price = $productDiscountedPrice, qty = $productQty, category = '$productCategory' WHERE product_id = " . $productID;

    if ($conn->query($sql) === TRUE) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
