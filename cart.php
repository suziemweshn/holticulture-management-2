<?php
session_start();

include 'conn.php';

function calculateTotalPrice($cartItems)
{
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += intval ($item['price'])* $item['quantity'];
    }
    return $totalPrice;
}

$cartItems = $_SESSION['cart'] ?? [];

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: customer-login.php');
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM cart WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

// Fetch and display cart items
$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
}

// Function to store the selected item details in a session variable and redirect to checkout
function storeAndRedirect($itemDetails)
{
    $_SESSION['checkout_item'] = $itemDetails;
    header('Location: checkout.php');
    exit();
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

                <div class="cart-display">
                    <p>Product Name: <?php echo $item['name']; ?></p>
                    <p>Description: <?php echo $item['description']; ?></p>
                    <p>Product Price: <?php echo intval ($item['price']); ?> USD</p>
                    <p>Quantity: <?php echo $item['quantity']; ?></p>
                    <p>Total Price: <?php echo $item['price'] * $item['quantity']; ?> USD</p>

                    <form method="GET" action="remove_from_cart.php?id=<?php echo $item['id']?>" style="background-color: lime; color: white;width: 100px; margin-top:20px;">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <button type="submit">Remove</button>
                    </form>

                    <form method="POST" action="cart.php" style="background-color: lime; color: white;width:100px; margin-top:20px; border-radius:3px ">
                        <input type="hidden" name="checkout_item" value="<?php echo json_encode($item); ?>">
                        <button type="submit">Checkout</button>
                    </form>

                </div>
                <div class="product-list">
                    <?php if (!empty($item['image'])): ?>
                        <div class="product-image">
                            <img src="product-images/<?php echo $item['image']; ?>" alt="Product Image" class="img-fluid rounded-circle" width="100px" height="70px">
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </section>
    <h3>Total Price: $<?php echo calculateTotalPrice($cartItems); ?></h3>
    <div class="buy-button">
        <div class="clear-button">          <form method="GET" action="clear_cart.php">
                <button type="submit">Clear</button>
            </form>
        </div>
        <div class="close-button">
            <a href="customer-profile.php">Close</a>
        </div>
    </div>
    <?php else: ?>
    <p>Your cart is empty.</p>
    <?php endif; ?>

    <?php
    // Check if a checkout request has been made
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout_item'])) {
        $itemDetails = json_decode($_POST['checkout_item'], true);
        storeAndRedirect($itemDetails);
    }
    ?>

</body>
</html>
