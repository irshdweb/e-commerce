<?php
session_start(); 
include './includes/db_connection.php';
$productID = $_GET['id'];

// Prepare the SQL query
$sql = "SELECT description, price, name, discounted_price, images FROM products WHERE product_id =" . $productID;

// Fetch the product detail
$result = $conn->query($sql);

// Check if the product exists
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $description = $row['description'];
    $price = $row['price'];
    $name = $row['name'];
    $discountedPrice = $row['discounted_price'];
    $images = $row['images'];
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $name; ?></title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
    <?php include './includes/header.php'; ?>
      <section class="products mt-5">
         <div class="container mt-5">
            <div style="max-width: 800px; width: 100%; padding: 40px; background: #f1f1f1; margin: 0 auto;">
                <div class="row w-100 d-flex">
                    <div class="col-md-6 col-sm-12">
                        <img src="./admin/uploads/<?php echo $images; ?>" alt="" style="width: 100%;"/>
                    </div>
                    <div class="col-md-6 col-sm-12" style="padding-left: 15px;">
                       <h2><?php echo $name;?></h2>
                       <h3 class="cut-text"><?php echo $price;?></h3>
                       <h3><?php echo $discountedPrice?></h3><br/>
                       <?php 
                       echo '<a href="#" class="btn btn-danger w-100" onclick="addToCart(' . $productID . ', \'' . $images . '\', ' . $price . ', \'' . $name . '\')"> <img src="images/cart-white.svg" /> Add To Cart</a>'
                       ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                <?php echo $description; ?>
                </div>
            </div>
         </div>
      </section>
      <?php include './includes/options.php'; ?> 
      <?php include './includes/footer.php'; ?>
   </body>
</html>
<?php
    }
} else {
    echo "Product not found.";
}
?>