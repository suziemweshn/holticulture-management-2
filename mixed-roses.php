<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include  'conn.php';
// Retrieve products from the database
$query = "SELECT * FROM mixed_roses";
$result = mysqli_query($conn, $query);

// Fetch and store products in an array
$mixed_roses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $mixed_roses[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!-- User Page HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="css/task6.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<header>
        <!-- Header Start -->
        <div class="header-area mb-20">
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
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.html"><img src="img/org.png" alt="" height="50px"></a> AHF
                                    
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper  d-flex align-items-center justify-content-end">
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
                                                <li><a href="#">Portals</a>
                                                  <ul class="submenu">
                            <li><a href="pages-login.html">Admin Portal</a></li>
                            <li><a href="employee-login.html">Employee portal</a></li>
                            
                            
                         </ul>
                                                 </li>
                                                 <li><a href="category.html">My account</a>
                                                  <ul class="submenu">
                            <li><a href="datascience.html">Log in</a></li>
                            <li><a href="ai.html">Sign up</a></li>
                            
                         </ul>
                                                 </li>
                                                 <li><a href="Blog.html">Blog</a></li>
                                                
                                                <li><a href="contact.html">Contacts</a></li>
                                                
                                            </ul>
                                            <div class="search">
                                                <form class="d-flex">
                                                    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
    
        <ul id="myMenu">
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
        <!-- Header End -->
    <h1 class="text-center">Mixed Roses</h1>
    
    <!-- Display Products -->
<section class="product-display ">
    <div class="container-fluid">
    <?php foreach ($mixed_roses as $product): ?>
        <div class="product-list ">
        <?php if (!empty($product['image'])): ?>
                        <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" class="  img-fluid rounded-circle">
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                    <div class="product-details mt-5">
                    <?php echo $product['name']?><br>
                    <hr>
                     <?php echo $product['description']?>
                        <hr>
                        <?php echo $product['price']?>   USD
                        <hr>
                        <button type="submit">Add to cart</button>
                        <hr>

                    </div>
                    </div>
                    <?php endforeach; ?>
                    
                    </div>
    </section>
    <!--<div class="row d-flex ">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class=" ">
            <?php foreach ($products as $product): ?>
                <div class="card-img-top">

                    <?php if (!empty($product['image'])): ?>
                        <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" width="100">
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                    <div class="card-body">
                    
                    <div class="card-text">
                        <?php echo $product['name']?>
                        <?php echo $product['description']?>
                        <?php echo $product['price']?>

                    </div>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
                    </div>

       <!-- <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td>
                    <?php if (!empty($product['image'])): ?>
                        <img src="product-images/<?php echo $product['image']; ?>" alt="Product Image" width="100">
                    <?php else: ?>
                        No Image Available
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>-->
</body>
</html>
                