<?php
  $baseurl= 'http://localhost/my-shop';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $baseurl; ?>">
        <img src="<?php echo $baseurl; ?>/images/logo.svg" alt="Logo" class="logo-img" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $baseurl; ?>/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $baseurl; ?>/about-us.php">About Us</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $baseurl; ?>/products.php">Products</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $baseurl; ?>/contact-us.php">Contact Us</a>
        </li>
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo $baseurl; ?>/admin" style="font-weight: bold;">Admin Dashboard</a>
        </li>
        <?php
        } 

          if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo $baseurl; ?>/user" style="font-weight: bold;">User Dashboard</a>
            </li>
            <?php
            } 
            ?>
        
      </ul>
      <?php 
        if (isset($_SESSION['role'])) {       
      ?>
      <div class="d-flex cart-section">
        <a href="<?php echo $baseurl; ?>/cart.php"><img src="<?php echo $baseurl; ?>/images/cart.svg" alt="cart" style="width: 30px;"/></a>
        <a href="<?php echo $baseurl; ?>/logout.php" class="btn btn-outline-success" type="submit">Logout</a>
        </div>
      </div>
      <?php
        } else {
      ?>
            <div class="d-flex cart-section">
        <a href="<?php echo $baseurl; ?>/cart.php"><img src="<?php echo $baseurl; ?>/images/cart.svg" alt="cart" style="width: 30px;"/></a>
        <a href="<?php echo $baseurl; ?>/login.php" class="btn btn-outline-success" type="submit">Login</a>
        </div>
      </div>
      <?php
        }
      ?>
    </div>
  </div>
</nav>