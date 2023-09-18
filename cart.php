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
/*function storeAndRedirect($itemDetails)
{
    $_SESSION['checkout_item'] = $itemDetails;
   

    header('Location: checkout.php');*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout_item'])) {
        // Check if the checkout_item session variable exists
        if (isset($_SESSION['checkout_item'])) {
            // Unset the existing checkout_item session variable
            unset($_SESSION['checkout_item']);
        }
    
        $itemDetails = json_decode($_POST['checkout_item'], true);
    
        // Set the checkout_item session variable with the new item details
        $_SESSION['checkout_item'] = $itemDetails;
    
        // Redirect to the checkout page
        header('Location: checkout.php');
        exit();
    }
    
   // exit();
//}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
   
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="css/task6.css">
  <style>
        @keyframes fadeInOut {
          0%, 100% { opacity: 1; }
          50% { opacity: 0.5; }
        }
      
        .text1 {
          animation: fadeInOut 2s infinite;
          padding:5px;
          width:300px;
        }
         
         .trend{
          margin-left:350px;
          margin-top: 400px;
         }
         .dropdown-menu{
          display:flex;
          flex-direction: column;

         }
        
 
  
  
  .sidebar {
   position: fixed;
   top:-2px;
    left: 0;
    bottom: 0;
    width: 300px;
    z-index: 996;
    transition: all 0.3s;
    padding: 20px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #aab7cf transparent;
    box-shadow: 0px 0px 20px rgba(1, 41, 112, 0.1);
    background-color:whitesmoke;
  
 
  } 
  .neonText {
  animation: flicker 1.5s infinite alternate;
  
}



/* Flickering animation */
@keyframes flicker {
    
  0%, 18%, 22%, 25%, 53%, 57%, 100% {

      text-shadow:
      0 0 4px #fff,
      0 0 11px #fff,
      0 0 19px #fff,
      0 0 40px #0fa,
      0 0 80px #0fa,
      0 0 90px #0fa,
      0 0 100px #0fa,
      0 0 150px #0fa;
  
  }
  
  20%, 24%, 55% {        
      text-shadow: none;
  }    
}
   
    
   
   
   .dropdown-list{
  display:flex;
  justify-content:flex-end;

   }
   .dropdown button{
    width:100%;

   }
   .search-bar{
    width:40%;
    margin-left:200px;
    
    
    
   }
   .title{
    margin-left:20px;
    color:lime;
    font-size:20px;
   }
   .top-bar{
    margin-bottom:100px;

   }
   .dropdown-menu{
    display: none;
   }
         
     
      </style>
</head>
<body>
    
   <div class="top-bar ">

    

<div class="d-flex flex-row">
     <img src="img/org.png" alt="Logo" height="20px" class="">  <span class=title>AKIMA</span> 
 </div>
 <div class="search-bar">
     <input type="text" placeholder="Search...">
 </div>

<div class="cart ">
         <a href="cart.php"><img src="img/cart2.png" alt="" height="50px" width="40px"> cart</a> 
</div>
</div>
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
    <h3 class="d-flex flex-row align-items-center justify-content-center">Total Price: $<?php echo calculateTotalPrice($cartItems); ?></h3>
    <div class="buy-button ">
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
    <aside id="sidebar" class="sidebar ">
  <ul class="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item ">
        <a class="nav-link collapsed" href="index.html">
          <i class="bi bi-house"></i>
          <span>Home page</span>
        </a>
      </li><!-- End Dashboard Nav -->
  
    
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>View products</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="Flowers.html">
            <i class="bi bi-circle"></i><span>Flowers</span>
          </a>
         
        </li>
        <li>


              <a href="forms-layouts.html">
                <i class="bi bi-circle"></i><span>Vegetables</span>
              </a>
            </li>
            <li>
              <a href="forms-editors.html">
                <i class="bi bi-circle"></i><span>Fruits</span>
              </a>
            </li>
            <li>
              <a href="forms-validation.html">
                <i class="bi bi-circle"></i><span>Dairy Products</span>
              </a>
            </li>
          </ul>
        </li><!-- End products Nav -->
        <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>My Account</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="Flowers.html">
            <i class="bi bi-circle"></i><span> My Orders</span>
          </a>
         
        </li>
        <li>


              <a href="forms-layouts.html">
                <i class="bi bi-circle"></i><span>Edit profile</span>
              </a>
            </li>
            <li>
                      <li>


            

<a href="forms-layouts.html">
  <i class="bi bi-circle"></i><span>Change password</span>
</a>
</li> 
<li>


<a href="forms-layouts.html">
  <span>Sign out</span>
</a>
</li>
<li>
<script>
  var images = document.querySelectorAll('.image-fade');
  var text = document.querySelector('.fade-text');
  var currentIndex = 0;

  function fadeImages() {
    images.forEach(function(image) {
      image.classList.remove('active');
    });

    images[currentIndex].classList.add('active');

    text.classList.remove('active');
    setTimeout(function() {
      text.classList.add('active');
    }, 500);

    currentIndex = (currentIndex + 1) % images.length;
  }

  setInterval(fadeImages, 3000);
</script>
<!-- Your HTML code here -->

<script>
  // Get the dropdown button and dropdown menu
  const dropdownButton = document.getElementById('dropdownMenuButton1');
  const dropdownMenu = document.querySelector('.dropdown-menu');

  // Function to check if a clicked target is inside the dropdown or the button
  function isInsideDropdown(target) {
    return dropdownButton.contains(target) || dropdownMenu.contains(target);
  }

  // Add a click event listener to the document
  document.addEventListener('click', function (event) {
    // Check if the clicked element is not inside the dropdown or the button
    if (!isInsideDropdown(event.target)) {
      // If the clicked element is outside, close the dropdown
      dropdownMenu.classList.remove('show'); // Manually hide the dropdown
    }
  });

  // Add a click event listener to the dropdown button to toggle the dropdown menu
  dropdownButton.addEventListener('click', function () {
    dropdownMenu.classList.toggle('show'); // Toggle the class to show/hide the dropdown
  });
</script>
script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
  <!-- Add this script tag at the end of the body section -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    
    <script src="script.js"></script>

</body>
</html>
