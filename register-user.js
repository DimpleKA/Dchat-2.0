function registerUser() {
    var username = document.getElementById("register_username").value;
    var email = document.getElementById("register_email").value;
    var password = document.getElementById("register_password").value;
    var confirmPassword = document.getElementById("register_confirm_password").value;
    var image = document.getElementById("register_image").files[0];

    // Regular expression to match the email format "20bcar139@gcu.edu.in"
    // var emailRegex = /^[a-zA-Z0-9._%+-]+@gcu\.edu\.in$/;

    // // Check if the entered email matches the expected format
    // if (!emailRegex.test(email)) {
    //     // If the email format is incorrect, show an alert
    //     alert("Invalid email format. Please enter a valid GCU email address.");
    //     return; // Stop further execution
    // }

    // Perform client-side validation
    if (!username || !email || !password || !confirmPassword || !image) {
        alert("All fields including image are required");
        return;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return;
    }

    // Create FormData object to send form data including file
    var formData = new FormData();
    formData.append("username", username);
    formData.append("email", email);
    formData.append("password", password);
    formData.append("confirm_password", confirmPassword);
    formData.append("image", image);

    // Send Fetch request to server to check if the email exists
    fetch("check_email.php", {
        method: "POST",
        body: "email=" + email,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            alert("Email already exists in the database. Go to Forgot Password.");
            // Add your logic here for handling existing email
        } else {
            console.log("Email does not exist in the database. Proceed with registration.");
            // Add your logic here for registration process

            // Example: Send form data to registration endpoint
            var registrationEndpoint = "register.php";
            fetch(registrationEndpoint, {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    alert("Registration successful");
                    // Add your logic here for successful registration
                } else {
                    alert("Registration failed");
                    // Add your logic here for failed registration
                }
            })
            .catch(error => console.error("Error:", error));
        }
    })
    .catch(error => console.error("Error:", error));
}
