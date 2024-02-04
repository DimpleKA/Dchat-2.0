<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dchat";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the last user ID from the database
$sql_last_id = "SELECT MAX(userid) AS last_id FROM dchatuser";
$result_last_id = $conn->query($sql_last_id);
$last_id = 0;

if ($result_last_id->num_rows > 0) {
    $row = $result_last_id->fetch_assoc();
    $last_id = $row["last_id"];
}

// Registration form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // No hashing for password
    $user_id = $last_id + 1; // New user ID
    $dp = ""; // Initialize profile picture path

    // Handle file upload (profile picture)
    if ($_FILES["dp"]["name"]) {
        $target_dir = "uploads/";
        $target_file = $target_dir . $user_id . ".jpg"; // Filename based on user ID
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["dp"]["name"], PATHINFO_EXTENSION));

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG & JPEG files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
                $dp = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Insert user data into database
    $sql = "INSERT INTO dchatuser (username, email, password, userdp) VALUES ('$username', '$email', '$password', '$dp')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

