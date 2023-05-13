<?php
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Products</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
         // Function to load products based on the selected category
         function loadProducts(category) {
            $.ajax({
               url: "load_products.php",
               type: "POST",
               data: { category: category },
               success: function(response) {
                  $("#products-container").html(response);
               },
               error: function(xhr, status, error) {
                  console.log(xhr.responseText);
               }
            });
         }
         
         $(document).ready(function() {
            // Load all products initially
            loadProducts("all");
         
            // Category click event handler
            $(".category-link").click(function(e) {
               e.preventDefault();
               var category = $(this).data("category");
               loadProducts(category);
            });
         });
      </script>
   </head>
   <body>
      <?php include './includes/header.php'; ?>
      <?php include './includes/options.php'; ?> 
      <section class="products">
         <div class="container">
            <div class="row">
               <div class="col-md-3 col-sm-12 pr-3">
                  <div class="row">
                     <h3>Categories</h3>
                  </div>
                  <div class="row">
                     <div class="col-12 filter-wrap">
                        <ul>
                           <li>
                              <a href="" class="category-link" data-category="all"> ALL</a> 
                           </li>
                           <li>
                              <a href="" class="category-link" data-category="Clothing">Clothing</a> 
                           </li>
                           <li>
                              <a href="" class="category-link" data-category="Electronics">Electronics</a> 
                           </li>
                           <li>
                              <a href="" class="category-link" data-category="Fashion"> Fashion</a>
                           </li>
                           <li>
                              <a href="" class="category-link" data-category="Todler">Todler</a> 
                           </li>
                           <li>
                              <a href="" class="category-link" data-category="Watches">Watches</a> 
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-9 col-sm-12">
                  <div class="row mb-3">
                     <h3>All Products</h3>
                  </div>
                  <div class="row" id="products-container">
                     
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php include './includes/footer.php'; ?>
   </body>
</html>