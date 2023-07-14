
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['USER_NAME'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: pages-login.php');
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
$USER_NAME = isset($_SESSION['USER_NAME']) ? $_SESSION['USER_NAME'] : '';

// Retrieve user profile details from the admin_table
$stmt = $conn->prepare("SELECT * FROM admin_table WHERE USER_NAME = ?");
$stmt->bind_param("s", $USER_NAME);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jobTitle = $row['jobTitle'] ?? '';
    $company = $row['company'] ?? '';
    $country = $row['country'] ?? '';
    $Address = $row['Address'] ?? '';
    $Phone = $row['Phone'] ?? '';
    $email = $row['email'] ?? '';
    $twitterProfile = $row['twitterProfile'] ?? '';
    $instagramProfile = $row['instagramProfile'] ?? '';
    $facebookProfile = $row['facebookProfile'] ?? '';
    $linkedinProfile = $row['linkedinProfile'] ?? '';
    $ADMIN_NAME = $row['ADMIN_NAME'] ?? '';
    $ADMIN_ID = $row['ADMIN_ID'] ?? '';
    $ROLE_ID = $row['ROLE_ID'] ?? '';
    $about = $row['about'] ?? '';
    $PASS_WORD = $row['PASS_WORD'] ?? '';
    $profilePictureData = $row['profilePictureData'] ?? '';
    $changesMade = $row['changesMade'] ?? '';
    $newProducts = $row['newProducts'] ?? '';
    $USER_NAME = $row['USER_NAME'] ?? '';
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
  <meta content="" name="keywords">
   
  <title>Users / Profile - AHF Admin</title>
  

  <!-- Favicons -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
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

  
<header id="header" class="header  d-flex flex-row ">

<!-- <div class="d-flex align-items-center justify-content-between">
   
   <a href="Admin-portal.html" class="logo d-flex align-items-center">
     <img src="Admin\assets\img\product-1.jpg" alt="">
   
 <span class="d-none d-lg-block">AHF</span>
   </a>
   <i class="bi bi-list toggle-sidebar-btn"></i>
 </div> End Logo -->
 <div class="col-xl-2 col-lg-2">
   <div class="logo">
       <a href="Admin.html"><img src="assets/img/org2.png" alt="" ></a> AHF
       
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


</div><!-- End Search Bar -->
<nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center flex-row-reverse">

        <!--<li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
       
<li class="nav-item dropdown pe-3">
  <a class="nav-link nav-profile d-flex align-items-center pe-0 justify-content-end" href="#" data-bs-toggle="dropdown">
  <img src=<?php echo $profilePictureData; ?> alt="Profile" class="rounded-circle">
    <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $ADMIN_NAME; ?></span>
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
      <a class="dropdown-item d-flex align-items-center" href="profile.php">
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
</header>
  <!-- End Profile Dropdown Items -->
</li><!-- End Profile Nav -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="users-profile.html">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Manage Products</span><i class="bi bi-chevron-down ms-auto"></i>
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

      <li class="nav-item">
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

      <li class="nav-item">
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

      <li class="nav-item">
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

      <li class="nav-item">
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

      <li class="nav-item">
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

      <!-- Pages -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.php">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

 

  <section class="section-profile">
    
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <div class="row ">
        <label for="profileImage " ></label>
        <div class="col-md-8 col-lg-9  mx-auto">
        <img src=<?php echo $profilePictureData?> alt="Profile" class="rounded-circle h-45 w-50 ">
          
        </div>
    </div>

           <h2><?php echo $ADMIN_NAME; ?></h2>
            <h3><?php echo $jobTitle; ?></h3>

            
            <div class="social-links ">
              <a href="<?php echo $twitterProfile; ?>" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="<?php echo $facebookProfile; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="<?php echo $instagramProfile; ?>" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="<?php echo $linkedinProfile; ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

   
      
      <div class="col-xl-8">
      <div class="card">
          <div class="card-body">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <form action="edit-profile.php " method="POST">
            <div class="tab-content pt-2">

<div class="tab-pane fade show active profile-overview" id="profile-overview">
  <h5 class="card-title">About</h5>
  <p class="small fst-italic"><?php echo $about; ?></p>

  <h5 class="card-title">Profile Details</h5>

  <div class="row">
    <div class="col-lg-3 col-md-4 label">Full Name</div>
    <div class="col-lg-9 col-md-8"><?php echo $ADMIN_NAME; ?></div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-4 label">Company</div>
    <div class="col-lg-9 col-md-8"><?php echo $company; ?></div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-4 label">Job</div>
    <div class="col-lg-9 col-md-8"><?php echo $jobTitle; ?></div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-4 label">Country</div>
    <div class="col-lg-9 col-md-8"><?php echo $country; ?></div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-4 label">Address</div>
    <div class="col-lg-9 col-md-8"><?php echo $Address; ?></div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-4 label">Phone</div>
    <div class="col-lg-9 col-md-8"><?php echo $Phone; ?></div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-4 label">Email</div>
    <div class="col-lg-9 col-md-8"><?php echo $email; ?></div>
  </div>
</div>

            </form>
           
              <div class="tab-pane fade" id="profile-edit">
                <h5 class="card-title">Edit Profile</h5>
               
   
    
                <form action="profile-picture.php" method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"> profile</label>
        <div class="col-md-8 col-lg-9">
             <?php
            // Check if the profile image path is set in session
           /* if (isset($_SESSION['profileImagePath'])) {
                $profileImagePath = $_SESSION['profileImagePath'];
                echo '<img id="profileImg" src="' . $profileImagePath . '" alt="Profile">';
            } else {
                // Fetch the profilePictureData field from the admin table
                $ADMIN_ID = $_SESSION['ADMIN_ID']; // Assuming you have stored the admin ID in session
                $sql = "SELECT profilePictureData FROM admin_table WHERE ADMIN_ID = $ADMIN_ID";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $profilePictureData = $row['profilePictureData'];
                    echo '<img id="profileImg" src="' . $profilePictureData . '" alt="Profile">';
                } else {
                    echo '<img id="profileImg" src="assets/img/profile-img.jpg" alt="Profile">';
                }
            }*/
            ?>
            

            <div class="p-2 d-flex">
                <label for="profileUpload" class="btn btn-primary btn-sm me-4" title="Upload new profile image"><i class="bi bi-upload"></i></label>
                <button type="submit" class="btn btn-primary btn-sm me-4" title="Save profile image" id="saveButton"><i class="bi bi-save"></i> Save</button>
                <button id="removeProfile" class="btn btn-danger btn-sm me-4" title="Remove my profile image"><i class="bi bi-trash"></i></button>
            </div>
            
        </div>
    </div>
    <input type="file" id="profileUpload" style="display: none" name="profileImage">
</form>

    
<form action="edit-profile.php" method="POST" class="profile-form">
    <div class="row mb-3">
        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
        <div class="col-md-8 col-lg-9">
            <input name="ADMIN_NAME" type="text" class="form-control" id="fullName" value="<?php echo htmlspecialchars($ADMIN_NAME); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">User Name</label>
        <div class="col-md-8 col-lg-9">
            <input name="USER_NAME" type="text" class="form-control" id="fullName" value="<?php echo htmlspecialchars($USER_NAME); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
        <div class="col-md-8 col-lg-9">
            <textarea name="about" class="form-control" id="about" style="height: 100px"><?php echo htmlspecialchars($about); ?></textarea>
        </div>
    </div>

    <div class="row mb-3">
        <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
        <div class="col-md-8 col-lg-9">
            <input name="company" type="text" class="form-control" id="company" value="<?php echo htmlspecialchars($company); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
        <div class="col-md-8 col-lg-9">
            <input name="jobTitle" type="text" class="form-control" id="Job" value="<?php echo htmlspecialchars($jobTitle); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
        <div class="col-md-8 col-lg-9">
            <input name="country" type="text" class="form-control" id="Country" value="<?php echo htmlspecialchars($country); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
        <div class="col-md-8 col-lg-9">
            <input name="Address" type="text" class="form-control" id="Address" value="<?php echo htmlspecialchars($Address); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
        <div class="col-md-8 col-lg-9">
            <input name="Phone" type="number" class="form-control" id="Phone" value="<?php echo htmlspecialchars($Phone); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
        <div class="col-md-8 col-lg-9">
            <input name="email" type="email" class="form-control" id="Email" value="<?php echo htmlspecialchars($email); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
        <div class="col-md-8 col-lg-9">
            <input name="twitterProfile" type="text" class="form-control" id="Twitter" value="<?php echo htmlspecialchars($twitterProfile); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
        <div class="col-md-8 col-lg-9">
            <input name="facebookProfile" type="text" class="form-control" id="Facebook" value="<?php echo htmlspecialchars($facebookProfile); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
        <div class="col-md-8 col-lg-9">
            <input name="instagramProfile" type="text" class="form-control" id="Instagram" value="<?php echo htmlspecialchars($instagramProfile); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
        <div class="col-md-8 col-lg-9">
            <input name="linkedinProfile" type="text" class="form-control" id="Linkedin" value="<?php echo htmlspecialchars($linkedinProfile); ?>">
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary" id="saveChanges">Save Changes</button>
        <script>
    // Wait for the DOM to load
    document.addEventListener("DOMContentLoaded", function() {
        // Get a reference to the "Save Changes" button
        var saveChangesBtn = document.getElementById("saveChanges");

        // Add an event listener to enable the button on form input
        document.querySelector(".profile-form").addEventListener("input type=[text], input type=[email]", function() {
            saveChangesBtn.disabled = false;
        });
    });
</script>

    </div>
    

</form>


              </div>

              <div class="tab-pane fade" id="profile-settings">
    <h5 class="card-title">Settings</h5>
    <form action="update-notification.php" method="POST">

        <?php if (isset($_SESSION['success_message'])): ?>
            <p class="success-message"><?php echo $_SESSION['success_message']; ?></p>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <!-- Display error message -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <p class="error-message"><?php echo $_SESSION['error_message']; ?></p>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
            <div class="col-md-8 col-lg-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="changesMade" name="changesMade" <?php if ($changesMade) echo "checked"; ?>>
                    <label class="form-check-label" for="changesMade">
                        Changes made to your account
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="newProducts" name="newProducts" <?php if ($newProducts) echo "checked"; ?>>
                    <label class="form-check-label" for="newProducts">
                        Information on new products and services
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit" id="saveChangesBtn" class="btn btn-primary" disabled>Save Changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const saveChangesBtn = document.getElementById('saveChangesBtn');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            saveChangesBtn.disabled = false;
        });
    });
</script>





<div class="tab-pane fade" id="profile-change-password">
    <h5 class="card-title">Change Password</h5>
    <form action="change-password.php" method="POST">

        <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="newPassword" type="password" class="form-control" id="newPassword" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Change Password</button>
        </div>
    </form><!-- End Change Password Form -->
</div>

            </div>
          </div>
        </div>

       
      </div>

    </div>


      
  </section>
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



</body>

</html>
