<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);

        try {
            // Server settings
            $this->mail->isSMTP();
            $this->mail->Host = 'sandbox.smtp.mailtrap.io';
            $this->mail->SMTPAuth = true;
            $this->mail->Port = 2525;
            $this->mail->Username = '4d48b8e7828855';
            $this->mail->Password = 'd6f0a0c1463508';
            $this->mail->setFrom('no-reply@example.com', 'YourAppName');
        } catch (Exception $e) {
            error_log("Mailer Error: {$this->mail->ErrorInfo}");
        }
    }

    public function sendMail($to, $subject, $body) {
        try {
            // Recipients
            $this->mail->addAddress($to);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }
}
