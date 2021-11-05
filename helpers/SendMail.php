<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once 'third-party/php-mailer/src/PHPMailer.php';
require_once 'third-party/php-mailer/src/SMTP.php';
require_once 'third-party/php-mailer/src/Exception.php';

class SendMail {
    private PHPMailer $mailer;
    private Logger $logger;

    public function __construct($logger, $mail, $password) {
        $this->mailer = new PHPMailer();
        $this->logger = $logger;
        $this->setup($mail, $password);
    }

    private function setup($mail, $password) {

        $this->mailer->IsSMTP(); // enable SMTP
        $this->mailer->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $this->mailer->SMTPAuth = true; // authentication enabled

        $this->mailer->Host = "smtp.gmail.com";
        $this->mailer->Port = 587; // or 587
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->CharSet = "UTF-8";
        $this->mailer->IsHTML(true);
        $this->mailer->Username = $mail;
        $this->mailer->Password = $password;
        try {
            $this->mailer->SetFrom($mail, "Gaucho Rocket");
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            die("Algo salió mal.");
        }
    }

    public function sendMail($to, $name, $subject, $message) {
        try {
            $this->mailer->addAddress($to, $name);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $message;

            if ($this->mailer->send()) {
                $this->logger->info("correo enviado con éxito");
            } else {
                $this->logger->error("error al intentar enviar el correo");
                die("No se pudo enviar el correo");
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}