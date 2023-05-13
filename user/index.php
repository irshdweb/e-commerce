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
                <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch products from the database
                                include '../includes/db_connection.php';
                                $sql = "SELECT * FROM orders WHERE user_id = " . $_SESSION['user_id'];
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . $row["date"] . "</td>";
                                        echo "<td>" . $row["status"] . "</td>";
                                        echo "<td><a class='btn btn-danger' href='delete_order.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you cancel this order?\");'>Cancel Order</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No Orders found</td></tr>";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                </div>
            </div>
         </div>
      </section>
   </body>
</html>