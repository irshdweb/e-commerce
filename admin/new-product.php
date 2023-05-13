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
                    <div class="frm-wrap">
                        <h3 class="mb-3">Add New Product</h3>
                    <form action="save_product.php" method="POST" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group mb-3">
            <label for="discounted_price">Discounted Price:</label>
            <input type="number" class="form-control" id="discounted_price" name="discounted_price">
        </div>
        <div class="form-group mb-3">
            <label for="qty">Quantity:</label>
            <input type="number" class="form-control" id="qty" name="qty" required>
        </div>
        <div class="form-group mb-3">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Clothing">Clothing</option>
                <option value="Electronics">Electronics</option>
                <option value="Fashion">Fashion</option>
                <option value="Todler">Todler</option>
                <option value="Watches">Watches</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="images">Images:</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple required>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Submit</button>
    </form>
                    </div>
                </div>
            </div>
         </div>
      </section>
   </body>
</html>