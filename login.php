<?php
// Database connection
include('connection.php');

// Check if email and password are set in the POST data
if (isset($_POST['email'], $_POST['password'])) {
    // Sanitize user inputs to prevent SQL injection
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to check if the user exists in the database
    $sql = "SELECT * FROM dchatuser WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, login successful
        $response = array('success' => true, 'message' => 'Login successful');
    } else {
        // User does not exist or credentials are incorrect
        $response = array('success' => false, 'message' => 'Invalid email or password');
    }
} else {
    // Required fields are not set in the POST data
    $response = array('success' => false, 'message' => 'Email and password are required');
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close connection
$conn->close();
?>
