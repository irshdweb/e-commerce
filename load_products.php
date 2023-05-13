<?php
session_start();
// Connection details to your MySQL server
include './includes/db_connection.php';

// Retrieve the selected category from the AJAX request
$category = $_POST["category"];

// Construct the SQL query based on the selected category
if ($category === "all") {
    $sql = "SELECT * FROM products";
} else {
    $sql = "SELECT * FROM products WHERE category = '$category'";
}

// Execute the query
$result = $conn->query($sql);

// Check if there are any products found
if ($result->num_rows > 0) {
    // Loop through each product and generate the HTML markup
    while ($row = $result->fetch_assoc()) {
        $productId = $row["product_id"];
        $url = $row["images"];
        $productName = $row["name"];
        $productPrice = $row["price"];
        $productDiscountedPrice = $row["discounted_price"];
        $productQty = $row["qty"];

        // Generate the HTML markup for each product card
        echo '
            <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card" style="width: 100%">
                        <a href="./product-detail.php?id='.$productId.'"><img src="./admin/uploads/'.$url.'" class="card-img-top" alt="..."></a>
                           <div class="card-body">
                              <h5 class="card-title">' . $productName . '</h5>
                              <p class="card-text cut-text">' . $productPrice . '</p>
                              <p class="card-text">'. $productDiscountedPrice .'</p>
                              <a href="#" class="btn btn-danger w-100" onclick="addToCart(' . $productId . ', \'' . $url . '\', ' . $productPrice . ', \'' . $productName . '\')"> <img src="images/cart-white.svg" /> Add To Cart</a>
                           </div>
                        </div>
                        </div>
            ';
    }
} else {
    // No products found for the selected category
    echo '<div class="col-12">
            <p>No products found.</p>
          </div>';
}

// Close the database connection
$conn->close();
?>


