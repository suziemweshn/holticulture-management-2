<!-- cart.php -->

<?php
session_start();

$servername="localhost:3307";
$username="root";
$password='1234';
$database="products";

$conn=new mysqli($servername, $username, $password, $database);

if ($conn->connect_error){
    die("connection failed: " .$conn->connect_error);
}

// Helper function to calculate total price
function calculateTotalPrice($cartItems)
{
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
    return $totalPrice;
}

// Retrieve cart items from the session
$cartItems = $_SESSION['cart'] ?? [];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>

    <?php if (count($cartItems) > 0): ?>
   <!-- <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Product Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>-->
            <section class="cart-products">
                <div class="container-fluid">
                <?php foreach ($cartItems as $item): ?>
              <div class="d-flex flex-row">
                   <p> Product Name:<?php echo $item['name']; ?> </p>
                   <p>Description:<?php echo $item['description']; ?></p> 
                    </div>
                    <p> Product Price:<?php echo $item['price']; ?></p>
                   <p> Quantity:<?php echo $item['quantity']; ?></p>
                   <p> Total Price:<?php echo $item['price'] * $item['quantity']; ?></p>
                    
                        <?php if (!empty($item['image'])): ?>
                            <img src="product-images/<?php echo $item['image']; ?>" alt="Product Image" width="100">
                        <?php else: ?>
                            No Image Available
                        <?php endif; ?>
                        <div>
                        <a href="remove_from_cart.php?id=<?php echo $item['id']; ?>">Remove</a>
                        </div>
                    
                   
              </div>
                   
                
            <?php endforeach; ?>
        
                </div>
        
            </section>
            

    <h3>Total Price: $<?php echo calculateTotalPrice($cartItems); ?></h3>

    <button onclick="clearCart()">Clear Cart</button>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<button onclick="closeCart()">Close Cart</button>

    <script>
        function clearCart() {
            // Send a request to a PHP file that will clear the cart
            window.location.href = 'clear_cart.php';
        }

        function closeCart() {
            // Close the cart page
            window.close();
        }
    </script>
</body>
</html>
