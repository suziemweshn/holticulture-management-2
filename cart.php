<?php
session_start();

include 'conn.php';

// Helper function to calculate total price
function calculateTotalPrice($cartItems)
{
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
    return $totalPrice;
}

$cartItems = $_SESSION['cart'] ?? [];

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: customer-login.php'); // Redirect to the login page if not logged in
    exit();
}

// Retrieve cart items associated with the logged-in user
$username = $_SESSION['username'];
$sql = "SELECT cart.*, roses.name, roses.description, roses.price, roses.image 
          FROM cart 
          INNER JOIN roses ON cart.product_id = roses.id 
          WHERE cart.username = '$username'
          UNION
          SELECT cart.*, mixed_roses.name, mixed_roses.description, mixed_roses.price, mixed_roses.image 
          FROM cart 
          INNER JOIN mixed_roses ON cart.product_id = mixed_roses.id 
          WHERE cart.username = '$username'
          UNION
          SELECT cart.*, carnations.name, carnations.description, carnations.price, carnations.image 
          FROM cart 
          INNER JOIN carnations ON cart.product_id = carnations.id 
          WHERE cart.username = '$username'
          UNION
          SELECT cart.*, lily.name, lily.description, lily.price, lily.image 
          FROM cart 
          INNER JOIN lily ON cart.product_id = lily.id 
          WHERE cart.username = '$username'
          UNION
          SELECT cart.*, seasonal.name, seasonal.description, seasonal.price, seasonal.image
          FROM cart 
          INNER JOIN seasonal ON cart.product_id = seasonal.id
          WHERE cart.username = '$username'";



$result = mysqli_query($conn, $sql);


// Check for query errors
if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

// Fetch and display cart items
$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/task6.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <h1 class="cart-title">Shopping Cart</h1>

    <?php if (count($cartItems) > 0): ?>
    <section class="cart-products">
        <?php foreach ($cartItems as $item): ?>
            <div class="d-flex flex-row justify-center">
                <span class="border-2"></span>
                <div class="cart-display">
                    <p>Product Name: <?php echo $item['name']; ?></p>
                    <p>Description: <?php echo $item['description']; ?></p>
                    <p>Product Price: <?php echo $item['price']; ?> USD</p>
                    <p>Quantity: <?php echo $item['quantity']; ?></p>
                    <p>Total Price: <?php echo $item['price'] * $item['quantity']; ?> USD</p>
                   <!-- <?php  echo "<pre>";
//print_r($_SESSION['cart']);
//echo "</pre>";?>-->
                    <div class="display-button">
                 


    <form method="POST" action="remove_from_cart.php">
    
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <button type="submit">Remove</button>
    </form>
</div>

                    <form method="" action="checkout.php">
                        <button type="submit" style="background-color: lime; color: white;width: 200px; margin-top:20px;" >Checkout</button>
                    </form>
                </div>
                <div class="image-display">
                    <?php if (!empty($item['image'])): ?>
                        <img src="product-images/<?php echo $item['image']; ?>" alt="Product Image" width="100">
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </section>
    <h3>Total Price: $<?php echo calculateTotalPrice($cartItems); ?></h3>
    <div class="buy-button">
        <div class="clear-button">
            <button onclick="clearCart()">ClearCart</button>
        </div>
        <div class="close-button">
            <button onclick="closeCart()">Close</button>
        </div>
    </div>
    <?php else: ?>
    <p>Your cart is empty.</p>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       /* function removeFromCart(productId) {
            $.ajax({
                url: 'remove_from_cart.php',
                method: 'POST',
                data: { id: productId },
                success: function(response) {
                    // Refresh the page after successful removal
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error(error);
                }
            });
        }*/

        /*function clearCart() {
            $.ajax({
                url: 'clear_cart.php',
                method: 'POST',
                success: function(response) {
                    // Refresh the page after successful clearing
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error(error);
                }
            });
        }
    

        function closeCart() {
            window.close();
        }*/
    </script>
</body>
</html>
