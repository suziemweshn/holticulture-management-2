<?php
include 'conn.php';

if (isset($_GET['city_id'])) {
    $city_id = $_GET['city_id'];
    $query = "SELECT * FROM location WHERE city_id = $city_id";
    $result = mysqli_query($conn, $query);

    $location = [];
while ($row = mysqli_fetch_assoc($result)) {
    $location[] = $row;
}
$locationQuery = "SELECT * FROM cities";
$locationResult = mysqli_query($conn, $locationQuery);

    echo json_encode($location);
}
?>