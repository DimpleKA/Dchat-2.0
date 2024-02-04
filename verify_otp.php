<?php
include('connection.php');

// Retrieve the email and OTP from the AJAX request
$email = $_POST['email'];
$enteredOTP = $_POST['otp'];

// Prepare a SQL query to fetch the OTP for the given email
$sql = "SELECT otp FROM dchatuser WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Email found in the database
    $row = $result->fetch_assoc();
    $storedOTP = $row['otp'];

    // Check if the entered OTP matches the stored OTP
    if ($enteredOTP == $storedOTP) {
        // OTP matched
        echo "otp matched";
    } else {
        // OTP did not match
        echo "does not match";
    }
} else {
    // Email not found in the database
    echo "Email not found";
}

?>
