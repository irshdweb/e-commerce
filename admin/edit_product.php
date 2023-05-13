<?php
   session_start(); 
   if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
      header("Location: ../login.php"); 
      exit(); 
   }
   if (isset($_GET["id"])) {
       $productID = $_GET["id"];
   
       include '../includes/db_connection.php';
       $sql = "SELECT * FROM products WHERE product_id = " . $productID;
       $result = $conn->query($sql);
   
       if ($result->num_rows > 0) {
           // Product found, populate the form with the existing data
           $product = $result->fetch_assoc();
   
           $productName = $product["name"];
           $productDescription = $product["description"];
           $productPrice = $product["price"];
           $productDiscountedPrice = $product["discounted_price"];
           $productQty = $product["qty"];
           $productCategory = $product["category"];
           $productImages = $product["images"];
   
           // Output the form with populated data
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
      <section class="product-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-12 mt-5 px-5">
                  <?php include './menu.php'; ?>
               </div>
               <div class="col-lg-9 col-md-12 pl-3 mt-3">
                  <div class="frm-wrap">
                     <h3 class="mb-3">Update Product</h3>
                     <form action="update_product.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?php echo $productID; ?>">
                        <div class="mb-3">
                           <label for="name" class="form-label">Product Name</label>
                           <input type="text" class="form-control" id="name" name="name" value="<?php echo $productName; ?>">
                        </div>
                        <div class="mb-3">
                           <label for="description" class="form-label">Description</label>
                           <textarea class="form-control" id="description" name="description"><?php echo $productDescription; ?></textarea>
                        </div>
                        <div class="mb-3">
                           <label for="price" class="form-label">Price</label>
                           <input type="text" class="form-control" id="price" name="price" value="<?php echo $productPrice; ?>">
                        </div>
                        <div class="mb-3">
                           <label for="discounted_price" class="form-label">Discounted Price</label>
                           <input type="text" class="form-control" id="discounted_price" name="discounted_price" value="<?php echo $productDiscountedPrice; ?>">
                        </div>
                        <div class="mb-3">
                           <label for="qty" class="form-label">Quantity</label>
                           <input type="number" class="form-control" id="qty" name="qty" value="<?php echo $productQty; ?>">
                        </div>
                        <div class="mb-3">
                           <label for="category" class="form-label">Category</label>
                           <select class="form-control" id="category" name="category">
                              <option value="Clothing" <?php if ($productCategory === 'Clothing') echo 'selected'; ?>>Clothing</option>
                              <option value="Electronics" <?php if ($productCategory === 'Electronics') echo 'selected'; ?>>Electronics</option>
                              <option value="Fashion" <?php if ($productCategory === 'Fashion') echo 'selected'; ?>>Fashion</option>
                              <option value="Electronics" <?php if ($productCategory === 'Todler') echo 'selected'; ?>>Todler</option>
                              <option value="Fashion" <?php if ($productCategory === 'Watches') echo 'selected'; ?>>Watches</option>
                              <!-- ... previous code ... -->
                           </select>
                        </div>
                        <div class="mb-3">
                           <label for="images" class="form-label">Images</label>
                           <input type="file" class="form-control" id="images" name="images[]" multiple>
                        </div>
                        <div class="mb-3">
                           <label>Existing Images</label><br>
                           <?php
                              // Display existing images
                              $imageUrls = explode(",", $productImages);
                              foreach ($imageUrls as $imageUrl) {
                                  echo "<img src='uploads/" . $imageUrl . "' alt='Product Image' width='100' height='100' style='margin-right: 10px;'>";
                              }
                              ?>
                        </div>
                        <div class="mt-4">
                           <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </body>
</html>
<?php
   } else {
       echo "Product not found";
   }
   
   // Close the database connection
   $conn->close();
   } else {
   echo "Product ID not provided";
   }
   ?>