<?php    

 include 'conectarBD.php';




// Creamos la clase Users con sus respectivos métodos
       
class User{
    
    public $id;
    public $name;
    public $email;
    private $phone;
    public $password;
    public $remember_token;
    public $profile_photo;
    private $city;
    private $date_creation;
    private $date_access;
    private $activated;
    private $salt;
    const TABLA = 'users';
    
    
//Función para almacenar un nuevo usuario en la base de datos
                
    function __construct(){
        
    }
    

 //Función para registrar los datos del usuario en la base de datos
    public function registrar($atributos){
        global $mysqli;
        $this->type= $atributos['type'];
        $this->name = $atributos['name'];
        $this->email = $atributos['email'];
        $this->password= $atributos['password'];
        $this->remember_token= $atributos['remember_token'];
        $this->date_creation= $atributos['date_creation'];
        $hash=hash('md5', $atributos['email']);
    //ESTA ES LA CONSULTA PRIMARIA EN LA QUE INSERTAMOS LOS VALORES EN LA TABLA USERS,
        $consulta='INSERT INTO `users`(`name`,`type`, `email`, `password`, `remember_token`, `date_creation`, `salt`,`profile_photo`) VALUES ("'.$atributos["name"].'", "'.$atributos["type"].'"  , "'.$atributos["email"].'" , "'.$atributos["password"].'", "'.$atributos["remember_token"].'", "'.$atributos["date_creation"].'", "'.$hash.'","profile.png")';
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
            //parte donde se envia un correo al usuario registrado;
        mandarCorreoActivacion($atributos['email'], $hash);
        }

//Función para comprobar si ya hay un usuario registrado en la base de datos con ese email
    public function comprobarCorreo($email){
        include 'conectarBD.php';

        $consulta= "SELECT * FROM `users` WHERE email ='".$email."'";
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        $n= $registros->num_rows;
        if($n==0){
            //no hay ningun usuario registrado con ese email
            return 0;
        }
        elseif($n==1){
            //ya hay un usuario registrado con ese email
            return 1;
        }
    }

//Función para comprobar si ya hay un usuario registrado en la base de datos con ese email
    public function comprobarCodigo($remember_token){
        include 'conectarBD.php';

        $consulta= "SELECT * FROM `users` WHERE remember_token ='".$remember_token."'";
        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        $n= $registros->num_rows;
        if($n==0){
            //no hay ningun usuario registrado con ese email
            return 0;
        }
        elseif($n==1){
            //ya hay un usuario registrado con ese email
            return 1;
        }
    }
//modificar password     
    function modificarPassword($atributos){
        include 'conectarBD.php';
        $consulta= "UPDATE `users` SET `password`='".$atributos['new_password']."',`remember_token`='".$atributos['remember_token']."' WHERE email='".$atributos['email']."'";


        $registros = $mysqli -> query($consulta)
        or die ($mysqli‐>error. " en la línea ".(__LINE__‐1));
        
    }



    function __destruct(){
        

    }
}
?>