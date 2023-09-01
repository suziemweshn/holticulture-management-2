<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include  'conn.php';


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button was clicked
    if (isset($_POST['delete'])) {
        $location_id = $_POST['delete'];

        // Delete the location from the database
        $deleteQuery = "DELETE FROM  location WHERE location_id = $location_id";
        mysqli_query($conn, $deleteQuery);
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Country added successfully";
        } else {
            echo "Error adding location: " . mysqli_error($conn);
        }

        
        }
    }

    // Check if the edit button was clicked
    if (isset($_POST['edit'])) {
        $location_id = $_POST['edit'];
        
        // Retrieve the updated form data
        $location_name = $_POST['location_name']; // Use 'location_name' instead of 'name'
        $city_id = $_POST['city_id'];
        
        // Update the city in the database
        $updateQuery = "UPDATE location SET location_name = '$location_name', city_id = '$city_id' WHERE location_id = $location_id";
        
        if (mysqli_query($conn, $updateQuery)) {
            echo "City updated successfully";
        } else {
            echo "Error updating city: " . mysqli_error($conn);
        }
    }
    

    // Handle add location form submission
    if (isset($_POST['add'])) {
        // Retrieve form data
        $location_name = $_POST['location_name']; // Use 'location_name' instead of 'name'
        $city_id = $_POST['city_id'];
        
        // Insert the city into the location table
        $query = "INSERT INTO location (location_name, city_id) VALUES ('$location_name', '$city_id')";
        
        if (mysqli_query($conn, $query)) {
            echo "City added successfully";
        } else {
            echo "Error adding city: " . mysqli_error($conn);
        }
    }
    $query = "SELECT * FROM location";
$result = mysqli_query($conn, $query);

// Fetch and store locations in an array
$location = [];
while ($row = mysqli_fetch_assoc($result)) {
    $location[] = $row;
}
$locationQuery = "SELECT * FROM cities";
$locationResult = mysqli_query($conn, $locationQuery);

// Fetch and store countries in an array
$cities = [];
while ($citiesRow = mysqli_fetch_assoc($locationResult)) {
    $cities[] = $citiesRow;
}
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
        <h3>Locattion Registration</h3>
    </div>

    <!-- Add Product Form -->
    <div class="container w-100">
        <div class="location-form">
            <form method="POST" action="location.php" class="d-flex flex-row flex-wrap mt-20" >
            <!-- ... -->
<div class="container w-100">
    <div class="location-form">
        <form method="POST" action="location.php" class="d-flex flex-row flex-wrap mt-20">
            <div class="w-100 mb-10 ms-20">
                <label for="location_name" class="w-10 display-8 fw-bold">location Name:</label>
                <input type="text" class="ms-10" name="location_name" id="location_name" required><br>
            </div>
            <div class="w-100 mb-10 ms-20">
                <label for="location_id" class="w-10 display-8 fw-bold">City id:</label>
                <select name="city_id" id="city_id">
                    <?php foreach ($cities as $city): ?>
                        <option value="<?php echo $city['city_id']; ?>"><?php echo $city['city_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
           
            <div class="product-button">
                <button type="submit" name="add">Add location</button>
            </div>
        </form>
    </div>

    <!-- ... -->
</div>


       
        <!-- Display Products -->
<h2 class="text-center">City List</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="mx-auto">City Name</th>
           
           
        </tr>
    </thead>
    <tbody>
        <?php foreach ($location as $location): ?>
            <tr>
                <td><?php echo $location['location_name']; ?></td>
                <td><?php echo $location['location_id'];?></td>
                
                
                <td>
                <form method="POST" action="location.php" class="update-button">
                    <input type="hidden" name="delete" value="<?php echo $location['location_id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this location?')">Delete</button>
                </form>

                <form method="POST" action="location.php" class="update-button">
                    <input type="hidden" name="edit" value="<?php echo $location['location_id']; ?>">
                    <div class="w-100 mb-10 ms-20">
                        <label for="name" class="w-10 display-8 fw-bold">location Name:</label>
                        <input type="text" class="ms-10" name="name" id="name" value="<?php echo $location['location_name']; ?>" required><br>
                    </div>
                    <div class="w-100 mb-10 ms-20">
                        <label for="name" class="w-10 display-8 fw-bold">City id:</label>
                        
                        <input type="text" class="ms-10" name="location_name" id="name" value="<?php echo $location['city_id']; ?> "; ?> <br>
                     
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


