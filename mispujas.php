
<?php



include_once 'conectarBD.php';

include_once 'funciones/funcionesPHP.php';

sesion();

$id=$_SESSION['id'];
$developer_id=obtenerIdDesarrollador($id);
$misPujas = obtenerMisPujas($developer_id);


?>
<h1 class="titulos">Mis pujas</h1>
<!-- Tabla acordeon -->    

<div style="min-height:600px;width:75%; margin:0 auto;">
                        <table class="table table-hover" id="tabla-acordeon">
                                <thead>
                                    <tr>
                                        
                                        <th>Proyecto</th>
                                        <th>Fecha Fin</th>
                                        <th>Fecha Estimada</th>
                                        <th>Presupuestado</th>
                                        <th>Estado</th>
                                        <th></th>

                                    </tr>
                                </thead>
                            <tbody>
                        
	<?php

	if(empty($misPujas)){
        echo '</tbody></table><table><tr><td class="pujas" style="text-align:center;font-size:2em;">Aún no has realizado ninguna puja</td></tr></table>';
    }
    else{
        	foreach($misPujas as $puj){
        		?>
                                            <tr > 
                                                                                    
                                                <td ><?php echo $puj['title']; ?></td>
                                                <td ><?php echo convertirFecha_EnglishtoSpanish($puj['fecha_fin']); ?></td>
                                                <td ><?php echo convertirFecha_EnglishtoSpanish($puj['fecha_estimada']); ?></td>
                                                <td ><?php echo $puj['budget']; ?>€</td>
                                                <td class="<?php echo statusBids($puj['status']); ?>"><?php echo statusBids($puj['status']); ?></td>
                                                <td class="puja">
                                                <?php
                                                    if($puj['status'] == 0){
                                                        echo "<a href='borrar-proyecto-puja.php?idPuja=".$puj['id']."'><img title='Retirar puja' src='img/borrar.png' style='width: 30px; height: 30px; margin:0 auto; '></a>";
                                                    }

                                                ?></td>
                                                
                                            </tr>

            <?php 
         	}
            ?>

                                    </tbody>
                                </table>
    <?php 
    }
    ?>

</div>

<?php include('footer.php'); ?>
</body>

</html>