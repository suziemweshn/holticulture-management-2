<?php
session_start();

// Check if the user is logged in
include 'conn.php';
include 'oauth.php';



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
                <a href="cart3.php"><img src="img/cart2.png" alt="" height="50px" width="40px"> cart</a> 
  </div>
        <div class="list">
            <ul class="">
            <li class="nav-item dropdown pe-3">
  <a class="nav-link nav-profile d-flex align-items-center justify-content-end" href="#" data-bs-toggle="dropdown">
  <img src=img/person (2).png  alt="" class="rounded-circle">
  <div class="text1">
  <p class=" neonText d-none d-md-block dropdown-toggle ps-2">  <img src=img\person3.png alt="" width="70px" height="30px">Hi <?php echo ($username)?></p>
  </div>
   
  </a>
  
  <ul class="profile dropdown-menu dropdown-menu-end dropdown-menu-arrow  ">
    <li class="dropdown-header">
      <h6> </h6>
      <span> </span>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li>
      <a class="dropdown-item d-flex align-items-center " href="pages-login.html">
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
      <a class="dropdown-item d-flex align-items-center" href="out.php">
        <i class="bi bi-box-arrow-right"></i>
        <span>Sign Out</span>
      </a>
    </li> 
  </ul><!-- End Profile Dropdown Items 
</li>-->


  <!-- Your HTML code here -->




  
                
           
        
       
       
    </div>
  </div>
  <!--<div class="dropdown-list">
<div class="dropdown">

  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
  </div>
  </div>-->
    
   
    <div class="content1">
        <!--<h1>Welcome to the Customer Profile</h1>
        <p>This is the main content area of your page.</p>-->
        
    </div>
    <div class="content2">
    
<div id="slideshow" class="image-container">
  <div class="image-fade-container">
    <img src="img/flower.png" class="image-fade active">
    <img src="img/apple.png" class="image-fade active">
    <img src="img/apricot.jpg" class="image-fade active">
    <p class="neonText fade-text">Get 50% discount from all these amazing things <br> when you shop goods worth above $500</p>
  </div>
</div>

<section class="trend " style="background-color: gray;">
                       
                        <div class="team-area  pb-160">
                            <div class="container-fluid" style="background-color:lightgray;">
                                <div class="row justify-content-center">
                                    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10">
                                        <!-- Section Title -->
                                        <div class="section-tittle section-tittle2 text-center mb-70">
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;"class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;"class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
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
                                                <p style="font-size:30px;color:white; ; background-color: lime;" class="neonText">New</p>
                                                
                                                
                                                <h3><a href="instructor.html">Bunch</a></h3>
                                                
                                            </div>
                                        </div>
                                    </div>
<!--<script>
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
</script>-->

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
  <script src="js/main.js"></script>
  <!-- Add this script tag at the end of the body section -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    
    <script src="script.js"></script>
</body>
</html>
