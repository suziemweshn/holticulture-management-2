<!-- cart.php -->

<?php
session_start();

include  'conn.php';

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
    <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="css/task6.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <h1 class="cart-title">Shopping Cart</h1>

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
               
                <?php foreach ($cartItems as $item): ?>
                    <div class="d-flex flex-row justify-center ">
                        <span class="border-2"></span>
                    <div class="cart-display">
                   <p> Product Name:<?php echo $item['name']; ?> </p>
                   <p>Description:<?php echo $item['description']; ?></p> 
                    
                    <p> Product Price:<?php echo $item['price']; ?> USD</p>
                   <p> Quantity:<?php echo $item['quantity']; ?></p>
                   <p> Total Price:<?php echo $item['price'] * $item['quantity']; ?> USD</p>
                <div >

                      <button><a href="remove_from_cart.php?id=<?php echo $item['id']; ?>" >Remove</a></button>  
              
                </div>
                      <!--<button><a href="Buy_details.php?id=<?php echo $item['id']; ?>" >checkOut</a></button> -->
        <form method="GET" action="checkout.php">
        <button type="submit"  style="background-color: lime; color: white;width: 200px; margin-top:20px;" >Checkout</button>
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
                    
                   
              </div>
                   
                
            <?php endforeach; ?>
        
                </div>
                        </div>
        
          
            

    <h3>Total Price: $<?php echo calculateTotalPrice($cartItems); ?></h3>
<div class="buy-button">
    <div class="clear-button">
    <button onclick="clearCart()"><a href="">Clear</a></button>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>
    </div>

<div class="close-button">
<button onclick="closeCart()"><a href="">Close</a></button>
</div>

</div>

</section>
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