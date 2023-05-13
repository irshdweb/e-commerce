<?php
session_start(); 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
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
      <title>Thank You</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="../css/style.css">
   </head>
   <body>
    <?php include '../includes/header.php'; ?>
      <section class="products">
         <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 pl-3 mt-5">
                <div class="alert alert-success" role="alert mt-5">
                    Order Placed successfully you will receive the products with 3 business days
                </div>
                </div>
            </div>
         </div>
      </section>
   </body>
</html>