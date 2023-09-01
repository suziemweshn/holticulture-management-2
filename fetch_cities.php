<?php
include 'conn.php';

if (isset($_GET['country_id'])) {
    $country_id = $_GET['country_id'];
    $query = "SELECT * FROM cities WHERE country_id = $country_id";
    $result = mysqli_query($conn, $query);

    $cities = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cities[] = $row;
    }

    echo json_encode($cities);
}
?>
