<?php

$host ="localhost:3307";
$user ="root";
$pass ="1234";
$dbname ="project";

$conn = new mysqli($host,$user,$pass,$dbname);

 if ($conn-> connect_error) {
 	# code...
 	echo "connection failed, please retry again!!!" .$conn->connect_error;
 } else {
 	# code...

 //echo("success");
 }
?>