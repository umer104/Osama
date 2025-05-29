<?php
$to = "umerakmalku@gmail.com"; // Your Email

// Sanitize input
$from = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$sender_name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$subject_line = htmlspecialchars($_POST['subject']);
$note = htmlspecialchars($_POST['note']);

// Validate email
if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Invalid email format.";
    exit;
}

// Compose message
$subject = "New Contact Form Submission";
$message = "$sender_name has sent a contact message.\n\n";
$message .= "Subject: $subject_line\n";
$message .= "Phone: $phone\n\n";
$message .= "Message:\n$note\n";

// Set headers
$headers = "From: no-reply@yourdomain.com\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "success";
} else {
    http_response_code(500);
    echo "error";
}
?>
