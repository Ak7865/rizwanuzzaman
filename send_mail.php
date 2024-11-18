<?php
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send'])) {
    // Fetch data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Sanitize the inputs
    $name = htmlspecialchars(strip_tags($name));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(strip_tags($message));

    if (!$email) {
        die("Invalid email address.");
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ah076145@gmail.com'; // Your Gmail address
        $mail->Password   = 'ocvs chgs qzkp ymvy';        // Your Gmail password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Sender and recipient
        $mail->setFrom($email, $name); // Use form data for sender
        $mail->addAddress('ah076145@gmail.com', 'Admin'); // Admin email for receiving messages

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission';
        $mail->Body    = "<p><strong>Name:</strong> {$name}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Message:</strong><br>{$message}</p>";
        $mail->AltBody = "Name: {$name}\nEmail: {$email}\nMessage: {$message}";

        // Send email
        $mail->send();
        echo "<div class='success'>Message sent successfully. Thank you, $name!</div>";
    } catch (Exception $e) {
        echo "<div class='error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
    }
}
?>