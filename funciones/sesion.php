<?php

// FUNCION PARA MANEJAR LOS MENUS DEPENDIENDO DEL TIPO DE SESION

include 'funcionesPHP.php';

function sesion(){

session_start();


// comprobamos si se ha iniciado sesion o no

if(isset($_SESSION['id'])){
	
	if(esCliente('$id')){
			include 'header-cliente.php';
	}else{
			// metemos el menu de empresa
			include 'header-empresa.php';
	}
}
else{

	include 'header.php';

}

}
?>