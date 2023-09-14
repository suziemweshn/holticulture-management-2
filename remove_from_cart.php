<?php
include 'conn.php';
$id = $_GET['id'] ?? null;

if ($id !== null) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

   

    $sql="DELETE  FROM cart WHERE id='$id' ";
  

        if(mysqli_query($conn, $sql)) {
           echo "Your cart product info deleted successfully";
          
        }else {
            die('Query problem'.  mysqli_error($conn) );   
        }
      header("location: cart.php");
   
    }
?>