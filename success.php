<?php
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Contact Us</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
    <?php include './includes/header.php'; ?>
    <?php include './includes/options.php'; ?> 
    <?php if (isset($success) && $success): ?>
    <?php endif; ?>
      <section class="products">
         <div class="container">
            <div class="contact-form">
            <div class="alert alert-success" role="alert">
                Submitted Succefully !!!
            </div>
            </div>
         </div>
      </section>
      <?php include './includes/footer.php'; ?>
     
   </body>
</html>