<?php

include_once 'funciones/funcionesPHP.php';

sesion();
?>
<h1 class="titulos">Proyectos activos</h1>


<div style="min-height:600px;width:75%; margin:0 auto;">
                        <table class="table table-hover" id="tabla-acordeon">
                                <thead>
                                    <tr>                                        
                                        <th>Título</th>
                                        <th>Fecha Fin</th>
                                        <th>Cliente</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                            
<?php




            $proyectos= obtenerProyectosActivos();
            while ($proyecto=$proyectos->fetch_assoc()){
                echo '<tr>';
                        $nombreCliente=obtenerNombreCliente($proyecto['customer_id']);                
                        echo '<td><a href="detalle-proyecto.php?idProyecto='.$proyecto['id'].'">'.$proyecto['title'].'</a></td>';
                        echo '<td>'.$proyecto['date_end'].'</td>';
                        echo '<td><a href="perfil-publico.php?customer_id='.$proyecto['user_id'].'">'.$nombreCliente.'</a></td>';
                        ?>
                        <td><a href='nueva-puja.php?i=<?php echo $proyecto['id'];?>'><img src='img/pujar.png' title="Pujar" style='width: 30px; height: 30px; margin:0 auto; '></a>
                        </td>
                        <?php

                                         
                echo '</tr>';

            }
            
            /* foreach ($proyectos as $proyecto) {
                <tr>
                                        
                        <td>Web Empresa</td>
                        <td>23/12/2017</td>
                        <td>En Proceso</td>
                        <td>3 </td>
                        <td></td>
                   
                </tr>
            }*/

?>                               
                                    
                                                                      
                                    
                                   
                                    
                                </tbody>
                            </table>


</div>
</body>
<?php include('footer.php'); ?>
</html>