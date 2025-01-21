<?php
// Define the recipient email address
$recipient_email = "r0786146@student.thomasmore.be";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING); // Capture the subject
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate email input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Prepare the email subject (Use the subject from the form)
    $email_subject = "Contact Form Submission: $subject";  // Subject of the email

    // Prepare the email body
    $email_body = "<html><body>";
    $email_body .= "<h2>You have received a new message from your contact form</h2>";
    $email_body .= "<p><strong>Name:</strong> $name</p>";
    $email_body .= "<p><strong>Email:</strong> $email</p>";
    $email_body .= "<p><strong>Message:</strong><br>$message</p>";
    $email_body .= "</body></html>";

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; // Send as HTML email
    $headers .= "From: <$email>" . "\r\n"; // From email address (the user's email)

    // Send the email
    if (mail($recipient_email, $email_subject, $email_body, $headers)) {
        // Redirect to the contact page after a successful submission
        header("Location: Contact.html?status=success");
        exit();
    } else {
        // If the mail fails, redirect to the contact page with an error message
        header("Location: Contact.html?status=error");
        exit();
    }
} else {
    die("Invalid request");
}
?>
