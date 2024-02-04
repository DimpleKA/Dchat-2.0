// forgot-password-


      function showContainer(containerId) {
        var containers = document.querySelectorAll(
          ".container, .container1, .container3"
        );
        containers.forEach(function (container) {
          container.style.display = "none";
        });
        document.getElementById(containerId).style.display = "block";
      }
     
      function forgotPassword() {
        // Get the email entered by the user
        var emailInput = document.getElementById("emailforgot").value;
        var overlay = document.getElementById("overlay");
        overlay.style.display = "flex";

        // Regular expression to match the email format "20bcar139@gcu.edu.in"
        var emailRegex = /^[a-zA-Z0-9._%+-]+@gcu\.edu\.in$/;

        // Check if the entered email matches the expected format
        // if (!emailRegex.test(emailInput)) {
        //     // If the email format is incorrect, show an alert
        //     alert("Only college emails ending with @gcu.edu.in are allowed.");
        //     return; // Stop further execution
        // }

        // Show the loader while the request is being processed
        var loader = document.getElementById("loader");
        loader.style.display = "block";

        var formData = new FormData();
        formData.append("email", emailInput);

        // Define the fetch options
        var options = {
          method: "POST",
          body: formData,
        };

        fetch("autogmail/forgotpassword.php", options)
          .then((response) => {
            // Hide the overlay and loader when the request is complete
            overlay.style.display = "none";

            if (!response.ok) {
              throw new Error("Network response was not ok");
            }
            return response.text();
          })
          .then((data) => {
            var inputElement = document.getElementById("emailforgot");

            // Add the readonly attribute to the input field
            inputElement.readOnly = true;
            // Display the response from the server
            alert(data);
            // Show the OTP field after receiving the response
            document.getElementById("otpbox").style.display = "block";
            document.getElementById("otpbox2").style.display = "block";
          })
          .catch((error) => {
            // Hide the overlay and loader when there's an error
            overlay.style.display = "none";

            // Handle errors
            console.error(
              "There was a problem with the fetch operation:",
              error
            );
            alert("Error: " + error.message);
          });
      }

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      function verifyotp() {
    // Get the email entered by the user
    var emailInput = document.getElementById('emailforgot').value;
    var enteredOTP = document.getElementById('otp').value;

    // AJAX request to check if the entered OTP matches the one stored in the database
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            if (response.trim() === 'otp matched') {
                console.log("OTP matched.");
                // Add your logic here for a matched OTP
            } else {
                console.log("OTP does not match.");
                // Add your logic here for a mismatched OTP
            }
        }
    };
    xhr.open("POST", "verify_otp.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("email=" + emailInput + "&otp=" + enteredOTP);
}

     
   