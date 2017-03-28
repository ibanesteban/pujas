<?php include('funciones/funcionesPHP.php');
sesion();
?>

	<br><br>
	<div class="nuevo-proyecto">
	<h1 class="titulos">Nuevo Proyecto</h1>
	<form id="nuevo-proyecto" class="texto" name="nuevo-proyecto" action="validacion.php" method="POST">
			<input type="hidden" name="idcliente" value="<?php echo $_SESSION['id'];?>">
			<input type="text" name="nombre-proyecto" placeholder="Título" value="" required>
			<input type="text" id="fecha-fin" class="fecha" name="fecha-fin" value="" required><label>Fecha Fin: </label>
			<textarea id="textonuevoproyecto" name="textonuevoproyecto" placeholder="Descripción del proyecto" value=""></textarea>

		<input style="float:right;margin-top:2%;font-size: 20px" type="submit" class="boton" id="creaproyecto" name="creaproyecto" value="Crear Proyecto">
	</form>
	</div>

<?php include('footer.php');?>