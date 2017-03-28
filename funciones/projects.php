<?php    

 include('conectarBD.php');

// Creamos la clase Users con sus respectivos métodos
       
class Project{
    
    public $id;
    public $title;
    public $date_end;
    public $observations;
    public $status;
    public $date_creation;
    public $customer;
    const TABLA = 'projects';
    
    
//Función para almacenar un nuevo proyecto en la base de datos
                
    function __construct(){
        
    }
    
 
    public function registrar($atributos){
        

        global $mysqli;
        $this->title = $atributos['title'];
        $this->date_end = $atributos['fecha-fin'];
        $this->observations= $atributos['textonuevoproyecto'];
        $estado=0; //Por defecto ponemos 0
        $this->status = $estado;
        $this->customer=$atributos['idcliente'];

        

        $fechafin = convertirFecha_SpanishToEnglish($_POST["fecha-fin"]);
        $fechaactual=fechahoy();

        $this->date_creation=$fechaactual;

        

        //CONSULTA PARA INSERTAR EN LA BASE DE DATOS 

        $consulta='INSERT INTO `projects`(`id`, `title`, `date_end`, `observations`, `status`, `date_creation`, `customer_id`) VALUES ("","'.$atributos["title"].'", "'.$fechafin.'"  , "'.$atributos["textonuevoproyecto"].'" , "'.$estado.'", "'.$fechaactual.'",'.$atributos['idcliente'].')';

       /* $consulta='INSERT INTO `projects`(`id`,`title`,`date_end`, `observations`, `status`, `date_creation`,`customer_id`) VALUES ("'.$atributos["title"].'", "'.$fechafin.'"  , "'.$atributos["textonuevoproyecto"].'" , "'.'0'.'","'.$fechaactual.'","'.'2'.'")';*/
        
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));


    }
    
    function modificarStatus($accion, $idProyecto){
        include 'conectarBD.php';
        if($accion=='aceptar'){
            $consulta = "SELECT `status` FROM `projects` WHERE id= $idProyecto" ;
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            $reg=$registros->fetch_assoc();
            $estado=$reg['status'];
            //pasar estado de proyecto a pactado
            if($estado==0){
                $this->status= 1;
                $consulta = "UPDATE `projects` SET `status`=1 WHERE id= $idProyecto" ;
                echo $consulta;
                $registros = $mysqli -> query($consulta)
                or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            }
            //pasar estado de proyecto a en proceso
            elseif($estado==1){
                $this->status= 0;
                $consulta = "UPDATE `projects` SET `status`=0 WHERE id= $idProyecto" ;
                echo $consulta;
                $registros = $mysqli -> query($consulta)
                or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            }


        }
        //pasar estado de proyecto a cerrado
        if($accion=='cerrar'){
            $this->status= 2;
            $consulta = "UPDATE `projects` SET `status`=2 WHERE id= $idProyecto" ;
            echo $consulta;
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));


        }
        
    }
    function __destruct(){
        

    }
}
?>