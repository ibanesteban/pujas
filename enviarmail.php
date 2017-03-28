<?php

require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

	$nombre=$_POST["nombre"];
	$email=$_POST["email"];
	$asunto=$_POST["asunto"];
	$dudas=$_POST["dudas"];
	
	$to = "mamayak12345@gmail.com";
	$asunto = "Consulta de $email - Asunto $asunto ";

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mamayak12345@gmail.com';                 // SMTP username
$mail->Password = 'proyectomamayak';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$mail->setFrom($email, 'Mamayak Website');
$mail->addAddress($to, 'Usuario');     // Add a recipient
//$mail->addAddress($email);               // Name is optional
$mail->addReplyTo($email, $nombre);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $nombre." - ".$asunto;
$mail->Body    = $dudas;
$mail->AltBody = $dudas;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo header("location:contacto.php?m=1");
}