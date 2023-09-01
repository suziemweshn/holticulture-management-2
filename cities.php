<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include  'conn.php';


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete button was clicked
    if (isset($_POST['delete'])) {
        $city_id = $_POST['delete'];

        // Delete the cities from the database
        $deleteQuery = "DELETE FROM  cities WHERE city_id = $city_id";
        mysqli_query($conn, $deleteQuery);
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Country added successfully";
        } else {
            echo "Error adding cities: " . mysqli_error($conn);
        }

        
        }
    }

    // Check if the edit button was clicked
    if (isset($_POST['edit'])) {
        $city_id = $_POST['edit'];
        
        // Retrieve the updated form data
        $city_name = $_POST['city_name']; // Use 'city_name' instead of 'name'
        $country_id = $_POST['country_id'];
        
        // Update the city in the database
        $updateQuery = "UPDATE cities SET city_name = '$city_name', country_id = '$country_id' WHERE city_id = $city_id";
        
        if (mysqli_query($conn, $updateQuery)) {
            echo "City updated successfully";
        } else {
            echo "Error updating city: " . mysqli_error($conn);
        }
    }
    

    // Handle add cities form submission
    if (isset($_POST['add'])) {
        // Retrieve form data
        $city_name = $_POST['city_name']; // Use 'city_name' instead of 'name'
        $country_id = $_POST['country_id'];
        
        // Insert the city into the cities table
        $query = "INSERT INTO cities (city_name, country_id) VALUES ('$city_name', '$country_id')";
        
        if (mysqli_query($conn, $query)) {
            echo "City added successfully";
        } else {
            echo "Error adding city: " . mysqli_error($conn);
        }
    }
    $query = "SELECT * FROM cities";
$result = mysqli_query($conn, $query);

// Fetch and store citiess in an array
$cities = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cities[] = $row;
}
$countryQuery = "SELECT * FROM country";
$countryResult = mysqli_query($conn, $countryQuery);

// Fetch and store countries in an array
$countries = [];
while ($countryRow = mysqli_fetch_assoc($countryResult)) {
    $countries[] = $countryRow;
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
        <h3>City Registration</h3>
    </div>

    <!-- Add Product Form -->
    <div class="container w-100">
        <div class="cities-form">
            <form method="POST" action="cities.php" class="d-flex flex-row flex-wrap mt-20" >
            <!-- ... -->
<div class="container w-100">
    <div class="cities-form">
        <form method="POST" action="cities.php" class="d-flex flex-row flex-wrap mt-20">
            <div class="w-100 mb-10 ms-20">
                <label for="city_name" class="w-10 display-8 fw-bold">City Name:</label>
                <input type="text" class="ms-10" name="city_name" id="city_name" required><br>
            </div>
            <div class="w-100 mb-10 ms-20">
                <label for="country_id" class="w-10 display-8 fw-bold">Country Name</label>
                <select name="country_id" id="country_id">
                    <?php foreach ($countries as $country): ?>
                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
           
            <div class="product-button">
                <button type="submit" name="add">Add City</button>
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
            <th class="mx-auto">Country Name</th>
           
           
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cities as $city): ?>
            <tr>
                <td><?php echo $city['city_name']; ?></td>
                <td><?php echo $city['city_id'];?></td>
                
                
                <td>
                <form method="POST" action="cities.php" class="update-button">
                    <input type="hidden" name="delete" value="<?php echo $city['city_id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this cities?')">Delete</button>
                </form>

                <form method="POST" action="cities.php" class="update-button">
                    <input type="hidden" name="edit" value="<?php echo $city['city_id']; ?>">
                    <div class="w-100 mb-10 ms-20">
                        <label for="name" class="w-10 display-8 fw-bold">City Name:</label>
                        <input type="text" class="ms-10" name="name" id="name" value="<?php echo $city['city_name']; ?>" required><br>
                    </div>
                    <div class="w-100 mb-10 ms-20">
                        <label for="name" class="w-10 display-8 fw-bold">Country id:</label>
                        
                        <input type="text" class="ms-10" name="country_name" id="name" value="<?php echo $city['country_id']; ?> "; ?> <br>
                     
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


