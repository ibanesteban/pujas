
<?php



include_once 'conectarBD.php';

include_once 'funciones/funcionesPHP.php';

sesion();

$misProyectos = obtenerMisProyectos();

?>
<h1 class="titulos">Mis proyectos</h1>
<!-- Tabla acordeon -->    

<div style="min-height:600px;width:75%; margin:0 auto;">
                        <table class="table table-hover" id="tabla-acordeon">
                                <thead>
                                    <tr>
                                        
                                        <th>Título</th>
                                        <th>Fecha Fin</th>
                                        <th>Estado</th>
                                        <th>Pujas</th>
                                        <th style="width: 180px;"></th>
                                    </tr>
                                </thead>
                        <table>

<?php
	
if(empty($misProyectos)){
        echo '</tbody></table><table><tr><td class="pujas" style="text-align:center;font-size:2em;">Aún no has creado ningún proyecto</td></tr></table>';
    }
else{
    $contProy=0;
	foreach($misProyectos as $p){

?>
                                    <!--PROYECTO-->
                                    <table class="fila-proyecto">
                                    <tbody>
                                    <tr class="acordeon" >	<!--a data-id hay que meterle el id del proyecto -->
                                      
                                        <td> <?php echo $p['title']; ?></td>
                                        <td> <?php echo convertirFecha_EnglishtoSpanish($p['date_end']); ?></td>
                                        <td><?php echo statusProjects($p['status']); ?></td>
                                        <?php $numPujas = obtenerNumPujas($p['id']); ?>
                                        <td><?php echo $numPujas; ?></td>
                                        <td class="operaciones" style="width: 180px;"><?php echo "<a href='detalle-proyecto.php?idProyecto=".$p['id']."'><img title='Ver detalles del proyecto' src='img/lupa.png' style='width: 30px; height: 30px; float:left'></a>";

                                            if($p['status'] == 0)
                                            {
                                            echo "  ";
                                            echo "<a href='borrar-proyecto.php?idProyecto=".$p['id']."'><img title='Eliminar proyecto' src='img/borrar.png' style='width: 30px; height: 30px;'></a>";
                                            }
                                            elseif($p['status'] == 1)
                                            {
                                                echo "  ";
                                                echo "<a href='validacion.php?cerrarProyecto=1&idProyecto=".$p["id"]."'><img title='Cerrar proyecto' src='img/trato2.png' style='width: 30px; height: 30px;'></a>";
                                            }
                                        ?>
                                        </td>
                                           
                                    </tr>

                                     <tr class="titulo-pujas"> 
                                    <!-- data-parent tiene que tomar el id del proyecto al que esta asociada esa puja; el data-id lleva el id de la puja, aunque da igual -->
                                        
                                        <td class="puja">Nombre Empresa</td>
                                        <td class="puja">Fecha Estimada</td>
                                        <td class="puja">Presupuesto</td>
                                        <td class="puja"></td>
                                        <td class="puja"></td>
                                        
                                    </tr>
<?php                       
                            if($p['status'] == 2)
                            {
                                $regs = pujaAceptada($p['id']);
                                $nombre = $regs['name'];
                                $precio = $regs['budget'];
                                $fecha = $regs['date_end'];
                                echo "<tr class='titulo-pujas'>
                                <td class='puja'><a href='perfil-publico.php?customer_id=".$regs['id']."'>".$nombre."</a></td>
                                <td class='puja'>".convertirFecha_EnglishtoSpanish($fecha)."</td>
                                <td class='puja'>".$precio."€</td>
                                <td class='puja'>Proyecto cerrado</td>
                                </tr>";
                            }
                            else
                            {

                            }
                            
$misPujas = obtenerPujas($p['id']);

if(empty($numPujas)){
        echo "<tr><td>No existen pujas</td></tr>";
}
else{

$contPujas = 0;
	foreach($misPujas as $puj){
        $statusProyecto = statusProjects($p['status']);
        if($statusProyecto == "Pactado"){            
?>

                                        <tr> 
                                    <!-- data-parent tiene que tomar el id del proyecto al que esta asociada esa puja; el data-id lleva el id de la puja, aunque da igual -->

                                        <td class="puja"><a href="perfil-publico.php?customer_id=<?php echo $puj['empresa'];?>"><?php echo $puj['name']; ?></td>
                                        <td class="puja"><?php echo convertirFecha_EnglishtoSpanish($puj['date_end']); ?></td>
                                        <td class="puja"><?php echo $puj['budget']." €"; ?></td>
                                        <td class="puja"><?php 
                                        if($puj['status'] == 1)
                                        {
                                            echo "<a href='validacion.php?aceptarPuja=1&idProy=".$p['id']."&idPuja=".$puj['id']."'><input type='button' class='boton ".obtenerOpcionPuja($puj['id'])."' name='acepta-proyecto' value='".obtenerOpcionPuja($puj['id'])."'></a>";                                   
                                        }
                                        else
                                        {                       
                                            echo "<input type='button' class='boton ".obtenerOpcionPuja($puj['id'])."' name='acepta-proyecto'  value='".obtenerOpcionPuja($puj['id'])."' readonly>"; 
                                        }
                                        ?>
                                        </td>
                                        <td class="puja"><?php echo "<a href='validacion.php?rechazarPuja=1&idProy=".$p['id']."&&idPuja=".$puj['id']."'><input type='button' class='rechaza-proyecto boton' name='rechaza-proyecto' value='Rechazar'></a>";?></td>
                                    </tr>
<?php
        }
        elseif($statusProyecto=="Cerrado"){
            
        }
        else{

?>

                                    <tr> 
                                    <!-- data-parent tiene que tomar el id del proyecto al que esta asociada esa puja; el data-id lleva el id de la puja, aunque da igual -->
                                        
                                        <td class="puja"><a href="perfil-publico.php?customer_id=<?php echo $puj['empresa'];?>"><?php echo $puj['name']; ?></td>
                                        <td class="puja"><?php echo convertirFecha_EnglishtoSpanish($puj['date_end']); ?></td>
                                        <td class="puja"><?php echo $puj['budget']." €"; ?></td>
                                        <td class="puja"><?php 
                                        if($puj['status'] == 1){



                                            echo "<a href='validacion.php?aceptarPuja=1&idProy=".$p['id']."&idPuja=".$puj['id']."'><input type='button' class='boton ".obtenerOpcionPuja($puj['id'])."' name='acepta-proyecto'value='".obtenerOpcionPuja($puj['id'])."'></a>"; 
                                            
                                        }
                                        else{                                  



                                        echo "<a href='validacion.php?aceptarPuja=1&idProy=".$p['id']."&idPuja=".$puj['id']."'><input type='button' class='boton ".obtenerOpcionPuja($puj['id'])."' name='acepta-proyecto' value='".obtenerOpcionPuja($puj['id'])."'></button></a>"; 
                                        }
                                        ?></td>
                                        <td class="puja"><?php echo "<a href='validacion.php?rechazarPuja=1&idPuja=".$puj['id']."'><input type='button' class=' boton rechaza-proyecto' name='rechaza-proyecto' value='Rechazar'></a>";?></td>
                                        
                                    </tr>
        

  <?php

        }
  	$contPujas++;
	}
}
	$contProy++;
 }
}

?>
                                </tbody>
                            </table>

<input style="float:right;margin-top:2%; font-size:20px;" type="submit" class="boton" name="nuevo-proyecto" value="Nuevo Proyecto" 
        onclick="location.href='nuevo-proyecto.php'">


</div>
</body>
<?php include('footer.php'); ?>
</html>