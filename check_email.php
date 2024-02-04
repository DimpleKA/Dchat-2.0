<?php
// Database connection
include('connection.php');

// Check if all required fields are set
if (isset($_POST['email'])) {
    // Sanitize user inputs to prevent SQL injection
    $email = $conn->real_escape_string($_POST['email']);

    // Query to check if the email exists
    $check_email_sql = "SELECT * FROM dchatuser WHERE email = '$email'";
    $check_email_result = $conn->query($check_email_sql);

    if ($check_email_result && $check_email_result->num_rows > 0) {
        // Email exists
        $response = array('exists' => true);
    } else {
        // Email does not exist
        $response = array('exists' => false);
    }
} else {
    $response = array('success' => false, 'message' => 'Email field is not set');
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close connection
$conn->close();
?>
