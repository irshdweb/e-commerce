<?php
  session_start(); 
  include './includes/db_connection.php';
  
  // Fetch the last 8 products from the database
  $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 8";
  $result = $conn->query($sql);
  
  $products = array();
  
  if (!$result) {
    die("Query failed: " . $conn->error);
  }
  
  // Close the database connection
  $conn->close();
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include './includes/header.php'; ?>
<section class="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="./images/slide-1.jpg" class="d-block w-100" alt="slider-1">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="./images/slide-2.jpg" class="d-block w-100" alt="slider-2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<?php include './includes/options.php'; ?>
<section class="wo-we-are">
    <div class="container">
        <div class="text">
            <h2>Wo We Are?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nibh lacus, pulvinar vehicula interdum vel, semper in metus. Proin auctor velit erat, nec euismod turpis aliquam ut. Vivamus bibendum ligula sagittis egestas laoreet. Nullam et ante vel nulla pharetra ultricies at eget lectus. Sed turpis tortor, porttitor non varius in, sollicitudin elementum metus. Mauris maximus in sem id lobortis. Nam eu fringilla odio. Proin hendrerit tortor at dolor euismod, in elementum purus finibus. Pellentesque tincidunt vestibulum quam non dignissim.</p>
        </div>
    </div>
</section>
<section class="products">
    <div class="container">
        <div class="row mb-3">
            <h2 class="text-center">Latest Items</h2>
        </div>
        <div class="row">
            <!-- <div class="col-lg-3 col-md-2">
                <div class="card" style="width: 100%">
                    <img src="images/image-2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product</h5>
                        <p class="card-text cut-text">RS 3000</p>
                        <p class="card-text">RS 2500</p>
                        <a href="#" class="btn btn-danger w-100"> <img src="images/cart-white.svg" /> Add To Cart</a>
                    </div>
                </div>
            </div> -->
            
            <?php  while ($product = $result->fetch_assoc()) { ?>
                    <div class="col-lg-3 col-md-2">
                        <div class="card" style="width: 100%">
                            <img src="./admin/uploads/<?php echo $product['images']; ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                <p class="card-text cut-text"><?php echo $product['price']; ?></p>
                                <p class="card-text"><?php echo $product['discounted_price']; ?></p>
                                <a href="#" class="btn btn-danger w-100" onclick="addToCart(' . $productId . ', \'' . $url . '\', ' . $productPrice . ', \'' . $productName . '\')">
                                    <img src="images/cart-white.svg" /> Add To Cart
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>
</section>
<?php include './includes/footer.php'; ?>
</body>
</html>