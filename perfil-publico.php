<?php
include("funciones/funcionesPHP.php");
sesion();

    
  $id=$_GET['customer_id'];
           
    

      include "conectarBD.php";
 
      $clientesi = esCliente($id);
      
      if ($clientesi)
      {
         $reg=obtenerCliente($id);
        
      }

        else 
        {
         
          $reg=obtenerEmpresa($id);
        }
             


    if ($clientesi)
    {

?>

 
    <! perfil cliente ->

<div>
<form action="validacion.php"   method="POST" enctype="multipart/form-data" class="limpiar" >

    <h1 class="titulos">Perfil de <?php echo$reg['name']; ?></h1>

    <div class="contenedor-miperfil2 limpiar">
      <img src="img/<?php echo $reg['profile_photo']; ?>">
    </div>

    <div class="contenedor-miperfil1 limpiar">
      <div class="columna1">
        <label class="texto">Nombre: </label><input class="miperfil" type="text" name="name" placeholder="" value="<?php echo$reg['name']; ?>" readonly></input>
         <br><br>
       <label class="texto">Email: </label><input class="miperfil" type="text" name="email" placeholder="" value="<?php echo $reg['email']; ?>" readonly></input>
       <br><br>
        <label class="texto">Teléfono: </label><input class="miperfil" type="text" name="phone" placeholder="telefono" value="<?php echo $reg['phone']; ?> " readonly></input>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="profile_photo" value="<?php echo $reg['profile_photo']; ?>">
                    
      </div>
       <!--<labell>Password: </labell><input class="miperfil" type="password" name="password" placeholder="password" value="<?php echo $reg['password']; ?>"></input>
      <labell>Repetir Password: </labell><input class="miperfil" type="password" name="password2" placeholder="repite password" value="<?php echo $reg['password']; ?> " ></input>-->
                    
      <div class="columna2">
        <label class="texto">Apellidos: </label><input class="miperfil" type="text" name="surname" placeholder="apellidos" value="<?php echo $reg['surname']; ?>" readonly></input>
        <br><br>
        <label class="texto">Ciudad: </label><input class="miperfil" type="text" name="city" placeholder="" value="<?php echo $reg['city']; ?>"readonly></input>
        <br><br>
        <label class="texto">Linkedin: </label><input class="miperfil" type="text" name="linkedin" placeholder="" value="<?php echo $reg['linkedin']; ?>" readonly></input>
      </div>
    </div>            
    
    <br>  
           
    <div class="contenedor-miperfil3" >
      <br>
      <h2 class="titulos2">Datos de mi empresa</h2>
      <br>
      
      <div class="columna3">
        <label class="texto2">Nombre: </label><br><input type="text"  class="miperfil" name="company_name" value="<?php echo $reg['company_name']; ?>" readonly></input>
        <br>
        <label class="texto2">Ciudad: </label><br>
        <input type="text" class="miperfil" name="company_location" value="<?php echo $reg['company_location']; ?>" readonly></input>

      </div>
      
      <div class="columna3-2" >
        <label class="texto2">Página Web: </label><input type="text" class="miperfil" name="company_website" value="<?php echo $reg['company_website']; ?>" readonly></input>
        <label class="texto2">Dirección: </label><input type="text" class="miperfil" name="company_address" value="<?php echo $reg['company_address']; ?>" readonly></input>
      </div>
      <br>
     
  
    </div>

   
</form>
</div>
<?php include('footer.php'); ?>
<?php 
}

else 

{ 

?>

 
    <! perfil empresa ->
    
    <br>
    <br>
    
    <form action="validacion.php" method="POST" enctype="multipart/form-data" >
      <h1 class="titulos">Perfil de <?php echo$reg['name']; ?></h1>
      <div class="contenedor-miperfil2 limpiar">
        <img src="img/<?php echo $reg['profile_photo']; ?>">
      </div>
      <div class="contenedor-miperfil1 limpiar">
        <div class="columna1">
           <label class="texto">Nombre Empresa: </label><input class="miperfil" type="text" name="name"  value="<?php echo $reg['name']; ?>" readonly></input>
           <label class="texto">Email: </label><input class="miperfil" type="text" name="email"  value="<?php echo $reg['email']; ?>" readonly></input>
           <label class="texto">Web Site: </label><input class="miperfil" type="text" name="website"  value="<?php echo $reg['website']; ?>" readonly></input>
           <input type="hidden" name="id" value="<?php echo $id; ?>">
           <input type="hidden" name="profile_photo" value="<?php echo $reg['profile_photo']; ?>">

        </div>
      <div class="columna2">          
        <label class="texto">CIF: </label><input class="miperfil" type="text" name="cif"  value="<?php echo $reg['cif']; ?>" readonly></input>
        <label class="texto">Teléfono: </label><input class="miperfil" type="text" name="phone" value="<?php echo $reg['phone']; ?> " readonly></input>
        <label class="texto">Dirección: </label><input class="miperfil" type="text" name="address" value="<?php echo $reg['address']; ?>" readonly></input>
            <br>
          </div>
        </div>
    <!-- <input type="password" name="password" placeholder="password"  value="<?php echo $reg['password']; ?>"></input>
    <input type="password" name="password2" placeholder="repite password" value="<?php echo $reg['password']; ?> " ></input>
                <br>
    
    
        <label class="texto2">Ciudad: </label><input type="text" name="city" placeholder="ciudad" value="<?php echo $reg['city']; ?>"></input>-->
     
    <div class="contenedor-miperfil4">
        <br>
        <h2 class="titulos2">Datos del manager</h2>
        <br>
       
       <div class="label-informanager">
        <label class="texto2" for="manager_name">Nombre : </label><label class="texto2" for="manager_surname" >Apellidos : </label><label class="texto2" for="manager_phone">Teléfono : </label>
      </div>
      <div class="input-infomanager">
        <input class="miperfil2" type="text" id="manager_name" name="manager_name" value="<?php echo $reg['manager_name']; ?>" readonly></input>
       <input class="miperfil2" type="text" name="manager_surname" id="manager_surname"  value="<?php echo $reg['manager_surname']; ?>" readonly></input>
        <input class="miperfil2" type="text" name="manager_phone" id="manager_phone" value="<?php echo $reg['manager_phone']; ?>" readonly></input>
      </div>  
               
         <br>
     </div>  
        
        </form>

    
<?php include('footer.php');     
}

?>


