function loginUser() {
    // Get the email and password entered by the user
    var email = document.getElementById("emaillogin").value;
    var password = document.getElementById("passwordlogin").value;

    // Regular expression to match the email format "20bcar139@gcu.edu.in"
    // var emailRegex = /^[a-zA-Z0-9._%+-]+@gcu\.edu\.in$/;

    // // Check if the entered email matches the expected format
    // if (!emailRegex.test(email)) {
    //     // If the email format is incorrect, show an alert
    //     alert("Invalid email format. Please enter a valid GCU email address.");
    //     return; // Stop further execution
    // }

    // Send a request to check if the email exists
    fetch('check_email.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'email=' + email
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            console.log("Email exists in the database.");
            // Add your login logic here
            // Send a request to login.php to verify the credentials
    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'email=' + email + '&password=' + password
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Login successful
            alert(data.message); // You can customize this message
            // Add redirection or other actions as needed after successful login
        } else {
            // Login failed
            alert(data.message); // You can customize this message
            // Handle the case where login fails
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.'); // Alert the user about the error
    });
        } 
        
        
        
        else {
            alert("Email does not exist in the database. Goto registraiton page!");
            // Handle the case where the email does not exist
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle any errors that occur during the fetch request
    });
}
