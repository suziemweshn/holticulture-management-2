<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: customer-login.php');
    exit;
}

$servername = 'localhost:3307';
$username = "root";
$password = '1234';
$database = 'Project';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user details from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Retrieve user profile details from the admin_table
$stmt = $conn->prepare("SELECT * FROM customer_table WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'] ?? '';
    $name = $row['name'] ?? '';
    $email = $row['email'] ?? '';
    $phone_no = $row['phone_no'] ?? '';
    $password = $row['password'] ?? '';
    $username = $row['username'] ?? '';
    $country = $row['country'] ?? '';
    $city = $row['city'] ?? '';
    $location = $row['location'] ?? '';

} else {
    // User not found in the admin_table
    // Handle the scenario accordingly, e.g., display an error message
    echo "User profile not found!";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
   <link href="style.css" rel="stylesheet">
   <link href="assets/css/style.css" rel="stylesheet">
   <link href="css/task6.css" rel="stylesheet">
</head>
<body>
    <!-- Top bar -->
    <div class="top-bar mx-auto">
       <div class="logo">
            <img src="img/org.png" alt="Logo" >    AKIMA
        </div>
        <div class="list">
            <ul class="">
                <li > <a href="#"> <p class="text1">Hi   <?php echo $username?>!</p></a></li> 
                
                <li class="cart">
                <a href=""><img src="img/shopping-cart.png" alt=""> Cart</a>  
                </li>
                
            </ul>
        </div>
       <!-- <div class="logo">
            <img src="your-logo.png" alt="Logo" height="40">
        </div>-->
        <div class="search-bar ">
            <input type="text" placeholder="Search...">
        </div>
       <!-- <ul>
            <li>home</li>
            <li>products</li>
            <li>about</li>
        </ul>-->
    </div>
    
    <!-- Sidebar -->
    <!--<div class="sidebar" id="sidebar mt-60">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>-->
    <div class="content1">
        <!--<h1>Welcome to the Customer Profile</h1>
        <p>This is the main content area of your page.</p>-->
        
    </div>
    <div class="content2">
    <h1>Image Slideshow</h1>
<div id="slideshow" class="image-container">
  <div class="image-fade-container">
    <img src="img/flower.png" class="image-fade active">
    <img src="img/apple.png" class="image-fade active">
    <img src="img/apricot.jpg" class="image-fade active">
    <p class="fade-text">Get 50% discount from all these amazing things <br> when you shop goods worth above $500</p>
  </div>
</div>
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
<div class="section-tittle section-tittle2 text-center mb-70 ms-40">
                                            <h2>Trending Items </h2>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row" style="background-color:lightgray;">
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30">
                                            <div class="team-img">
                                                <img src="img/carrots.jfif" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $80</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $60</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Carrots</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30">
                                            <div class="team-img">
                                                <img src="img/apple.png" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $20</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $18</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Apples</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/kales.jpg" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $20</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $18</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Kales</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/cabbage.jpg" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $35</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $30</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Cabbage</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/avo.webp" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $15</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $12</li><br>
                                                    <li style="font-size:30px; color:black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Avocado</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/milk.jpg" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $60</strike></li><br>
                                                    <li style="font-size:50px; color:black;">now  $55</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">milk</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/brocolli.jpg" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $20</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $18</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Brocolli</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/cucumber.jpg" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $90</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $83</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Cucumber</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/rose flower.jfif" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $200</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $150</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Rose Flower</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/daisy.jfif" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $220</strike></li><br>
                                                    <li style="font-size:50px; color:black;">now  $210</li><br>
                                                    <li style="font-size:30px; color: black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Daisy Flower</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/cala lily.jfif" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $180</strike></li><br>
                                                    <li style="font-size:50px; color: black;">now  $155</li><br>
                                                    <li style="font-size:30px; color:black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Cala lily</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="single-team mb-30" >
                                            <div class="team-img" style="background-color: ;">
                                                <img src="img/colorful.jfif" alt="" height="250px">
                                                <!-- Blog Social -->
                                                <ul class="team-social">
                                                    
                                                    <li style="font-size:50px; color: black;"><strike> was  $300</strike></li><br>
                                                    <li style="font-size:50px; color:black;">now  $280</li><br>
                                                    <li style="font-size:30px; color:black;"> Add to cart<a href="#"><img src="img/cart2.png" alt=""></a></li><br>
                                                    
                                                </ul>
                                            </div>
                                            <div class="team-caption">
                                                <p style="font-size:30px;color:white; ; background-color: lime;">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Bunch</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
                        <!-- Team Ara End -->
                        <!-- Want To work -->
                        
                                </section>

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
                <i class="bi bi-circle"></i><span>Edit profile</span>
              </a>
            </li>
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
  
       <!-- <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Manage Employees</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="tables-general.html">
                <i class="bi bi-circle"></i><span>Profile Information</span>
              </a>
            </li>
            <li>
              <a href="tables-data.html">
                <i class="bi bi-circle"></i><span>Register Employee</span>
              </a>
            </li>
          </ul>
        </li><!-- End employees Nav -->
  
       <!-- <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-bar-chart"></i><span>Manage Customers</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="charts-chartjs.html">
                <i class="bi bi-circle"></i><span>Profile Information</span>
              </a>
            </li>
            <li>
              <a href="charts-apexcharts.html">
                <i class="bi bi-circle"></i><span>Order Details</span>
              </a>
            </li>
            <li>
              <a href="charts-echarts.html">
                <i class="bi bi-circle"></i><span>Delivery Details</span>
              </a>
            </li>
          </ul>
        </li><!-- End customers Nav -->
  
        <!--<li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Manage Payments</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="icons-bootstrap.html">
                <i class="bi bi-circle"></i><span>Payment Details</span>
              </a>
            </li>
            <li>
              <a href="icons-remix.html">
                <i class="bi bi-circle"></i><span>Order Details</span>
              </a>
            </li>
          </ul>
        </li><!-- End Payment Nav -->
  
        <!--<li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Manage Orders</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="icons-bootstrap.html">
                <i class="bi bi-circle"></i><span>Order Details</span>
              </a>
            </li>
          </ul>
        </li><!-- End Order Nav -->
  
       <!--<li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Manage Delivery</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="icons-bootstrap.html">
                <i class="bi bi-circle"></i><span>Delivery Details</span>
              </a>
            </li>
          </ul>
        </li><!-- End Delivery Nav -->
  
    <!-- Content area -->
    
    <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- Add this script tag at the end of the body section -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>


    
    <script src="script.js"></script>
</body>
</html>
