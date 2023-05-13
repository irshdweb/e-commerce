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
      <title>Dashboard</title>
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
                <div class="col-lg-9 col-md-12 pl-3" style="margin-top: 60px;">
                    <div class="row d-flex flex-row justify-content-between w-100">
                        <div class="box-item text-center green">
                           <h4>05</h4>
                           Orders
                        </div>
                        <div class="box-item text-center red">
                           <h4>05</h4>
                           Products
                        </div>
                        <div class="box-item text-center blue">
                           <h4>05</h4>
                           Inquiries
                        </div>
                        <div class="box-item text-center yellow">
                           <h4>10</h4>
                           Email Subscriptions
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </section>
   </body>
</html>