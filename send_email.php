<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Sanitize function for text fields
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

    // Sanitize form inputs
    $name = sanitize_input($_POST['full_name'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = sanitize_input($_POST['phone_number'] ?? '');
    $college = sanitize_input($_POST['college_name'] ?? '');
    $degree = sanitize_input($_POST['degree'] ?? '');
    $skills = sanitize_input($_POST['skills'] ?? '');
    $faculty = sanitize_input($_POST['faculty'] ?? '');
    $semester = sanitize_input($_POST['semester'] ?? '');
    $apply_for = sanitize_input($_POST['apply_for'] ?? '');

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Invalid email address.</div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Validate length
    if (strlen($name) > 100 || strlen($skills) > 1000 || strlen($apply_for) > 200) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Input too long. Please shorten your message.</div>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Handle file upload
    $resume = '';
    $resume_tmp_path = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $resume = basename($_FILES['resume']['name']);
        $resume_tmp_path = $_FILES['resume']['tmp_name'];
        // Optional: Validate file type and size here
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'mail.knitbytes.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@knitbytes.com';
        $mail->Password = 'Knitbytes@1';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('info@knitbytes.com', 'Internship Application');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('info@knitbytes.com');

        $mail->isHTML(true);
        $mail->Subject = "New Internship Application";

        $mail->Body = "
            <h2>New Application Received</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone Number:</strong> {$phone}</p>
            <p><strong>College Name:</strong> {$college}</p>
            <p><strong>Degree/Program:</strong> {$degree}</p>
            <p><strong>Skills:</strong> {$skills}</p>
            <p><strong>Faculty:</strong> {$faculty}</p>
            <p><strong>Semester:</strong> {$semester}</p>
            <p><strong>Internship Position Applied For:</strong> {$apply_for}</p>
        ";

        if ($resume && $resume_tmp_path) {
            $mail->addAttachment($resume_tmp_path, $resume);
        }

        $mail->send();
        $_SESSION['message'] = "<div class='alert alert-success'>Application Sent Successfully!</div>";
    } catch (Exception $e) {
        $_SESSION['message'] = "<div class='alert alert-danger'>Failed to send application. Error: {$mail->ErrorInfo}</div>";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
