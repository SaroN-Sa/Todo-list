<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Email settings
    $to = "support@todoapp.et";
    $subject = "Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect to contact page with a success message
        header("Location: contact.html?status=success");
    } else {
        // Redirect to contact page with an error message
        header("Location: contact.html?status=error");
    }
    exit();
}
?>
