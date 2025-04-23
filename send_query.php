<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();  // Start session to store messages

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CAPTCHA Verification
    $recaptcha_secret = '6Lc0aCArAAAAANNp6ES53IPMrmLl5zAu18iL38HG';  
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verify the CAPTCHA response with Google
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
    $captcha_success = json_decode($verify);

    if (!$captcha_success->success) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Captcha verification failed. Please try again.</div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'mail.knitbytes.com';  // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'info@knitbytes.com';  // Your email address
        $mail->Password = 'Knitbytes@1';  // Your email password
        $mail->SMTPSecure = 'ssl';  // Use SSL encryption
        $mail->Port = 465;  // Port 465 is for SSL

        // Sender & Recipient
        $mail->setFrom($email, $name);  // Sender email and name
        $mail->addAddress('info@knitbytes.com');  // Recipient email address

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Client Query Submission: $subject";
        $mail->Body = "
            <h2>New Query Received</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Contact Number:</strong> $contact_number</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br> $message</p>
        ";

        // Send email
        $mail->send();
        $_SESSION['message'] = "<div class='alert alert-success'>Query Sent Successfully!</div>";
    } catch (Exception $e) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Failed to send query. Error: {$mail->ErrorInfo}</div>";
    }

    // Redirect back to the form page with a session message
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
}
?>
