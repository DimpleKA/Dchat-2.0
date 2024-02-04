<?php
include('connection.php');

$to_email = $_POST['email'];
$findEmail = "SELECT * FROM dchatuser WHERE email = '$to_email'";
$result = $conn->query($findEmail);

if ($result->num_rows > 0) {
    // Email exists in the database
    echo "Email exists in the database.";

    // Include PHPMailer library
    include('smtp/PHPMailerAutoload.php');

    // Generate OTP
    $random_number = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    // $update_otp="UPDATE `dchatuser` SET `otp` = '$random_number' WHERE `dchatuser`.`userid` = '$to_email';";
    $update_otp="UPDATE `dchatuser` SET `otp` = '$random_number' WHERE `email` = '$to_email';";
    $conn->query($update_otp);
    $subject = 'Your OTP for password recovery';

    // The message body
    $message = 'Hello,';
    $message .= "\n\n";
    $message .= 'Your OTP for password recovery is: ' . $random_number;
    $message .= "\n\n";
    $message .= 'Please use this OTP to complete the password recovery process.';
    $message .= "\n\n";
    $message .= 'If you did not request a password recovery, please ignore this email.';

    // Send email using SMTP mailer function
    smtp_mailer($to_email, $subject, $message);
} else {
    // Email does not exist in the database
    echo 'Email does not exist! Register Yourself';
}

// SMTP mailer function
function smtp_mailer($to, $subject, $msg){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "dchatcare@gmail.com";
    $mail->Password = "pibubdtsbaonaxep";
    $mail->SetFrom("dchatcare@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        )
    );
    if(!$mail->Send()){
        echo $mail->ErrorInfo;
    } else {
        echo 'Sent';
    }
}
?>
