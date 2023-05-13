<?php
        include './includes/db_connection.php';
        // PHP code to save the form data into the "Inquiry" table
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Establish a connection to the MySQL databas
            
            $email = $_POST['email'];
            $date = date("Y-m-d"); // Get the current date

            // Insert the form data into the "Inquiry" table
            $sql = "INSERT INTO email_list (date, email) VALUES ('$date', '$email')";

            if ($conn->query($sql) === TRUE) {
                $success = true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
<?php if (isset($success) && $success): ?>
    <script>
        // Show the success message in an alert box
        alert("SuccessFully Submited!");
    </script>
<?php endif; ?>
<section class="news-letter">
    <div class="container">
        <div class="nl-wrap">
            <div class="row mb-3">
                <h2 class="text-center">Get Latest Updates</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="d-flex flex-row w-100 align-items-center justify-content-center">
                        <div>
                            <input type="email" class="text-nl" id="inputPassword2" placeholder="Enter Your Email" name="email" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Get Updates</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="footer">
    <div class="container">
        <div class="w-100 d-flex flex-column align-items-center justify-content-center">
            <div class="menu">
                <ul>
                    <li>
                        <a href="">Home</a> 
                    </li>
                    <li>
                        <a href="">About Us</a> 
                    </li>
                    <li>
                        <a href="">Product</a> 
                    </li>
                    <li>
                        <a href="">Contact Us</a> 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<script>
function addToCart(productId, url, price, name) {
    // Check if the cart session variable exists, if not, initialize it as an empty array
    if (!sessionStorage.getItem('cart')) {
        sessionStorage.setItem('cart', JSON.stringify([]));
    }

    // Retrieve the current cart items from the session
    var cartItems = JSON.parse(sessionStorage.getItem('cart'));

    // Check if the product ID is already in the cart items array
    var productExists = cartItems.some(item => item.productId === productId);
    if (productExists) {
        alert('This item is already in your cart.');
        return;
    } else {
        alert('Item Added To Cart');
    }

    // Create a new product object
    var product = {
        productId: productId,
        url: url,
        price: price,
        name: name,
        quantity: 1
    };

    // Add the selected product to the cart items array
    cartItems.push(product);

    // Update the cart session variable with the updated cart items
    sessionStorage.setItem('cart', JSON.stringify(cartItems));
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>