<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include  'conn.php';

/* Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button was clicked
    if (isset($_POST['delete'])) {
        $countryId = $_POST['delete'];

        // Delete the country from the database
        $deleteQuery = "DELETE FROM roses WHERE id = $countryId";
        mysqli_query($conn, $deleteQuery);

        // Delete the country image file (optional)
        // Assuming the images are stored in the directory '/main project/country-images/'
        //$targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/country-images/';
      //  $countryImage = $_POST['image']; // Retrieve the image name from the form
      //  $countryImagePath = $targetDirectory . $countryImage;
       // if (file_exists($countryImagePath)) {
          //  unlink($countryImagePath);
        
    }

    // Check if the edit button was clicked
    if (isset($_POST['edit'])) {

        
       
        echo $country['name'];
        echo $country['description'];
        echo $country['price'];
        echo $country['image'];
        

        // Update the country in the database
        $updateQuery = "UPDATE roses SET name = '$name', description = '$description', price = $price WHERE id = $countryId";
        mysqli_query($conn, $updateQuery);
    }
*/
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button was clicked
    if (isset($_POST['delete'])) {
        $country_id = $_POST['delete'];

        // Delete the country from the database
        $deleteQuery = "DELETE FROM  country WHERE country_id = $country_id";
        mysqli_query($conn, $deleteQuery);

        // Delete the country image file (optional)
        // Assuming the images are stored in the directory '/main project/country-images/'
       /* $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/main project/country-images/';
        $countryImage = $_POST['image']; // Retrieve the image name from the form
        $countryImagePath = $targetDirectory . $countryImage;
        if (file_exists($countryImagePath)) {
            unlink($countryImagePath);*/
        }
    }

    // Check if the edit button was clicked
    if (isset($_POST['edit'])) {
        $country_id = $_POST['edit'];
        
        // Retrieve the updated form data
        $name = $_POST['name'];
       

        // Update the country in the database
        $updateQuery = "UPDATE country SET country_name = '$name'  WHERE country_id = $country_id";
        mysqli_query($conn, $updateQuery);
    }



    // Handle add country form submission
    if (isset($_POST['add'])) {
        // Retrieve form data
        $name = $_POST['name'];
        $Country_id=uniqid();
    
        // Insert the country into the countries table
        $query = "INSERT INTO country (country_name) VALUES ('$name')";
        
        if (mysqli_query($conn, $query)) {
            echo "Country added successfully";
        } else {
            echo "Error adding country: " . mysqli_error($conn);
        }
    }
    $query = "SELECT * FROM country";
$result = mysqli_query($conn, $query);

// Fetch and store countrys in an array
$countries = [];
while ($row = mysqli_fetch_assoc($result)) {
    $countries[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Admin Page HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/task6.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .update-button button{
            background-color:lime;
  color: white;
  font-size: 20px;
  width: 60%;
        }
    </style>
</head>
<body>

    <div class="heading mt-20 mb-20">
        <h3>Country Registration</h3>
    </div>

    <!-- Add Product Form -->
    <div class="container w-100">
        <div class="country-form">
            <form method="POST" action="country.php" class="d-flex flex-row flex-wrap mt-20" >
                <div class="w-100 mb-10 ms-20">
                    <label for="name" class="w-10 display-8 fw-bold">Country Name:</label>
                    <input type="text" class="ms-10" name="name" id="name" required><br>
                </div>
               
                <div class="product-button">
                    <button type="submit" name="add">Add Product</button>
                </div>
            </form>
        </div>

       
        <!-- Display Products -->
<h2 class="text-center">Country List</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="mx-auto">Country Name</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach ($countries as $country): ?>
            <tr>
                <td><?php echo $country['country_name']; ?></td>
                
                
                <td>
                <form method="POST" action="country.php" class="update-button">
                    <input type="hidden" name="delete" value="<?php echo $country['country_id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this country?')">Delete</button>
                </form>

                <form method="POST" action="country.php" class="update-button">
                    <input type="hidden" name="edit" value="<?php echo $country['country_id']; ?>">
                    <div class="w-100 mb-10 ms-20">
                        <label for="name" class="w-10 display-8 fw-bold">Country Name:</label>
                        <input type="text" class="ms-10" name="name" id="name" value="<?php echo $country['country_name']; ?>" required><br>
                    </div>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

    </div>
</body>
</html>


