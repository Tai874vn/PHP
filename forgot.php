<?php
include './includes/query.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
    $email = trim($_POST["email"]);
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_email'] = $email;
    $_SESSION['email'] = $email;
    $_SESSION['otp_expire'] = time() + (5 * 60); 
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tainhgcc230213@fpt.edu.vn';
        $mail->Password   = 'gqmx apjr lqkp eoza';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('your-email@gmail.com', 'SQUOTES');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Password Reset';
        $mail->Body    = "Your OTP is: <h2>$otp</h2><br>This code will expire in 5 minutes.";

        $mail->send();
    } catch (Exception $e) {
        $errors = "error when creating otp";
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['verify'])) {
    $otp = $_POST['otp'];
    if ($_SESSION['otp'] == $otp) {
        $_SESSION['verify'] = true;
        header("Location: updatePassword.php");
    } else {
        $errors [] = "Incorrect OTP code";
    }

}
include './templates/forgot.html.php';
?>
