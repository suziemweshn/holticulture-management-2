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
            <img src="img/org.png" alt="Logo" >AKIMA
        </div>
        <div class="list">
            <ul class="">
                <li><a href="#"><?php echo $username?></a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
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
    <aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item ">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
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
    <!--<div class="content">
        <h1>Welcome to the Customer Profile</h1>
        <p>This is the main content area of your page.</p>
    </div>
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
