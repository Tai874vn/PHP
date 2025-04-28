<?php
include './templates/contact.html.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST["name"];
    $email   = $_POST["email"];
    $message = $_POST["message"];

    if (empty($name) || empty($email)|| empty($message)) {
        $errors[] = "All fields are required.";
        header("Location: contact.php");
    }



    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tainhgcc230213@fpt.edu.vn'; 
        $mail->Password   = 'gqmx apjr lqkp eoza';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->SMTPDebug =  0;
        $mail->Debugoutput="html";


        $mail->setFrom($email, $name);
        $mail->addAddress('tai874vn@gmail.com'); 

        
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body    = "<strong>Name:</strong> $name <br> <strong>Email:</strong> $email <br> <strong>Message:</strong> <p>$message</p>";

        $mail->send();
        header("Location: contact.php");
    } catch (Exception $e) {
        $error[] =  "Message could not be sent.";
    }
}
?>
