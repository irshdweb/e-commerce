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
      <section class="products">
         <div class="container">
            <div class="contact-form">
                <h3>Login</h3>
                <form id="contactForm" method="POST" action="login_process.php">
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="subject">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
         </div>
      </section>
      <?php include './includes/footer.php'; ?>
      <script>
        // JavaScript form validation
        document.getElementById('contactForm').addEventListener('submit', function(event) {
        var name = document.getElementById('email').value;
        var email = document.getElementById('password').value;
        
        if (name.trim().length === 0 || email.trim().length === 0 || subject.trim().length === 0) {
            event.preventDefault();
            alert('All fields are required!');
        }
        });
    </script>
   </body>
</html>