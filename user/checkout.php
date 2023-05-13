<?php
session_start(); 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php"); 
    exit(); 
}
$cartItems = array();
foreach ($_GET as $key => $value) {
  if (strpos($key, 'item') === 0) {
    $item = json_decode($value, true);
    $cartItems[] = $item;
  }
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
                <div class="col-lg-12 col-md-12 " style="margin-top: 60px;">
                    <div class="row d-flex flex-row justify-content-between w-100">
                        <div class="order-wrap">
                          <h3 style="margin-bottom: 22px;">Checkout</h3>
                          <?php foreach ($cartItems as $item): ?>
                              <div class="item-box w-100 d-flex flex-row">
                                  <div class="img-box">
                                    <img src="<?php echo '../admin/uploads/' . $item['url']; ?>" width="100px">
                                  </div>
                                  <div class="details">
                                    <strong>
                                      <?php echo $item['name']; ?>
                                    </strong><br/>
                                    Price: <?php echo $item['price']; ?> <br/>
                                    QTY: <?php echo $item['quantity']; ?>
                                  </div>
                              </div>
                          <?php endforeach; ?>
                          <form method="POST" action="process_order.php">
                            <input type="hidden" name="cart_items" value='<?php echo json_encode($cartItems); ?>'>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?> "/>
                            <input type="hidden" name="user_name" value="<?php echo $_SESSION['user_name_']; ?> "/>
                            <div class="mb-3 mt-3">
                              <label for="email" class="form-label">Delivery Address:</label>
                              <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $_SESSION['address']; ?> "/>
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="email" class="form-label">Telephone:</label>
                              <input type="text" class="form-control" id="phone" placeholder="Phone" name="telephone" value="<?php echo $_SESSION['phone']; ?> "/>
                            </div>
                            <div class="mb-3 mt-3">
                              <button type="submit" class="btn btn-primary w-100">Confirm Order</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </section>
   </body>
</html>