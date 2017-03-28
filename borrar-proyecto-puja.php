
<?php

include("funciones/funcionesPHP.php");
sesion();

if(isset($_GET['idProyecto'])){

	$idProyecto = $_GET['idProyecto'];

	$reg = obtenerDetalleProyecto($idProyecto);
	 
		if ($reg['status'] == 0 || $reg['status'] ==1){
			borrarProyecto($idProyecto);
			header("location:misproyectos.php");
		}
}

if(isset($_GET['idPuja'])){
	
	$idPuja = $_GET['idPuja'];

			borrarPuja($idPuja);
			header("location:mispujas.php");
		
}

?>
