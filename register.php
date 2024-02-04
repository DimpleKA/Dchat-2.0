<?php
// Database connection
include('connection.php');

// Check if all required fields are set
if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_FILES['image'])) {
    // Sanitize user inputs to prevent SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $response = array('success' => false, 'message' => 'Passwords do not match');
    } else {
        // File upload handling
        $target_dir = "uploads/"; // Specify your target directory
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["image"]["size"] > 50000000) {
            $response = array('success' => false, 'message' => 'File is too large');
        } else {
            // Move uploaded file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert user data into database
                $sql = "INSERT INTO dchatuser (username, email, password, userdp, status, joined_on, ipaddress, location, otp) 
                VALUES ('$username', '$email', '$password', '$target_file', '', CURRENT_TIMESTAMP, '', '', '');
                ";
                
                if ($conn->query($sql) === TRUE) {
                    $response = array('success' => true, 'message' => 'User registered successfully');
                } else {
                    $response = array('success' => false, 'message' => 'Error: ' . $conn->error);
                }
            } else {
                $response = array('success' => false, 'message' => 'Error uploading file');
            }
        }
    }
} else {
    $response = array('success' => false, 'message' => 'Required fields are not set');
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close connection
$conn->close();
?>
