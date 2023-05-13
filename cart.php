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
         var cartitems = JSON.parse(sessionStorage.getItem('cart'));
         console.log(cartitems);
         
         // Function to generate the HTML for the table rows
         function generateTableRows(items) {
            var html = '';
            for (var i = 0; i < items.length; i++) {
               html += `<tr>
                    <td><img src="./admin/uploads/${items[i].url}" width="60px"></td>
                    <td>${items[i].name}</td>
                    <td>${items[i].price }</td>
                    <td><input type="number" min="1" value="1" onchange="updateQuantity(${i}, this.value)"></td>
                    <td><img src="./images/remove.svg" style="width:20px; cursor: pointer" onclick="removeItem('${i}')" /></td>
               </tr>`
            }
            return html;
         }
         
         function updateQuantity(index, quantity) {
         if (cartitems && index >= 0 && index < cartitems.length) {
         cartitems[index].quantity = parseInt(quantity); // Update the quantity in the cart item
         
         // Calculate the total price
         var totalPrice = 0;
         for (var i = 0; i < cartitems.length; i++) {
            totalPrice += cartitems[i].price * cartitems[i].quantity;
         }
         
         // Update the total price in the table
         $('#total-price').text('Total Price: $' + totalPrice.toFixed(2));
         
         sessionStorage.setItem('cart', JSON.stringify(cartitems)); // Update the session storage
         }
         }
         
         $(document).ready(function() {
            if (cartitems && cartitems.length > 0) {
               var tableRows = generateTableRows(cartitems);
               $('#products-container').append(tableRows);
               
               // Calculate the total price
               var totalPrice = 0;
               for (var i = 0; i < cartitems.length; i++) {
               totalPrice += cartitems[i].price * cartitems[i].quantity;
               }
               
               var totalRow = `<tr id="total-row"><td colspan="5" style="text-align: right" id="total-price">Total Price: $${totalPrice.toFixed(2)}</td></tr>`;
               $('#products-container').append(totalRow);
            } else {
               $('#tbl1').css('display', 'none');
               $('#checkout-button').css('display', 'none');
            }

         });
         
         function removeItem(index) {
            if (cartitems && index >= 0 && index < cartitems.length) {
                cartitems.splice(index, 1); // Remove the item from the array

                // Refresh the table
                $('#products-container').empty();
                var tableRows = generateTableRows(cartitems);
                $('#products-container').append(tableRows);

                // Calculate the total price
                var totalPrice = 0;
                for (var i = 0; i < cartitems.length; i++) {
                totalPrice += cartitems[i].price * cartitems[i].quantity;
                }

                // Update the total price in the table
                var totalRow = `<tr id="total-row"><td colspan="5" style="text-align: right" id="total-price">Total Price: $${totalPrice.toFixed(2)}</td></tr>`;
                $('#products-container').append(totalRow);

                sessionStorage.setItem('cart', JSON.stringify(cartitems)); // Update the session storage
            }
         }
         function checkout() {
            var url = 'user/checkout.php';
            if (cartitems && cartitems.length > 0) {
                url += '?';
                for (var i = 0; i < cartitems.length; i++) {
                url += 'item' + (i + 1) + '=' + encodeURIComponent(JSON.stringify(cartitems[i]));
                if (i < cartitems.length - 1) {
                    url += '&';
                }
                }
            }
            window.location.href = url;
        }
      </script>
   </head>
   <body>
      <?php include './includes/header.php'; ?>
      <?php include './includes/options.php'; ?> 
      <section class="products">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12">
                  <div class="row mb-3">
                     <h3>Cart</h3>
                  </div>
                  <div class="row">
                     <table class="table" id="tbl1">
                        <thead>
                           <tr>
                              <th></th>
                              <th>Name</th>
                              <th>Price</th>
                              <th>QTY</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="products-container">
                         
                        </tbody>
                     </table>
                  </div>
                  <div class="row d-flex justify-content-end">
                     <button class="btn btn-primary" id="checkout-button" style="width:300px;" onclick="checkout()">Checkout</button>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php include './includes/footer.php'; ?>
   </body>
</html>