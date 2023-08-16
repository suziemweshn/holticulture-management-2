<?php
//session_start();
if(!$_SESSION["username"]){
header("Location: customer-login.html");
exit();
}

?>
