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

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $tempFilePath = $_FILES['image']['tmp_name'];

    // Check if an image was uploaded
    if (!empty($image) && !empty($tempFilePath)) {
        $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/product-images/';
        $targetFile = $targetDirectory . basename($image);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($tempFilePath);
        if ($check === false) {
            die('Error: File is not an image.');
        }

        // Check if the file already exists
        //if (file_exists($targetFile)) {
          //  die('Error: File already exists.');
        //}

        // Check file size
        $maxFileSize = 2 * 1024 * 1024; // 2 MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            die('Error: File size exceeds the maximum limit.');
        }

        // Allow only specific image file formats
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedFormats)) {
            die('Error: Only JPG, JPEG, PNG, and GIF formats are allowed.');
        }

        // Move the uploaded image to the product-images folder
        if (!move_uploaded_file($tempFilePath, $targetFile)) {
            die('Error: Failed to upload the file.');
        }
    } else {
        die('Error: No image file was uploaded.');
    }

    // Insert the product into the products table
    $query = "INSERT INTO cart_table (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";
    mysqli_query($conn, $query);
   


    // Close the database connection
    mysqli_close($conn);

    // Redirect back to the admin page or display success message
    header('cart.php');
    exit();
}

// Retrieve products from the database
$query = "SELECT * FROM cart_table";
$result = mysqli_query($conn, $query);

// Fetch and store products in an array
/*$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
*/
/*$roses = [];
while ($row = mysqli_fetch_assoc($result)) {
    if (!array_key_exists('image', $row) || $row['image'] === null) {
        // The "image" field is not present or null in the result set
        echo "Warning: Image field is missing or null in the database row.";
        var_dump($row); // Debugging statement
        continue;
    }

    // Add the row to the products array
    $roses[] = $row;
}

// Close the database connection
mysqli_close($conn);*/
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
\
        function closeCart() {
            // Close the cart page
            window.close();j
        }
        

    </script>
    
</body>
</html>