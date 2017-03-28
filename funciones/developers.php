<?php    

 include 'conectarBD.php';



// Creamos la clase Users con sus respectivos métodos
       
class Developer{
    
    public $id;
    public $address;
    public $website;
    public $cif;
    public $manager_name;
    public $manager_surname;
    public $manager_phone;
    public $user_id;
    const TABLA = 'developers';
    
    
//Función para almacenar una nueva empresa desarrolladora en la base de datos
                
    function __construct(){
        
    }
    
 //Función para registrar los datos de la empresa desarrolladora en la base de datos(solo cif, web y user_id)
    public function registrar($atributos){
        global $mysqli;
        $this->cif= $atributos['cif'];
        $this->web= $atributos['web'];

        //con esta consulta se obtiene el id del ultimo usuario creado para despues poder almacenarlo en el user_id
        $consulta='SELECT max(`id`) FROM `users`';
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        $ultimo_id= $registros->fetch_array();
        $this->user_id= $ultimo_id[0];
        
        
        //ESTA ES LA CONSULTA PRIMARIA EN LA QUE INSERTAMOS LOS VALORES EN LA TABLA CLIENTS,
        $consulta='INSERT INTO `developers`(`cif`, `website`, `user_id`) VALUES ("'.$atributos["cif"].'", "'.$atributos["web"].'", "'.$ultimo_id[0].'")';
        echo ' Te acabas de registrar en la base de datos de desarrolladores';
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));

    }
    
    function __destruct(){
        

    }
}
?>