<?php

include_once 'funciones/funcionesPHP.php';

sesion();
$id=$_SESSION['id'];

if ($_GET)
{        	
    if(isset($_GET['i'])){        	
        		$proyectoId=$_GET['i'];
    }        	       	
}

/*
function obtenerDetalleProyecto($id){
	include("conectarBD.php");

    $query = "SELECT * FROM `projects` WHERE `id`=$id";

    $registros = $mysqli->query($query);
          
    // Leemos el primer registro
    $reg = $registros->fetch_assoc();

    return ($reg);
}  
*/
    $detallesProyecto= obtenerDetalleProyecto ($proyectoId);
    $fechafin=convertirFecha_EnglishtoSpanish($detallesProyecto['date_end']);
    $vendorId=obtenerIdDesarrollador($id);

        ?>
    
	<br><br>
	<div class="nueva-puja">
	<h1 class="titulos limpiar">Nueva puja</h1>
	<form class="texto" id="nueva-puja" name="nueva-puja" action="validacion.php" method="POST">
		<fieldset>
		 <legend>Datos del proyecto</legend>
		 	<input type="hidden" name="vendor_id" value="<?php echo $vendorId; ?>">
		 	<input type="hidden" name="project_id" value="<?php echo $proyectoId; ?>">
			<input type="text" name="nombre-proyecto" placeholder="Proyecto Web" value="<?php echo $detallesProyecto['title']; ?>" readonly>
			<input type="text" class="fecha" name="fecha-fin" value="<?php echo $fechafin; ?>" readonly><label>Fecha Fin: </label>
			<textarea id="textonuevapuja" name="textonuevapuja" value="" readonly><?php echo $detallesProyecto['observations']; ?></textarea>
		</fieldset>
		<div>
		<input type="number" min="0" id="presupuesto" name="presupuesto" placeholder="Presupuesto" value="" required>
		<input type="text" id="fecha-fin" class="fecha" name="fecha-fin-estimada" value="" required><label>Fecha Estimada: </label>
		</div>
		<div>
		<input  style="float:right;margin-top:6%; margin-bottom:2% ;font-size: 20px" type="submit" class="boton"  id="crearpuja" name="crearpuja" value="Crear Puja">
		</div>
	</form>
	</div>
	

<?php include('footer.php');?>	