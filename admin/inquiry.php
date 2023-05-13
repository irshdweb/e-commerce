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
      <title>Inquiries</title>
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
                        <h3>Inquiries</h3>
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch products from the database
                                include '../includes/db_connection.php';
                                $sql = "SELECT * FROM inquiry";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["date"] . "</td>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["subject"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No products found</td></tr>";
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
