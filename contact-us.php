<?php
        session_start(); 
        include './includes/db_connection.php';
        // PHP code to save the form data into the "Inquiry" table
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Establish a connection to the MySQL databas
            
            // Retrieve form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $date = date("Y-m-d"); // Get the current date

            // Insert the form data into the "Inquiry" table
            $sql = "INSERT INTO Inquiry (date, name, email, subject) VALUES ('$date', '$name', '$email', '$subject')";

            if ($conn->query($sql) === TRUE) {
                header("Location: success.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
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
                <h3>Contact Us For Any Inquiries</h3>
                <form id="contactForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group mb-3">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
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