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
                <h3>Register</h3>
                <form id="contactForm" method="POST" action="register_process.php">
                <div class="form-group mb-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="subject">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="subject">Telephone:</label>
                    <input type="tel" class="form-control" id="tel" name="tel" required>
                </div>
                <div class="form-group mb-3">
                    <label for="subject">Address:</label>
                    <input type="address" class="form-control" id="address" name="address" required>
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
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var subject = document.getElementById('subject').value;

        if (name.trim().length === 0 || email.trim().length === 0 || subject.trim().length === 0) {
            event.preventDefault();
            alert('All fields are required!');
        }
        });
    </script>
   </body>
</html>