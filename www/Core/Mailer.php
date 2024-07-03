<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailer {
    public function sendMail($to, $subject, $body) {
        try {
            // PHPMailer configuration
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io'; // Update with your SMTP server details
            $mail->SMTPAuth = true;
            $mail->Username = '4d48b8e7828855'; // Update with your SMTP username
            $mail->Password = 'd6f0a0c1463508'; // Update with your SMTP password
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('mahmoudaziznasraoui@gmail.com', 'Mailer'); // Update with your sender email and name
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Send email
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function sendVerificationEmail($to, $token): void
    {
        $subject = 'Email Verification';
        $body = "Please click on the following link to verify your email address: <a href='http://yourdomain.com/verify?token=$token'>Verify Email</a>";

        $this->sendMail($to, $subject, $body);
    }
}
