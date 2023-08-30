<?php 

include 'conn.php';

// Check if the 'Agent_name' parameter exists in the POST data
if(isset($_POST['Agent_name'])) {
    $selectedAgent = $_POST['Agent_name'];

    $sql = "SELECT * FROM agent WHERE Agent_name = '$selectedAgent'";
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $agentDetails = array(
            'agentNumber' => $row['Agent_Number'],
            'gender' => $row['Gender'],
            'contactNumber' => $row['Contact_Number']
        );
    } else {
        $agentDetails = array(); // No agent found
    }
} else {
    $agentDetails = array(); // Parameter not received
}

$conn->close();

// Return agent details in JSON format
header('Content-Type: application/json');
echo json_encode($agentDetails);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
</head>
<body>
<h3>Delivery Details</h3>
<form id="checkoutForm" action="get_Agent_details.php" method="post">
    <input type="radio" name="deliveryOption" value="door"> Door Delivery
    <input type="radio" name="deliveryOption" value="pickup"> Pickup from Agent

    <div id="agentDetailsSubform" style="display: none;">
    <select id="agentName" name="agentName">
    <option value="select Agent" >Select Agent</option>
    <?php foreach ($agentNames as $agent) { ?>
      
        <option value="<?php echo $agent; ?>"><?php echo $agent; ?></option>
    <?php } ?>
</select>

    <input type="text" id="agentNumber" name="agentNumber" readonly>
    <input type="text" id="gender" name="gender" readonly>
    <input type="text" id="contactNumber" name="contactNumber" readonly>
    </div>

    <input type="submit" value="Submit">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            }
        });
    });
});

              </script>
</body>
</html>