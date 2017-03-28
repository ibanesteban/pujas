<?php
/********************************************************************************************

	ARCHIVO PARA PROBAR FUNCIONES 

***********************************************************************************************/

/**********************************************************************************************/


include "conectarBd.php";

function login()

{
    

    
        $consulta= "SELECT * FROM `users` WHERE password ='".$_POST['pass']."' AND email = '".$_POST['email']."'"
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        var_dump($registros);
        // SELECT * FROM `users` WHERE password =6789 AND email = 'eneko@gmail.com' 
  
        
}



function mandarCorreoActivacion($correo, $salt){
                require 'phpmailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                                                                           
                    $to = $correo;
                    $asunto = "Activación cuenta Mamayak ";

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'mamayak12345@gmail.com';                 // SMTP username
                $mail->Password = 'proyectomamayak';                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                $mail->setFrom('mamayak12345@gmail.com');
                $mail->addAddress('mamayak12345@gmail.com');     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                //$mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $asunto;
                $mail->Body    = 'Clicka el siguiente link para verificar tu cuenta de Mamayak www.mamayak'.$salt;
                $mail->AltBody = 'Link';

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'El mensaje se envio correctamente';
                }
                
            }




?>