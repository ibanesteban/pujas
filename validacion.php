<?php 
include 'funciones/users.php';
include 'funciones/clients.php';
include 'funciones/developers.php';
include_once 'funciones/projects.php';
include 'funciones/bids.php';
include 'funciones/funcionesPHP.php';
//include 'funciones/ProbandoFunciones.php';

if($_POST){

	//Validación para crear usuarios que son empresas desarrolladoras
	if(isset($_POST['registro-empresa']))
	{
		// si el password tiene menos de seis caracteres devolvemos a la página de registro con el mensaje de error
		if(strlen($_POST['password'])<6)
		{		
			header("location:registro_empresa.php?m=2");
	    }	  
	    else
	    {   
			$atributes = [];
			$atributes['email']= $_POST['email'] ;
			$atributes['name']= $_POST['name2'] ;
			$atributes['cif']= $_POST['cif'] ;
			$atributes['web']= $_POST['web'] ;
			$atributes['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
			$atributes['remember_token'] = substr($atributes['password'], 50, 10);		
			$atributes['type']= 1;
			$atributes['date_creation']= fechahoy();
			$user= new User;
			// si ya existe un usuario con ese email devolvemos a la página de registro con el mensaje de error
			if ($user->comprobarCorreo($atributes['email']))
			{
				header("location:registro_empresa.php?m=1");
			}
			else
			{
				$user->registrar($atributes);
				$developer= new Developer;
				$developer->registrar($atributes);
				header("location:login.php?x=2");
			}
		}
		
	}

	//Validación para crear usuarios que son clientes
	if(isset($_POST['registro-cliente']))
	{
		// si el password tiene menos de seis caracteres devolvemos a la página de registro con el mensaje de error
		if(strlen($_POST['password'])<6)
		{
			header("location:registro.php?m=2");
	    }
	    else
	    {
		    $atributes = [];
			$atributes['email']= $_POST['email'] ;
			$atributes['name']= $_POST['name2'] ;
			$atributes['surname']= $_POST['surname'] ;
			$atributes['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
			$atributes['remember_token'] = substr($atributes['password'], 50, 10);
			$atributes['type']= 0;
			$atributes['date_creation']= fechahoy();
			$user= new User;
			// si ya existe un usuario con ese email devolvemos a la página de registro con el mensaje de error
			if ($user->comprobarCorreo($atributes['email']))
			{
				header("location:registro.php?m=1");
			}
			else
			{
				$user->registrar($atributes);
				$client= new Client;
				$client->registrar($atributes);
				header("location:login.php?x=2");
			}
		}
	}

	}
	//Validación para loguearse en la aplicacion	
	if(isset($_POST['login']))
	{		
		$pass= $_POST['pass'];
		$email= $_POST['email'];
		login($email, $pass);
		
	}

	//Validación para recuperar la contraseña1 mandando un correo
	if(isset($_POST['recuperar'])){
		
		$email= $_POST['email'];
		
		$user= new User;
		$comprobacion=$user->comprobarCorreo($email);
		if($comprobacion==0)
		{
			header("location:recuperar-contrasena.php?x=1");
		}
		else
		{
			$remember_token=getRememberToken($email);
			mandarCorreoRecuperarContraseña($email, $remember_token);
			header("location:recuperar-contrasena2.php?x=6");
		}		
	}
	//Validación para cambiar la contraseña2	cuando se introduce el código de activación
	if(isset($_POST['cambiar-contra'])){
		
		$email= $_POST['email'];
		$user= new User;
		$comprobacion=$user->comprobarCorreo($email);
		if($comprobacion==0)
		{
			header("location:recuperar-contrasena2.php?x=1");
		}
		else
		{
			$remember_token=$_POST['codigo'];
			$validacion=$user->comprobarCodigo($remember_token);
			if($validacion==0)
			{
				header("location:recuperar-contrasena2.php?x=4");
			}
			else
			{	
			$atributes=[''];
			$atributes['email'] = $email;
			$atributes['new_password'] = password_hash($_POST['contra'],PASSWORD_DEFAULT);
			$atributes['remember_token'] = substr($atributes['new_password'], 50, 10);
			$user->modificarPassword($atributes);
			header("location:login.php?x=5");
			}
		}		
	}



		

	/******************/
	//ESTA ES LA VALIDACION DE LA CREACION DE PROYECTOS
	if(isset($_POST['creaproyecto'])){
		$atributes = [];
		$atributes['title']= $_POST['nombre-proyecto'] ;
		$atributes['fecha-fin']= $_POST['fecha-fin'] ;
		$atributes['textonuevoproyecto']= $_POST['textonuevoproyecto'] ;
		$atributes['idcliente']=obtenerIdCliente($_POST['idcliente']);
		$project= new Project;
		$project->registrar($atributes);
		header("location:misproyectos.php");
		
	}

	/******************/
	//ESTA ES LA VALIDACION DE LA CREACION DE PUJAS
	if(isset($_POST['crearpuja'])){
		$atributes = [];
		$atributes['budget']= $_POST['presupuesto'] ;
		$atributes['date_end']= convertirFecha_SpanishToEnglish($_POST['fecha-fin-estimada']) ;
		$atributes['date_creation']= fechahoy();
		$atributes['vendor_id']= $_POST['vendor_id'] ;
		$atributes['project_id']= $_POST['project_id'] ;
		$bid= new Bid;
		$bid->crear_puja($atributes);
		echo 'Tu puja ha sido registrada.';
		header("location:mispujas.php");
	}
	/******************/
	//ESTA ES LA VALIDACION DE LA MODIFICACIÓN DEL PERFIL DE CLIENTE
	if(isset($_POST['modificar-cliente'])){
		include_once ('conectarBD.php');
	$id= $_POST["id"];
	$name= $_POST["name"];
    $surname=$_POST["surname"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $city=$_POST["city"];
    $linkedin=$_POST["linkedin"];
    $company_name=$_POST["company_name"];
    $company_website=$_POST["company_website"];
    $company_location=$_POST["company_location"];
    $company_address=$_POST["company_address"];
    $imagen=$_FILES["imagen"];
    $reg['profile_photo']= $_POST["profile_photo"];


    if($imagen['error']== 0){
		      $arch_img = generarImagen($imagen['name'],$imagen['tmp_name']);
	}
	else{
	      $arch_img = $reg['profile_photo'];
	}

	$query1 = "UPDATE users SET name = '".$name."',email = '".$email."', profile_photo = '".$arch_img."', phone='".$phone."' , city='".$city."'  WHERE users.id = ".$id;
		 echo "$query1";

	$query2= "UPDATE clients SET surname ='".$surname."',linkedin='".$linkedin."',company_website='".$company_website."',
		company_name='".$company_name."', company_location='".$company_location."',company_address='".$company_address."'  
		 WHERE clients.user_id=".$id;



	$mysqli->query($query1); 
	$mysqli->query($query2);

	echo 'Tus datos han sido modificados.';
	header("location:miperfil.php?x=6#salto");
	}


	/******************/
	//ESTA ES LA VALIDACION DE LA MODIFICACIÓN DEL PERFIL DE EMPRESA
	if(isset($_POST['modificar-empresa'])){
		echo "estoy en modificar-empresa ";
		include_once ('conectarBD.php');
	$id= $_POST["id"];
	$name= $_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $website=$_POST["website"];
    $cif=$_POST["cif"];
    $manager_name=$_POST["manager_name"];
    $manager_surname=$_POST["manager_surname"];
    $manager_phone=$_POST["manager_phone"];
    $address=$_POST["address"];
    $company_imagen=$_FILES["imagen"];
    $reg['profile_photo']= $_POST["profile_photo"];
    
    
	if($company_imagen['error']== 0)
	{
	      $arch_img = generarImagen($company_imagen['name'],$company_imagen['tmp_name']);
	}
	else{
	      $arch_img = $reg['profile_photo'];
	}
	   

	$query1 = "UPDATE users SET name = '".$name."', email = '".$email."', profile_photo = '".$arch_img."',phone='".$phone."'  WHERE users.id = ".$id;

	$query2= "UPDATE developers  SET address = '".$address."',website='".$website."',manager_name='".$manager_name."',manager_surname='".$manager_surname."', manager_phone='".$manager_phone."', cif=
	'".$cif."' WHERE developers.user_id=".$id;


	 $mysqli->query($query1); 
	 $mysqli->query($query2);

	echo 'Tus datos han sido modificados.';
	header("location:miperfil.php?x=6#salto");
	}


if($_GET){
	/******************/
	//ESTA ES LA VALIDACION PARA ACEPTAR O ANULAR PUJAS, modifica el estado de la puja y del proyecto
	if(isset($_GET['aceptarPuja'])){		
		$idPuja= $_GET['idPuja'] ;
		$idProy= $_GET['idProy'] ;
		$bid= new Bid;
		$bid->modificarStatus('aceptar', $idPuja);
		$project= new Project;
		$project->modificarStatus('aceptar', $idProy);
		//guardamos en la variable $datos el correo de la empresa, el nombre del cliente, el titulo del proyecto y el correo del cliente
		$datos = correoPujaAceptada($idProy, $idPuja);
		mandarCorreoPujaAceptada($datos[0], $datos[1], $datos[2], $datos[3]); 
		header("location:misproyectos.php");
	}

	/******************/
	//ESTA ES LA VALIDACION PARA RECHAZAR PUJAS, modifica el estado de la puja
	if(isset($_GET['rechazarPuja'])){		
		$idPuja= $_GET['idPuja'] ;
		$bid= new Bid;
		$bid->modificarStatus('rechazar', $idPuja);
		header("location:misproyectos.php");

	}

	/******************/
	//ESTA ES LA VALIDACION PARA CERRAR PUJAS, modifica el estado del proyecto
	if(isset($_GET['cerrarProyecto'])){
		
		$idProyecto= $_GET['idProyecto'] ;
		$project= new Project;
		$project->modificarStatus('cerrar', $idProyecto);
		rechazarPujasNoAceptadas($idProyecto);
		header("location:misproyectos.php");
	}
		
	
}

?>