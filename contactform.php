<?php

include("Mailer/src/PHPMailer.php");
include("Mailer/src/SMTP.php");
include("Mailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    $name = $_POST["name"];
    $emailfrom = $_POST["email"];
    $subject = $_POST["subject"];
    $bodyemail = $_POST["message"];

    $emailto = "sombrasoficial@outlook.com";
    $host = "smtp.office365.com";
    $port = "587";
    $SMTPAuth = "login";
    $SMTPSecure = "STARTTLS";
    $password = "Alasombra_22"

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = $SMTPAuth;
    $mail->SMTPSecure = $SMTPSecure;
    $mail->Username = $emailto;
    $mail->Password = $password;

    $mail->setFrom($emailfrom, $name);
    $mail->addAddress($emailto);

    $mail->isHTML(true);
    $mail->subject = $subject;

    $mail->Body = $bodyemail

    if ($mail->Send()){
        echo "¡Su mensaje fue enviado satisfactoriamente!"; die();
        } else {
            echo "Ocurrió un error al enviar su mensaje. Intente de nuevo."; die();
    }
    catch (Exception $e){

    }
}

$mail->SMTPClose();
?>