<?php
/********************************************************************************************

	ARCHIVO DE FUNCIONES GENERALES DE PHP


***********************************************************************************************/

/**********************************************************************************************/
//FUNCION PARA CONVERTIR UNA FECHA EN FORMATO CASTELLANO A FORMATO INGLES


function convertirFecha_SpanishToEnglish($date)

{

    if($date)

    {

        $fecha=$date;

        $hora="";

 

        # separamos la fecha recibida por el espacio de separación entre

        # la fecha y la hora

        $fechaHora=explode(" ",$date);

        if(count($fechaHora)==2)

        {

            $fecha=$fechaHora[0];

            $hora=$fechaHora[1];

        }

 

        # cogemos los valores de la fecha

        $values=preg_split('/(\/|-)/',$fecha);

        if(count($values)==3)

        {

            # devolvemos la fecha en formato ingles

            if($hora && count(explode(":",$hora))==3)

            {

                # si la hora esta separada por : y hay tres valores...

                $hora=explode(":",$hora);

                return date("Y/m/d H:i:s",mktime($hora[0],$hora[1],$hora[2],$values[1],$values[0],$values[2]));

            }else{

                return date("Y/m/d",mktime(0,0,0,$values[1],$values[0],$values[2]));

            }

        }

    }

    return "";
 }  

/**************************************************/
//FUNCION PARA DAR LA VUELTA A LA FECHA EN INGLES
 function convertirFecha_EnglishtoSpanish($fecha)

{
    
    $fecha=explode("-",$fecha);
   

   $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

    
    return $fecha;
 }  

/********************************************************************************************************************/

//FUNCION PARA CONSEGUIR LA FECHA Y LA HORA ACTUAL
function fechahoy(){
    $hoy = getdate();
    $fecha = $hoy['mday'].'/'.$hoy['mon'].'/'.$hoy['year']; 
    $hora = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
    $fechaactual = convertirFecha_SpanishToEnglish($fecha); 

    return $diayhora = $fechaactual.' '.$hora;
    

}



/**********************************************************************************************/
//FUNCION que dado un id te devuelve verdadero  si es cliente 

function esCliente($id)

{
   include "conectarBD.php";

   $query = "SELECT type FROM `users` WHERE `id`=$id";
   $registros = $mysqli->query($query);
   

   // Leemos el primer registro
        $reg = $registros->fetch_assoc();
        $tipo = $reg['type'];

        if ($tipo==0)
        {
            //echo "CLIENTE";
            return true;
        }
        elseif ($tipo==1)
        {
            //ECHO "EMPRESA";
            return false;
        }
    }
//funcion para obtener el id de empresa o cliente cuando se loguea con el email y el password
function getId($email)

{
    include "conectarBD.php";

     // Creamos una consulta
    $query = "SELECT id FROM `users` WHERE `email`='".$email."'";
   
    $registros = $mysqli->query($query);
          
    // Leemos el primer registro
    $reg = $registros->fetch_assoc();
    $n= $registros->num_rows;
        
        if($n==0){
            //echo 'Usuario no registrado';
            header("location:login.php?x=1");
        }
        else{
            return ($reg['id']);
            }
        
}



//funcion de ver el resultado de empresa o cliente
function obtenerCliente($id)

{
    include "conectarBD.php";

     // Creamos una consult
    $query = "SELECT * FROM `users`, `clients` WHERE `users`.`id`='$id' and `users`.`id`=`clients`.`user_id`";

    $registros = $mysqli->query($query);
          
    // Leemos el primer registro
    $reg = $registros->fetch_assoc();

    return ($reg);
  
        
}

//funcion de ver el resultado de empresa o cliente
function obtenerEmpresa($id)

{
    include("conectarBD.php");

    $query = "SELECT * FROM `users` , `developers` WHERE `users`.`id`='$id' and `users`.`id`=`developers`.`user_id`";

    $registros = $mysqli->query($query);
          
    // Leemos el primer registro
    $reg = $registros->fetch_assoc();

    return ($reg);
  
        
}

//funcion para ver el contenido de detalle web
function obtenerProyecto($id)
{
    include("conectarBD.php");

    $consulta = "SELECT * FROM PROJECTS WHERE customer_id = $id";
    $registros = $mysqli->query($consulta);

    //$reg = $registros->fetch_assoc();

    return $registros;
}

//funcion para ver el contenido de Nueva Puja
function obtenerBids($id)
{
    include("conectarBD.php");

    $consulta = "SELECT * FROM Bids WHERE  customer_id = $id";
    $registros = $mysqli->query($consulta);

    $reg = $registros->fetch_assoc();

    return $reg;
}

//funcion para loguearse e iniciar sesion
function login($email, $pass)

{
        include "conectarBD.php";

        //Obtenemos el id del usuario
        $id = getId($email);



        $clienteSI = esCliente($id);    // creamos variable que detecta si es empresa o cliente

        echo "estas en funcionesPHP.login()";

        if ($clienteSI)
        {
            $consulta = "SELECT users.id , users.name , users.activated, clients.surname FROM `users`, `clients` WHERE email = '".$email."'
                    AND users.id=user_id";
        }
        else
        {
            $consulta = "SELECT users.id , users.name , users.activated FROM `users` WHERE email = '".$email."'";
        }

        //echo $consulta;
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        $n= $registros->num_rows;
        
        if($n==0){
            //echo 'Usuario no registrado';
            header("location:login.php?x=1");
        }
        elseif($n==1){
            // echo 'Usuario registrado'
            $reg = $registros -> fetch_array();
            $id = $reg[0];
            $nombre = $reg[1];
            $apellido = $reg[3];
            //comprobar password
            if(comprobarPassword($pass, $id)){
                //comprobamos si el usuario está activado
                $activated = $reg[2];
                if($activated==1)
                {
                    session_start();
                    $_SESSION['id'] = $id;
                    $_SESSION['nombre'] = $nombre;
                    echo 'Usuario registrado';

                    if($clienteSI)
                    {
                     //   echo "ESCLIENTE";
                       header("location:misproyectos.php");
                    }
                    else{
                     //   echo "ESEMPRESA";
                       header("location:mispujas.php");
                    }

                }
                else
                {
                     //   echo "No estás activado aún, busca en tu correo el email con el link de confirmación";
                       header("location:login.php?x=2");

                }
            }
            else
            {
                // echo "El password no es correcto";

                       header("location:login.php?x=3");
            }

            


                

        }
    
}    
function comprobarPassword($pass, $id)
{
    include 'conectarBD.php';
    $consulta = "SELECT password FROM `users` WHERE id = '".$id."'";
    $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
    $reg = $registros->fetch_assoc();
    $passwordDB= $reg['password'];
    $verificarPassword = password_verify($pass, $passwordDB);
    echo "estoy en comprobarPassword()";
    
    return $verificarPassword;
}
//nos da el clients.id a partir del id de usuario
function obtenerIdCliente($id)

{
    
 include "conectarBD.php";

     // Creamos una consult
    $query = "SELECT  id  FROM  `clients` WHERE `clients`.`user_id`=$id";

    $registros = $mysqli->query($query);
          
    // Leemos el primer registro
    $reg = $registros->fetch_assoc();

    return ($reg['id']);
  
    
   }

function obtenerIdDesarrollador($id)

{
    
 include "conectarBD.php";

     // Creamos una consulta
    $query = "SELECT  `id`  FROM  `developers` WHERE `user_id`=$id";

    $registros = $mysqli->query($query);
          
    // Leemos el primer registro
    $reg = $registros->fetch_assoc();

    return ($reg['id']);
  
    
   }

function obtenerNombreCliente($customer_id)
{
    include("conectarBD.php");
        //CONSULTA PARA OBTENER EL NOMBRE DEL CLIENTE
        $consulta= "SELECT `surname`, `user_id` FROM `clients` WHERE `id` = $customer_id";
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        $registro=$registros->fetch_assoc();
        $apellido=$registro['surname'];
        $user_id=$registro['user_id'];
        $consulta= "SELECT `name` FROM `users` WHERE `id` = $user_id";
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        $registro=$registros->fetch_assoc();
        $nombre=$registro['name'];
        $nombreCompleto=$nombre.' '.$apellido;
        return $nombreCompleto;



}
//funcion para redimensionar las imagenes
function redimensionarJPEG ($origen, $destino, $ancho_max, $alto_max, $fijar) {

$info_imagen= getimagesize($origen);
$ancho=$info_imagen[0];
$alto=$info_imagen[1];
if ($ancho>=$alto)
{
    $nuevo_alto= round($alto * $ancho_max / $ancho,0);
    $nuevo_ancho=$ancho_max;
}
else
{
    $nuevo_ancho= round($ancho * $alto_max / $alto,0);
    $nuevo_alto=$alto_max;
}
switch ($fijar)
{
    case "ancho":
        $nuevo_alto= round($alto * $ancho_max / $ancho,0);
        $nuevo_ancho=$ancho_max;
        break;
    case "alto":
        $nuevo_ancho= round($ancho * $alto_max / $alto,0);
        $nuevo_alto=$alto_max;
        break;
    default:
        $nuevo_ancho=$nuevo_ancho;
        $nuevo_alto=$nuevo_alto;
        break;
}
$imagen_nueva= imagecreatetruecolor($nuevo_ancho,$nuevo_alto);
$imagen_vieja= imagecreatefromjpeg($origen);
imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0,$nuevo_ancho, $nuevo_alto, $ancho, $alto);
imagejpeg($imagen_nueva,$destino);
imagedestroy($imagen_nueva);
imagedestroy($imagen_vieja);
}
// FUNCION PARA GENERAR LA RUTA Y EXTENSION DE LA IMAGEN DE PERFIL QUE VA A LA BASE DE DATOS

function generarImagen($imagen,$origen){
    require ('PHP_image_resize-master/smart_resize_image.function.php');
    
        $tipo = explode(".", $imagen)[1];
        
        $hash = hash('md5',$imagen);

        $hash = "profile_".substr($hash, 0, 5);
        
        $arch_img = $hash.".".$tipo;

        $destino = "img\\".$arch_img;

        if (!smart_resize_image($origen , $arch_img, 200 , 200 , false , $destino , true , false ,100 ))

        //if (!copy($origen, $destino))
        {
            echo "Error al copiar la imagen";
        }

       return $arch_img;
        
    } 
        
        


function mandarCorreoActivacion($correo, $salt){
                require 'phpmailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                                                                           
                    $to = $correo;
                    $asunto = "Activar cuenta Mamayak ";

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'mamayak12345@gmail.com';                 // SMTP username
                $mail->Password = 'proyectomamayak';                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                $mail->setFrom('mamayak12345@gmail.com');
                $mail->addAddress($to);     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                //$mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $asunto;
                $mail->Body    = 'Clicka el siguiente link para verificar tu cuenta de Mamayak 
                
                http://mamayak.esy.es/login.php?n='.$salt;
                $mail->AltBody = 'Link';

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'El mensaje se envio correctamente';
                }
                
            }

function mandarCorreoRecuperarContraseña($correo, $remember_token){
                require 'phpmailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                                                                           
                    $to = $correo;
                    $asunto = "Recuperar password Mamayak ";

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'mamayak12345@gmail.com';                 // SMTP username
                $mail->Password = 'proyectomamayak';                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                $mail->setFrom('mamayak12345@gmail.com');
                $mail->addAddress($to);     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                //$mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $asunto;
                $mail->Body    = 'Este es tu código de recuperación de contraseña<br>'.$remember_token.'<br>
                Puedes recuperala desde el siguiente link: <br> http://mamayak.esy.es/recuperar-contrasena2.php';
                $mail->AltBody = 'Link';

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'El mensaje se envio correctamente';
                }
                
            }

function mandarCorreoPujaAceptada($correo_empresa, $client_name, $project_title, $correo_cliente){
                require 'phpmailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                                                                           
                    $to = $correo_empresa;
                    $asunto = "Puja aceptada en Mamayak ";

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'mamayak12345@gmail.com';                 // SMTP username
                $mail->Password = 'proyectomamayak';                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                $mail->setFrom('mamayak12345@gmail.com');
                $mail->addAddress($to);     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                //$mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $asunto;
                $mail->Body    = $client_name.' ha aceptado tu puja para el proyecto '.$project_title.'.<br>
                Ponte en contacto con el para cerrar el proyecto.<br>
                Su correo es '.$correo_cliente;
                $mail->AltBody = 'Link';

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'El mensaje se envio correctamente';
                }
                
            }

function getRememberToken($email)
{
        include 'conectarBD.php';

            $consulta="SELECT remember_token FROM users WHERE email='".$email."'";
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            $reg = $registros->fetch_assoc();
            return $reg['remember_token'];
}




function activarUsuario($salt)
{
    include 'conectarBD.php';

            $consulta="SELECT * FROM users WHERE salt='".($salt)."'";
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            $i= $registros->num_rows;
            if($i==0){
                //no hay ningun usuario registrado con ese salt
                echo "<div class='msg-error'>No estas registrado aún<div>";
                
            }
            elseif($i==1){
                //ya hay un usuario registrado con ese email
                 echo "<div class='msg-ok'>Ya estas registrado logueate</div>";
            }
            $consulta="UPDATE users SET `activated`= 1, `salt`= NULL WHERE salt='".($salt)."'";
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));

}

function noLogin($x)
{
   switch($x){
        case 1: 
            $msg1= "<div class='msg-error'>El usuario introducido no existe</div>";
            return $msg1;
        break;
            
        case 2: 
            $msg2= "<div class='msg-error'>Aún no has activado tu cuenta, comprueba tu correo</div>";
            return $msg2;
        break;
            
        case 3: 
            $msg3= "<div class='msg-error'>El password no es correcto</div>";
            return $msg3;
        break;
            
        case 4: 
            $msg4= "<div class='msg-error'>El código de activación no es correcto</div>";
            return $msg4;
        break;
            
        case 5: 
            $msg5= "<div class='msg-ok'>Contraseña modificada correctamente</div>";
            return $msg5;
        break;
        case 6: 
            $msg6= "<div class='msg-ok'>Tus datos han sido modificados correctamente</div>";
            return $msg6;
        break;
    }

}


function sesion(){

    session_start();


    // comprobamos si se ha iniciado sesion o no

    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
        if(esCliente($id)){

                include 'header-cliente.php';
        }
        else
        {
                // metemos el menu de empresa
                include 'header-empresa.php';
        }
    }
    else
    {
        include 'header.php';
    }

}


// FUNCION PARA LISTAR LAS PUJAS DE UN CLIENTE LOGUEADO (tabla acordeón)


function obtenerPujas($idProyecto)
{
  

  include("conectarBD.php");

    $consulta = "SELECT users.id as empresa, bids.id, users.name, bids.date_end, bids.budget, bids.status FROM bids, developers, users  WHERE projects_id="
                .$idProyecto." AND bids.vendor_id = developers.id AND developers.user_id = users.id AND bids.status != 2";

               //echo $consulta;

    $registros = $mysqli->query($consulta);

    $pujas = [];
    while ($reg = $registros->fetch_assoc())
    {
      $pujas[] = $reg;
    }
    
    return $pujas;

}


// FUNCION QUE LISTA LOS PROYECTOS DE UN CLIENTE LOGUEADO

function obtenerMisProyectos()
{
   
    include("conectarBD.php");

    $id_usuario = $_SESSION['id'];
    $id_cliente = obtenerIdCliente($id_usuario);
    $consulta = "SELECT id, title, date_end, status, customer_id FROM projects WHERE customer_id = $id_cliente";

    //echo $consulta;
    $registros = $mysqli->query($consulta);
    $proyectos = [];
    while ($reg = $registros->fetch_assoc())
    {
      $proyectos[] = $reg;
    }

    return $proyectos;
    
}
//obtiene el numero de pujas para cada proyecto
function obtenerNumPujas($projectId){

    include("conectarBD.php");

    $consulta = "SELECT count(*) as cuenta, date_end, budget FROM bids, developers, users WHERE projects_id = $projectId AND vendor_id = developers.id AND developers.user_id = users.id AND bids.status != 2";
    $registros = $mysqli->query($consulta);
    $reg = $registros->fetch_assoc();
    return $reg['cuenta'];

}



//nos da todas las pujas que ha hecho un desarrollador
function obtenerMisPujas($vendor_id){
    include("conectarBD.php");

    $consulta = "SELECT bids.id, projects.title, projects.date_end as fecha_fin, bids.date_end as fecha_estimada, bids.budget, bids.status FROM projects, bids  WHERE bids.vendor_id =".$vendor_id." AND bids.projects_id = projects.id";

    

    $registros = $mysqli->query($consulta);

    $pujas = [];
    while ($reg = $registros->fetch_assoc())
    {
      $pujas[] = $reg;
    }
    
    return $pujas;
}



//nos da todos los proyectos activos en ese momento
    function obtenerProyectosActivos(){
        include("conectarBD.php");
        //CONSULTA PARA OBTENER TODOS LOS PROYECTOS ACTIVOS
        $consulta="SELECT projects.*, clients.user_id FROM projects,clients WHERE clients.id=projects.customer_id and status = 0";
        $proyectos = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        return $proyectos;
    }

//obtiene el proyecto para el detalle
function obtenerDetalleProyecto($id){
    include("conectarBD.php");

    $query = "SELECT * FROM `projects` WHERE `id`=$id";

    $registros = $mysqli->query($query);
          
    // Leemos el primer registro
    $reg = $registros->fetch_assoc();

    return ($reg);
}    

// obtiene el estado del proyecto en funcion del valor de la base de datos
    
function statusProjects($estado){
    switch($estado){
        case '0': return "En Proceso";
        break;
        case '1': return "Pactado";
        break;
        case '2': return "Cerrado";
    }
}   

// obtiene el estado de la puja en funcion del valor de la base de datos

function statusBids($estado){
    switch($estado){
        case '0': return "Pendiente";
        break;
        case '1': return "Aprobada";
        break;
        case '2': return "Rechazada";
    }
} 

// funcion para cambiar el valor del estado de la puja

function obtenerOpcionPuja($estado){

    include 'conectarBD.php';
    $consulta = "SELECT status FROM bids WHERE id = $estado";
    $registro = $mysqli->query($consulta);
    $reg = $registro->fetch_assoc();
    $estado = $reg['status'];

    if($estado == 0){
        return "Aceptar";
    }
    elseif($estado == 1){
        return "Anular";
    }
}

// FUNCION QUE DADA UNA PUJA ACEPTADA PARA UN PROYECTO, LO MUESTRA EN EL DESPLEGABLE DE MIS PROYECTOS

function pujaAceptada($idProyecto){
    include 'conectarBD.php';
    $consulta = "SELECT users.id, users.name, bids.date_end, bids.budget FROM bids, developers, users  WHERE projects_id="
                .$idProyecto." AND bids.vendor_id = developers.id AND developers.user_id = users.id AND bids.status = 1";
    $registros = $mysqli->query($consulta);
    $reg = $registros->fetch_assoc();
    return($reg);
}

// FUNCION QUE BORRA UN PROYECTO (EN MIS PROYECTOS) Y SUS PUJAS ASOCIADAS

function borrarProyecto($idProyecto){
    include 'conectarBD.php';
    $consulta = "DELETE FROM projects WHERE id = $idProyecto";
    $ejecutar = $mysqli->query($consulta);
}

// FUNCION QUE BORRA UNA PUJA (EN MIS PROYECTOS)

function borrarPuja($idPuja){
    include 'conectarBD.php';
    $consulta = "DELETE FROM bids WHERE id = $idPuja";
    $ejecutar = $mysqli->query($consulta);
}


function correoPujaAceptada($idProyecto, $idPuja){
    include 'conectarBD.php';
    $consulta1 = "SELECT users.email, users.name, clients.surname, projects.title FROM users, clients, projects
                WHERE projects.id = $idProyecto AND projects.customer_id = clients.id AND clients.user_id = users.id";
    $consulta2 = "SELECT users.email FROM users, developers, bids
                WHERE bids.id = $idPuja AND bids.vendor_id = developers.id AND developers.user_id = users.id";
    $registros1 = $mysqli->query($consulta1);
    $reg1 = $registros1->fetch_assoc();
    $registros2 = $mysqli->query($consulta2);
    $reg2 = $registros2->fetch_assoc();
    $registros = [''];
    $correo_cliente = $reg1['email'];
    $nombre = $reg1['name']." ".$reg1['surname'];
    $proy_titulo = $reg1['title'];
    $correo_empresa = $reg2['email'];
    $registros = [$correo_empresa, $nombre, $proy_titulo, $correo_cliente];

    return$registros;
}

function rechazarPujasNoAceptadas($idProyecto){
    include 'conectarBD.php';
    $consulta1 = "UPDATE bids SET status = 2 WHERE projects_id = $idProyecto AND status = 0 ";
    $registros1 = $mysqli->query($consulta1);

}
?>
