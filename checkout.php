<?php
session_start();

include 'oauth.php';
include 'conn.php';

// Retrieve user details from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Retrieve user profile details from the admin_table
$stmt = $conn->prepare("SELECT * FROM customer_table WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'] ?? '';
    $name = $row['name'] ?? '';
    $email = $row['email'] ?? '';
    $phone_no = $row['phone_no'] ?? '';
    $password = $row['password'] ?? '';
    $username = $row['username'] ?? '';
    $country = $row['country'] ?? '';
    $city = $row['city'] ?? '';
    $location = $row['location'] ?? '';
   // $address = $row['address'] ?? '';
} else {
    // User not found in the admin_table
    // Handle the scenario accordingly, e.g., display an error message
    echo "User profile not found!";
}

$stmt->close();

// Fetch the list of agents from the agent table
$agentNames = array(); // Initialize an empty array to store agent names
$query = "SELECT Agent_name FROM agent";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $agentNames[] = $row['Agent_name'];
       // $agentNumber[] = $row['agent_id'];
    }
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve customer address and delivery details from the form
    $customerAddress = $_POST['address'] ?? '';
    $delivery_mode = $_POST['deliveryOption'] ?? '';
    $country = $_POST['country'] ?? '';
    $city = $_POST['city'] ?? '';
    $location = $_POST['location'] ?? '';



    // Check if 'Agent_name' parameter exists in the POST data
    if (isset($_POST['agentName'])) {
        $selectedAgent = $_POST['agentName'];
        $address = $_POST['address'];
        $selectedAgent = $_POST['agentNumber'];

        // Insert data into the checkout table
        $sql = "INSERT INTO checkout (username, name, email, phone_no, address, delivery_mode, agent_name, country, city, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssssss", $username, $name, $email, $phone_no, $address, $delivery_mode, $selectedAgent, $country, $city, $location);

        if ($stmt->execute()) {
            // Data inserted successfully, now redirect to the payment page
            $stmt->close();
            $conn->close();
           header('location: payment.php');
         
            exit();
        } else {
            echo "Error inserting into the checkout table: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }
} else {
    echo "Agent_name parameter not received.";
}
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
      
  body{
    background-color:whitesmoke;
  }
  .input{
    border:none;
    outline:none;
    width:100%;
    border-radius:3px;
    height:30px;
   
  }
  form{
  
   justify-content:center;
   align-items:center;
   width:100%;

  
  }
  form label{
    font-size:20px;
    font-weight:bold
  }
  fieldset{
    width:90%;
    border-radius:5px;
  }
  .container-fluid{
  position:relative;
  left:400px
  }
  form a button{
    border:1px solid black;
    border-radius:5px;
    background-color:black;
    color:white;
    height:25px;
    margin-top:30px;
    width:30%;
    margin-left:40px;
  }
  form a{
    text-decoration:none;
    font-size:20px;
  }
  
  .checkout-form {
  /*  background: linear-gradient(115deg, rgba(13, 110, 253, 0.8), rgba(13, 110, 253, 0.719)), url('Nanyuki.jpg') no-repeat;
background-size: cover;*/
background-color:white;
width: 40%;
height: 1000px;
border-radius: 5px;

    
 
 
 
}
.buttons{
    margin-top:60px;
    margin-left:80px;

}


 </style>
 
</head>
<body>
    <section class="">
        <div class="container-fluid" style="background: url(../img/flamingo.jpeg)">
            <div class="checkout-form">
                <h3>Customer Address</h3>
                <form method="POST" action="checkout.php">
                
            <fieldset>
<legend>
    <label for="">Name</label>
   
</legend>
<input type="text" name="name " value="<?php echo ($name)?> "placeholder="Enter your name"  class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Phone Number</label>
   
</legend>
<input type="text" name="phone_no "  value="+254<?php echo ($phone_no)?> "placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Alternative Phone Number</label>
   
</legend>
<input type="text" name="alt_phone_number "  value="+254 "placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">Email</label>
   
</legend>
<input type="text" name="email " value="<?php echo ($email)?> "placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
    <legend>
        <label for="">Address</label>
    </legend>
    <input type="text" name="address" placeholder="Enter your Address" class="input" required>
</fieldset>

            <fieldset>
<legend>
    <label for="">Country</label>
   
</legend>
<input type="text" name="country" value="<?php echo ($country)?>" placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">City</label>
   
</legend>
<input type="text" name="city" value="<?php echo ($city)?>" placeholder="Enter your name" class="input" required>

            </fieldset>
            <fieldset>
<legend>
    <label for="">location</label>
   
</legend>
<input type="text" name="location " value="<?php echo ($location)?> "placeholder="Enter your name" class="input" required>

            </fieldset>


            <h3>Delivery Details</h3>
<!--<form id="checkoutForm" action="get_Agent_details.php" method="post" class="d-flex flex-row justify-content-center">-->
    <input type="radio" name="deliveryOption" value="door" style="margin-top:15px;" required> Door Delivery <br>
    <input type="radio" name="deliveryOption" value="pickup" style="margin-top:15px;" required> Pickup from Agent

    <div id="agentDetailsSubform" style="display: none;">
    <select id="agentName" name="agentName" style="margin-top:40px; margin-right:20px;  border-radius:3px;  width:200px;">
    <option value="select Agent" id="delivery_mode" name="delivery_mode" >Select Agent</option>
    <?php foreach ($agentNames as $agent) { ?>
      
        <option value="<?php echo $agent; ?>"><?php echo $agent; ?></option>
    <?php } ?>
</select>

    <input type="text" id="agentNumber" name="agentNumber" readonly style="margin-top:20px;  border-radius:3px;  width:200px;">
    <input type="text" id="gender" name="gender" readonly style="margin-top:20px;   border-radius:3px;  width:200px;">
    <input type="text" id="contactNumber" name="contactNumber" readonly style="margin-top:20px;   border-radius:3px;  width:200px;">
   
    </div>
    <div class="buttons">
             <!-- <a href="" class="submit-button"><button type="submit" style="background-color: lime; color: white; margin-right:50px; width:150px;  border-radius:3px; height:40px; ">Submit</button></a>    
 <a href="" class="cancel-button"><button type="submit" style="background-color: lime; color: white;width:150px; margin-right:50px; border-radius:3px; height:40px; ">Cancel</button></a>-->
              </div> 

   <!-- <input type="submit" value="Submit">-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <!-- </form>-->
                    <input type="submit" value="Submit">
                </form>
    
                <script>
                $(document).ready(function() {
    $('input[name="deliveryOption"]').change(function() {
        if ($(this).val() === 'pickup') {
            $('#agentDetailsSubform').show();
        } else {
            $('#agentDetailsSubform').hide();
        }
    });

    $('#agentName').change(function() {
        var selectedAgent = $(this).val();
        $.ajax({
            url: 'get_Agent_details.php',
            method: 'POST',
            data: { Agent_name: selectedAgent }, // Change 'agent' to 'Agent_name'
            dataType: 'json',
            success: function(response) {
                // Populate agent details fields
                $('#agentNumber').val(response.agentNumber);
                $('#gender').val(response.gender);
                $('#contactNumber').val(response.contactNumber);

                $('input[name="agent_id"]').val(response.agent_id);
            $('input[name="contactnumber"]').val(response.contactNumber);
            }
        });
    });
});

              </script>
            </div>
        </div>
    </section>
</body>
</html>
