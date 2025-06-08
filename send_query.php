<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Sanitize input safely for XSS prevention
function sanitize_input($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // CAPTCHA Verification
    $recaptcha_secret = '6Lc0aCArAAAAANNp6ES53IPMrmLl5zAu18iL38HG';
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
    $captcha_success = json_decode($verify);

    if (!$captcha_success->success) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Captcha verification failed. Please try again.</div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Sanitize and validate inputs
    $name = sanitize_input($_POST['name'] ?? '');
    $contact_number = sanitize_input($_POST['contact_number'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = sanitize_input($_POST['subject'] ?? '');
    $message = sanitize_input($_POST['message'] ?? '');

    if (strlen($name) > 100 || strlen($subject) > 200 || strlen($message) > 2000) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Input too long. Please shorten your message.</div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Invalid email address.</div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Log (optional)
    $log_entry = date('Y-m-d H:i:s') . " | IP: " . $_SERVER['REMOTE_ADDR'] . " | Name: $name | Email: $email\n";
    file_put_contents('form_logs.txt', $log_entry, FILE_APPEND);

    // Send email
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'mail.knitbytes.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@knitbytes.com';
        $mail->Password = 'Knitbytes@1';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('info@knitbytes.com', 'Knit Bytes Contact Form');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('info@knitbytes.com');

        $mail->isHTML(true);
        $mail->Subject = "New Client Query Submission: " . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');

        $mail->Body = "
            <h2>New Query Received</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Contact Number:</strong> {$contact_number}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
        ";

        $mail->send();
        $_SESSION['message'] = "<div class='alert alert-success'>Query Sent Successfully!</div>";
    } catch (Exception $e) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Failed to send query. Error: {$mail->ErrorInfo}</div>";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
