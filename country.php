<?php
// Database connection setup
include 'conn.php';


// Get the selected country from the query parameter
$selectedCountry = $_GET['country'];

// Fetch cities for the selected country from the database
$sql = "SELECT city_name FROM cities WHERE country_name = '$selectedCountry'";
$result = $conn->query($sql);

$cities = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['city_name'];
    }
}

// Return cities as JSON response
$response = array('cities' => $cities);
echo json_encode($response);

$conn->close();
?>
