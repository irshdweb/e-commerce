<?php
session_start(); 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Products</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="../css/style.css">
   </head>
   <body>
      <?php include '../includes/header.php'; ?>
      <section class="products">
         <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 mt-5 px-5">
                    <?php include './menu.php'; ?>
                </div>
                <div class="col-lg-9 col-md-12 pl-3 mt-3">
                    <div class="row mt-4 mb-4 d-flex justify-content-end w-100">
                        <a href="./new-product.php" class="btn btn-primary" style="width:150px;">Add New Product</a>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discounted Price</th>
                                    <th scope="col">QTY</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch products from the database
                                include '../includes/db_connection.php';
                                $sql = "SELECT * FROM products";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["price"] . "</td>";
                                        echo "<td>" . $row["discounted_price"] . "</td>";
                                        echo "<td>" . $row["qty"] . "</td>";
                                        echo "<td><a class='btn btn-warning' href='edit_product.php?id=" . $row["product_id"] . "'>Edit</a></td>";
                                        echo "<td><a class='btn btn-danger' href='delete_product.php?id=" . $row["product_id"] . "' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No products found</td></tr>";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
      </section>
   </body>
</html>
