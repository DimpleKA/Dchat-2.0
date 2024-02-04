<?php
require('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GCU-Chat</title>
    <!-- google material icons -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- google material icons -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="main">
      <div class="leftnav">
        <div class="leftnavtop">
          <p>
            <img
              src="https://assets.mofoprod.net/network/images/fbmessenger_logo.original.jpg"
              alt=""
              srcset=""
              id="meslogo"
            />
          </p>
        </div>
        <div class="leftnavbottom">
          <span class="material-symbols-outlined"> forum </span> <br />
          <span class="material-symbols-outlined"> call </span><br />
          <span class="material-symbols-outlined"> group </span><br />
          <span class="material-symbols-outlined"> account_circle </span>
        </div>
      </div>
      <div class="centre">
        <div class="centreleft">
          <div class="centrelefttop">
            <div class="chat-call-friend-nav">
              <div class="heading">
                <div>
                  <h2 id="chat-call-friend-nav-heading">Chats</h2>
                </div>
                <div class="centre-left-nav-top-icon">
                  <span class="material-symbols-outlined no-hover">
                    notifications
                  </span>
                  <span class="material-symbols-outlined no-hover">
                    more_vert
                  </span>
                </div>
              </div>
              <div class="category">
                <div class="cat-flex">
                  <select id="dropdown">
                    <option value="option1">All Chats</option>
                    <option value="option2">Unread</option>
                    <option value="option3">Groups</option>
                    <!-- Add more options as needed -->
                  </select>
                  <input
                    type="text"
                    id="search-bar"
                    placeholder="Search Users"
                  />
                </div>
              </div>
            </div>
          </div>
          <hr />
          <div class="centreleftbottom">
           
<?php
//  - user starts --
$sql = "SELECT * FROM dchatuser";
$result = $conn->query($sql);
$other_user_id = array();
// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
// user chat display logic in chatbox 
       $logged_in_user_id=2;
       $other_user_id[] = $row['userid'];
       $lastIndex = count($other_user_id) - 1;
       $lastIndex=$lastIndex;
        $selected_user_id=$other_user_id[$lastIndex];
// user chat display logic in chatbox
echo
"
<div class='user' id='user$selected_user_id'>
   <div class='userbox'>
     <div class='userdp'>
       <img
         src='https://w0.peakpx.com/wallpaper/203/18/HD-wallpaper-joker-cartoon-comics-dc-drawn-hollywood-marvel-superheroes.jpg'
         class='userimg'
       />
     </div>
     <div class='userdetail'>
       <div class='topdetail'>
         <h4>".$row['username']."</h4>
         <h4>".$row['status']."</h4>
       </div>
       <div class='bottomdetail'>
         <h5>Last Message was this....</h5>
       </div>
     </div>
   </div>
 </div>

";
    }
}
    else {
        echo "0 results"; // Display if there are no rows returned
    }
    
    // Close the connection
    $conn->close();
 
//  -- user ends --
?>
 

            <!-- Add more users here -->
          </div>
        </div>
        <div class="centreright" style="background-color: #665dfe">
          <div class="centre-top-nav" style="background-color: #fff">
            <div class="dp-name-status">
              <img
                src="https://i.pinimg.com/736x/eb/67/96/eb6796fda77d9fe50368b8f2dd544fde.jpg"
                alt=""
                srcset=""
                id="meslogo"
              />
              <div class="name-status">
                <h3>Vatsal Rishabh</h3>
                <h3 class="online-offline">Online</h3>
              </div>
            </div>
            <div class="search-call-moreinfo">
              <span class="material-symbols-outlined"> search </span>
              <span class="material-symbols-outlined"> call </span>
              <span class="material-symbols-outlined"> more_vert </span>
            </div>
          </div>
<hr>

          <!-- chatarea starts -->
          <div class="uniquechats">
            <div class="chatarea">

<!-- message date starts -->
<b >Yesterday</b>
<!-- message date ends -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dchat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Assuming $conn is your database connection object
$query = "SELECT * FROM messages WHERE sender_id = 1 AND receiver_id = 3";
$stmt = $conn->prepare($query);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Fetch messages and display them
while ($row = $result->fetch_assoc()) {
    $sender_id=$row['sender_id'];
    $receiver_id=$row['receiver_id'];
    $messageContent = $row['the_message'];
    // $messageTime = $row['message_time'];
    //   -- message starts  --
    echo "<div class='message' data-senderid='$logged_in_user_id' data-receiverid='$receiver_id' >";
    echo "<div class='message-wrapper'>";
    echo "<div class='message-content'>";
    echo "<span>$messageContent</span>";
    echo "</div>";
    echo "</div>";
    echo "<div class='messageoptions'>";
    echo "<div class='avtar-date'>";
    echo "<div class='message-box-dp'>";
    echo "<img src='https://w0.peakpx.com/wallpaper/203/18/HD-wallpaper-joker-cartoon-comics-dc-drawn-hollywood-marvel-superheroes.jpg' alt='avtaar' id='avtaar-dp' />";
    echo "</div>";
    echo "<div class='message-box-date'>";
    // echo "<span>$messageTime</span>";
    echo "</div>";
    echo "</div>";
    echo "<div class='dropdown'>";
    echo "<span class='material-symbols-outlined'> more_horiz </span>";
    echo "<div class='hidden-options'></div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    //    -- message ends -
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

            
             

              <!-- message starts  -->
              <!-- Assuming you have already established the database connection -->

<?php
// logged in user  sent messages 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dchat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM messages WHERE sender_id = $logged_in_user_id AND receiver_id = 3";
$stmt = $conn->prepare($query);

// Execute the query                          
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Fetch messages and display them
while ($row = $result->fetch_assoc()) {
    $sender_id = $row['sender_id'];
    $receiver_id = $row['receiver_id'];
    $messageContent = $row['the_message'];
    // $messageTime = $row['message_time'];
    //   -- message starts  --
    echo "<div class='message' data-sender-id='$logged_in_user_id' data-receiver-id='$receiver_id'>";
    echo "<div class='message-wrapper-right'>";
    echo "<div class='message-content'>";
    echo "<span>$messageContent</span>";
    echo "</div>";
    echo "</div>";
    echo "<div class='messageoptions-right'>";
    echo "<div class='dropdown'>";
    echo "<span class='material-symbols-outlined'> more_horiz </span>";
    echo "<div class='hidden-options'></div>";
    echo "</div>";
    echo "<div class='avtar-date'>";
    echo "<div class='message-box-date'>";
    // echo "<span>$messageTime</span>";
    echo "</div>";
    echo "<div class='message-box-dp'>";
    echo "<img src='https://w0.peakpx.com/wallpaper/203/18/HD-wallpaper-joker-cartoon-comics-dc-drawn-hollywood-marvel-superheroes.jpg' alt='avtaar' id='avtaar-dp' />";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    //    -- message ends -
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

              <!-- message ends -->
   <!-- send area starts  -->

   <script>
    document.getElementById("emoji-send1").addEventListener("click", sendMessage);
    document.getElementById("send-message").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
});

function sendMessage() {
    console.log("function called");
    var message = document.getElementById("send-message").value;
    var senderId = document.querySelector(".message").getAttribute("data-sender-id");
    var receiverId = document.querySelector(".message").getAttribute("data-receiver-id");

    // Perform AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "send_message.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Handle success
                console.log(xhr.responseText);
            } else {
                // Handle error
                console.error("Error:", xhr.statusText);
            }
        }
    };
   // Adjust sender_id and receiver_id values as needed
   var data = "message=" + encodeURIComponent(message) + "&sender_id=" + senderId + "&receiver_id=" + receiverId;
    xhr.send(data);
}
   </script>

            </div>

            <div class="sendarea" style="background-color: aliceblue">
              <div class="send-area-left">
                <div class="add-file">
                  <span class="material-symbols-outlined" style="margin: 0;" id="white-logo-without-blue"> add_circle </span>
                </div>
                <div class="text-area">
                  <input
                    type="text"
                    name=""
                    id="send-message"
                    placeholder="Type your message here....."
                  />
                </div>
              </div>
              <div class="send-area-right">
                <div class="emoji-send">
                    <span class="material-symbols-outlined" id="white-logo-without-blue" style="margin: 0;">
                        mood
                        </span>
                </div>
                <div class="emoji-send" id="emoji-send1">
                    <span class="material-symbols-outlined" id="white-logo">arrow_forward</span>
                </div>
              </div>
            </div>
          </div>

          <script>
    document.getElementById("emoji-send1").addEventListener("click", sendMessage);
    document.getElementById("send-message").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
});

function sendMessage() {
    console.log("function called");
    location.reload();
    var message = document.getElementById("send-message").value;

    // Perform AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "send_message.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Handle success
                console.log(xhr.responseText);
            } else {
                // Handle error
                console.error("Error:", xhr.statusText);
            }
        }
    };
    // Adjust sender_id and receiver_id values as needed
    var data = "message=" + encodeURIComponent(message) + "&sender_id=1&receiver_id=3";
    xhr.send(data);
}
   </script>

          <!-- chatarea ends        -->
        </div>
      </div>
      <div class="rightnav"></div>
    </div>
  </body>
</html>
