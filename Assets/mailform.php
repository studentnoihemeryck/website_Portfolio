<?php
// Define the recipient email address
$recipient_email = "r0786146@student.thomasmore.be";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Prepare email content
    $email_subject = "New Form Submission";
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message: $message\n";

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
    $headers .= "From: <$email>" . "\r\n";

    // Send the email
    if (mail($recipient_email, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully";
    } else {
        echo "Message could not be sent";
    }
} else {
    die("Invalid request");
}
?>
