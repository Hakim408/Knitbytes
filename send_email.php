<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();  // Start session to store messages

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $college = $_POST['college_name'];
    $degree = $_POST['degree'];
    $skills = $_POST['skills'];
    $faculty = $_POST['faculty'];
    $semester = $_POST['semester'];
    $apply_for = $_POST['apply_for'];

    // Check if file was uploaded
    $resume = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $resume = $_FILES['resume']['name'];
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = 'hakimraut408@gmail.com';  
        $mail->Password = 'vuvt vryo qqtl gkxa';  // R0j#gR&E70g{
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;

        // Sender & Recipient
        $mail->setFrom($email, $name);
        $mail->addAddress('hakimraut408@gmail.com');  

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Application Submission";
        $mail->Body = "
            <h2>New Application Received</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone Number:</strong> $phone</p>
            <p><strong>College Name:</strong> $college</p>
            <p><strong>Degree/Program:</strong> $degree</p>
            <p><strong>Skills:</strong> $skills</p>
            <p><strong>Faculty:</strong> $faculty</p>
            <p><strong>Semester:</strong> $semester</p>
            <p><strong>Internship Position Applied For:</strong> $apply_for</p>
        ";

        // Attach Resume if exists
        if ($resume) {
            $mail->addAttachment($_FILES['resume']['tmp_name'], $resume);
        }

        // Send email
        $mail->send();
        $_SESSION['message'] = "<div class='alert alert-success'>Application Sent Successfully!</div>";
    } catch (Exception $e) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Failed to send application. Error: {$mail->ErrorInfo}</div>";
    }

    // Redirect back to the form page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
