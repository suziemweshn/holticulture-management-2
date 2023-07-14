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
$stmt = $conn->prepare("SELECT * FROM Customer_table WHERE username = ?");
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

   // $profilePictureData = $row['profilePictureData'] ?? '';

} else {
   
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
     <!-- Google Fonts -->
  <!--<link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
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
 


</head>
<body>
   <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="img/org.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area ">
            <div class="main-header ">
                <div class="header-top d-none d-lg-block">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">
                                    <ul>     
                                        <li>Email: Akimafarm@gmail.com</li>
                                    </ul>
                                    <div class="header-social">    
                                        <ul>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a  href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container ">
                        <div class="row align-items-center  " style="margin-left:400px">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.html"><img src="img/org.png" alt="" height="50px"></a> AHF
                                    
                                </div>
                            </div>
                            <div class="search-bar">
                                                <form class="d-flex">
                                                    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
    
                            <div class="col-xl-10 col-lg-10 ">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end ">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li><a href="index.html">Home</a></li>
                                                <li><a href="index.html#about">About</a></li>
                                                <li><a href="">Products</a>
                                                 <ul class="submenu">
                           <li><a href="flowers.html">Flowers</a></li>
                           <li><a href="vegetable.html">Vegetables</a></li>
                           <li><a href="fruits.html">Fruits</a></li>
                           <li><a href="dairy.html">Dairy Products</a></li>
                           
                        </ul>
                                                </li>
                                                
                                                 <li><?php echo $username ?></a>
                                                  <ul class="submenu">
                            <li><a href="datascience.html">Log in</a></li>
                            <li><a href="ai.html">Sign up</a></li>
                            
                         </ul>
                                                 </li>
                                                
                                            </ul>
                                           <!-- <div class="search">
                                                <form class="d-flex">
                                                    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
    
        <ul id="myMenu">-->
         <!-- <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Products</a></li>
          <li><a href="#">Portals</a></li>
          <li><a href="#">Account</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Contacts</a></li>-->
          
        </ul>
                                                    
                                                  </form>
                                            </div>
                                           
                                        </nav>
                                       
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--<div class="side-bar d-flex flex-column ms-0">
      <ul>
        <li> Home</li>
        <li>products</li>
        <li>about</li>
      </ul>

    </div>
    <div class="side-bar d-flex flex-column ms-0">
      <ul>
        <li> Home</li>
        <li>products</li>
        <li>about</li>
      </ul>

    </div>-->
    <div class="side-bar d-flex flex-column ms-0">
      <ul>
        <li> Home</li>
        <li>products</li>
        <li>about</li>
      </ul>

    </div>
    <header class="header">
        <div class="header_in">
          <button type="button" class="toggle" id="toggle">
            <span></span>
           </button>
       </div>
     </header>
     
     <div class="sidebar" id='sidebar'>
       <ul>
         <li><a href="">Home</a></li>
          <li><a href="">About</a></li>
           <li><a href="">Contact</a></li>
       </ul>
     </div>
     <script src="js/app.js"></script>
   <!-- <section class="trend " style="background-color: gray;">
                       
                       <div class="team-area  pb-160">
                           <div class="container-fluid" style="background-color:lightgray;">
                               <div class="row justify-content-center">
                                   <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10">
                                       <!-- Section Title -->
                                       <div class="section-tittle section-tittle2 text-center mb-70">
                                          <!-- <h2>Trending Items </h2>
                                       </div> 
                                   </div>
                               </div>
                               <div class="row" style="background-color:lightgray;">
                                   <div class="col-lg-3 col-md-6 col-sm-6">
                                       <div class="single-team mb-30">
                                           <div class="team-img">
                                               <img src="img/carrots.jfif" alt="" height="250px">
                                               <!-- Blog Social -->
                                              <!-- <ul class="team-social">
                                                   
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
                                              <!-- <ul class="team-social">
                                                   
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
                                            <!-- <ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
                                               <!--<ul class="team-social">
                                                   
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
<!--<header id="header" class="header  d-flex flex-row ">

<!-- <div class="d-flex align-items-center justify-content-between">
   
   <a href="Admin-portal.html" class="logo d-flex align-items-center">
     <img src="Admin\assets\img\product-1.jpg" alt="">
   
 <span class="d-none d-lg-block">AHF</span>
   </a>
   <i class="bi bi-list toggle-sidebar-btn"></i>
 </div> End Logo
 <div class="col-xl-2 col-lg-2">
   <div class="logo">
       <a href="customer-profile.php"><img src="assets/img/org2.png" alt="" ></a> AHF
       
   </div>
</div>

<div class="search-bar">
  <form class="search-form d-flex align-items-center justify-content-center mt-3" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->





<!--<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="assets/img/org2.png" alt="">
    <span class="d-none d-lg-block">AHF</span>
  </a>
 <!-- <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->


</div><!-- End Search Bar 

   
</div>
<nav class="header-nav ms-auto me-20">
      <ul class="d-flex align-items-center flex-row-reverse ">


<li class="nav-item dropdown pe-3">
  
  <a class="nav-link nav-profile d-flex align-items-center pe-20 justify-content-end" href="customer-profile.php" data-bs-toggle="dropdown">
   
    <span class="d-none d-md-block dropdown-toggle ps-2">Welcome <?php echo $username; ?></span>
  </a>
 
  
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
    <li class="dropdown-header">
      <h6> </h6>
      <span> </span>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li>
      <a class="dropdown-item d-flex align-items-center" href="customer-profile.php">
        <i class="bi bi-person"></i>
        <span>My Profile</span>
      </a>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    
    <li>
      <a class="dropdown-item d-flex align-items-center" href="#">
        <i class="bi bi-gear"></i>
        <span>Account Settings</span>
      </a>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    
    <li>
      <a class="dropdown-item d-flex align-items-center" href="pages-faq.php">
        <i class="bi bi-question-circle"></i>
        <span>Need Help?</span>
      </a>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    
    <li>
      <a class="dropdown-item d-flex align-items-center" href="pages-login.html">
        <i class="bi bi-box-arrow-right"></i>
        <span>Sign Out</span>
      </a>
    </li>
  </ul><!-- End Profile Dropdown Items -->
</li><!-- End Profile Nav -->
<!--</header>
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav">

  <!-- Dashboard -->
  <!--<li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
      <i class="bi bi-speedometer2"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

    <!--<li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>View Products</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="Flowers-Admin.html">
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

    <!--<li class="nav-item">
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

    <!--<<li class="nav-item">
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
    </li><!-- End Delivery Nav-->

    <!-- Pages -->

    <!--<li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="customer-profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <!--<li class="nav-item">
      <a class="nav-link collapsed" href="pages-faq.php">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

   <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="pages-contact.html">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Contact Page Nav -->

    
    <!--<li class="nav-item">
      <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
      </a>
    </li><!-- End Login Page Nav -->

    <!--<li class="nav-item">
      <a class="nav-link collapsed" href="pages-error-404.html">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li><!-- End Error 404 Page Nav -->

    <!--<li class="nav-item">
      <a class="nav-link collapsed" href="pages-blank.html">
        <i class="bi bi-file-earmark"></i>
        <span>Blank</span>
      </a>
    </li><!-- End Blank Page Nav -->

  <!--</ul>

<!--</aside><!-- End Sidebar-->
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
  <!--<script src="assets/js/main.js"></script>
  <!-- Add this script tag at the end of the body section -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>


</body>
</html>
