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
