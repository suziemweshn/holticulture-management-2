<?php
session_start();
include 'conn.php';
$sql="DELETE  FROM cart";
if(mysqli_query($conn, $sql)) {
    echo "Your cart product info deleted successfully";
   
 }else {
     die('Query problem'.  mysqli_error($conn) );   
 }
header("location: cart.php");

?>
