<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'resources/phpmailer/src/Exception.php';
require 'resources/phpmailer/src/PHPMailer.php';
require 'resources/phpmailer/src/SMTP.php';


function sendMail($subject, $message, $user)
{

    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->CharSet = "UTF-8";
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.ionos.de";
    $mail->Port = 465; // or 587
    $mail->Username = "office@vacayournal.com";
    $mail->Password = "hierstandmaleingeheimespasswort";
    $mail->SetFrom("office@vacayournal.com");
    $mail->FromName = "Vacayournal";
    $mail->Subject = "$subject";
    $mail->Body = "$message";
    $mail->IsHTML(true);
    $mail->AddAddress("$user");
    $mail->Send();

}


?>