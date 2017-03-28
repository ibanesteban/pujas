
<?php

include("funciones/funcionesPHP.php");
sesion();




$idProyecto = $_GET['idProyecto'];

$reg = obtenerDetalleProyecto($idProyecto);
 
$fechafin=convertirFecha_EnglishtoSpanish($reg['date_end']);
?>


<div class="detalle-proyecto">
<h1 class="titulos"> Detalle Proyecto Web</h1>

	<input  type="text" name="nombre-proyecto" value="<?php echo $reg['title']; ?>"/>
	<input type="text" class="estado" name="estado" value="<?php echo statusProjects($reg['status']); ?>"/>
	<input  type="text" name="fecha-fin" class="fecha" value="<?php echo $fechafin; ?>" readonly/>
	<label class="texto3" >Fecha Fin: </label>

	<textarea><?php echo $reg['observations']; ?></textarea>
<?php 
if ($reg['status'] == 1){
?>
<a href="validacion.php?<?php echo 'cerrarProyecto=1&idProyecto='.$reg["id"]; ?>">
<input type="button" id="cerrarproyecto" name="cerrarproyecto" value="Cerrar proyecto"></a>
<?php
}
else{
?>	
	<input type="button" name="volver" value="Volver" onclick="history.back()">
<?php	
}
?>
</div>




<?php include('footer.php'); ?>	
</body>
</html>