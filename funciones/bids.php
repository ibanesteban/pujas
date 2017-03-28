<?php    

 include 'conectarBD.php';



// Creamos la clase Bids con sus respectivos métodos
       
class Bid{
    
    public $id;
    public $date_end;
    public $status;
    public $date_creation;
    public $budget;
    public $vendor_id;
    public $projects_id;
    const TABLA = 'bids';
    
    
//Función para almacenar una nueva puja en la base de datos
                
    function __construct(){
        
    }
    
 //Función para registrar los datos de la puja en la base de datos
    public function crear_puja($atributos){
        global $mysqli;
        $this->date_end= $atributos['date_end'];
        $this->status= 0;
        $this->date_creation= $atributos['date_creation'];
        $this->budget= $atributos['budget'];
        $this->vendor_id= $atributos['vendor_id'];
        $this->projects_id= $atributos['projects_id'];
    //ESTA ES LA CONSULTA PRIMARIA CON LA BASE DE DATOS,
        $consulta='INSERT INTO `bids`(`date_end`,`date_creation`,`budget`,`vendor_id`,`projects_id`) VALUES ("'.$atributos["date_end"].'", "'.$atributos["date_creation"].'", "'.$atributos["budget"].'", "'.$atributos["vendor_id"].'", "'.$atributos["project_id"].'")';
        
        echo ' La puja se ha realizado con exito ';
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));

    }
    
    function modificarStatus($accion, $idPuja){
        include 'conectarBD.php';
        if($accion=='aceptar'){
            $consulta = "SELECT `status` FROM `bids` WHERE id= $idPuja" ;
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            $reg=$registros->fetch_assoc();
            $estado=$reg['status'];
            
            if($estado==0){
                $this->status= 1;
                $consulta = "UPDATE `bids` SET `status`=1 WHERE id= $idPuja" ;
                $registros = $mysqli -> query($consulta)
                or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            }
            elseif($estado==1){
            $this->status= 0;
            $consulta = "UPDATE `bids` SET `status`=0 WHERE id= $idPuja" ;
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            }


        }
        elseif($accion=='rechazar'){
            $this->status= 2;
            $consulta = "UPDATE `bids` SET `status`=2 WHERE id= $idPuja" ;
            $registros = $mysqli -> query($consulta)
            or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        }
        
    }
    function __destruct(){
        

    }
}
?>