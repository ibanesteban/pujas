<?php    

 include 'conectarBD.php';



// Creamos la clase Users con sus respectivos métodos
       
class Client{
    
    public $id;
    public $surname;
    public $linkedin;
    public $company_name;
    public $company_website;
    public $company_location;
    public $company_address;
    public $user_id;
    const TABLA = 'clients';
    
    
//Función para almacenar un nuevo cliente en la base de datos
                
    function __construct(){
        
    }
    
 //Función para registrar los datos del cliente en la base de datos(solo surname y user_id)
    public function registrar($atributos){
        global $mysqli;
        $this->surname= $atributos['surname'];

        //con esta consulta se obtiene el id del ultimo usuario creado para despues poder almacenarlo en el user_id
        $consulta='SELECT max(`id`) FROM `users`';
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        $ultimo_id= $registros->fetch_array();
        $this->user_id= $ultimo_id[0];
        
        
        //ESTA ES LA CONSULTA PRIMARIA EN LA QUE INSERTAMOS LOS VALORES EN LA TABLA CLIENTS,
        $consulta='INSERT INTO `clients`(`surname`,`user_id`) VALUES ("'.$atributos["surname"].'", "'.$ultimo_id[0].'")';
        echo ' Te acabas de registrar en la base de datos de cliente';
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));

    }
    
    function __destruct(){
        

    }
}
?>