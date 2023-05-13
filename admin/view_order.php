<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
if (isset($_GET["id"])) {
    $orderID = $_GET["id"];

    include '../includes/db_connection.php';
    $sql = "SELECT * FROM orders WHERE id = " . $orderID;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Product found, populate the form with the existing data
        $product = $result->fetch_assoc();

        $orderId = $product["id"];
        $date = $product["date"];
        $items = $product["items_details"];
        $name = $product["name"];
        $address = $product["address"];
        $tel = $product["telephone"];

        // Explode the items string into an array
        $itemsArray = explode("', '", substr($items, 2, -2));

        // Output the form with populated data
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Order</title>
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
                            <h3 class="mb-3">Order Detail</h3>
                            <strong>Order Id</strong> : <?php echo $orderId; ?><br/>
                            <strong>Customer Name</strong> : <?php echo $name; ?><br/>
                            <strong>Customer Phone</strong> : <?php echo $tel; ?><br/>
                            <strong>Delivery Address</strong> : <?php echo $address; ?><br/>
                            <h4 style="margin-top:20px;">Product Details</h4>
                            <?php
                            $total = 0;
                            foreach ($itemsArray as $item) {
                                $itemArray = explode(", ", substr($item, 1, -1));
                                $imageSrc = $itemArray[1];
                                $price = intval($itemArray[0]);
                                $quantity = intval($itemArray[3]);
                                $subtotal = $price * $quantity;
                                $total += $subtotal;
                            ?>
                            
                                <div class="w-100 d-flex flex-row" style="margin-bottom: 20px;padding: 15px; border:1px solid #a1a1a1;">
                                    <img src="./uploads/<?php echo $imageSrc; ?>" alt="Product Image" style="width: 120px; margin-right: 20px;">
                                    <div>
                                        <strong>Product Name</strong>: <?php echo $itemArray[2] ?> <br/>
                                        <strong>Unit Price</strong>: <?php echo $itemArray[0] ?> <br/>
                                        <strong>QTY</strong>: <?php echo $itemArray[3] ?> <br/>
                                    </div>
                                    
                                </div>

                            <?php
                            
                            }
                           
                            ?>
                            <div class="row d-flex flex-row w-100 justify-content-end">
                              <h2 class="text-right">Total $<?php  echo $total; ?></h2>  
                            </div>
                            <div class="row d-flex flex-row">
                            <a class="btn btn-success" href="complete_order.php?id=<?php echo $orderId; ?>&order=completed" style="width: 200px;">Dispatch</a>
                            <a class="btn btn-danger" href="complete_order.php?id=<?php echo $orderId; ?>&order=rejected" style="width: 200px; margin-left: 20px;">Reject</a>
                            </div>
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