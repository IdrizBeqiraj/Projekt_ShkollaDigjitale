<?php
// Make sure to use the correct absolute paths to include PHPMailer files
require 'C:/xampp/htdocs/Projekt_ShkollaDigjitale/PHPMailer-master/src/Exception.php';
require 'C:/xampp/htdocs/Projekt_ShkollaDigjitale/PHPMailer-master/src/PHPMailer.php';
require 'C:/xampp/htdocs/Projekt_ShkollaDigjitale/PHPMailer-master/src/SMTP.php';

// Use the PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data to prevent XSS
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Check if the form fields are not empty
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required!";
    } else {
        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'idriz.beqiraj@gmail.com'; // Change this to your Gmail address
            $mail->Password = 'maaw whrc nzhx ebbe'; // Use an App Password for Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('idriz.beqiraj@gmail.com'); // Your email address

            // Content
            $mail->isHTML(false); // Set to false if you want plain text emails
            $mail->Subject = "New Contact Form Message: $subject";
            $mail->Body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

            // Send email
            $mail->send();
            echo "Message sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Error: {$mail->ErrorInfo}";
        }
    }
}
?>
