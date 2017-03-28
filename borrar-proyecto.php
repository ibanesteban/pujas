
<?php

include("funciones/funcionesPHP.php");
sesion();

$idProyecto = $_GET['idProyecto'];

$reg = obtenerDetalleProyecto($idProyecto);
 
if ($reg['status'] == 0 || $reg['status'] ==1){
	borrarProyecto($idProyecto);
	header("location:misproyectos.php");
}
?>


</body>
</html>