<script src="js/custom-file-input.js"></script>

<?php
include("funciones/funcionesPHP.php");
sesion();    
$id=$_SESSION['id']; 
include "conectarBD.php";
$clientesi = esCliente($id);  
if ($clientesi)
{
  $reg=obtenerCliente($id);
?>
    <! perfil cliente ->



<style>
        
</style>    

<div>
  <form action="validacion.php"   method="POST" enctype="multipart/form-data" class="limpiar" >
    <h1 class="titulos">Perfil de <?php echo$reg['name']; ?></h1>
    <div class="contenedor-miperfil2 limpiar">
      <img src="img/<?php echo $reg['profile_photo']; ?>">
      <br>
     
     <input type="file" name="imagen" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} archivos seleccionados" multiple />
<label for="file-1">
<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
<span class="iborrainputfile">Seleccionar archivo</span>
</label>
    </div>

    <div class="contenedor-miperfil1 limpiar">
      <div class="columna1">
        <label class="texto">Nombre: </label><input class="miperfil" type="text" name="name" placeholder="" value="<?php echo$reg['name']; ?>">
         <br><br>
       <label class="texto">Email: </label><input class="miperfil" type="text" name="email" placeholder="" value="<?php echo $reg['email']; ?>" readonly>
       <br><br>
        <label class="texto">Teléfono: </label><input class="miperfil" type="text" name="phone" placeholder="telefono" value="<?php echo $reg['phone']; ?>" >
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="profile_photo" value="<?php echo $reg['profile_photo']; ?>">                    
      </div>
                    
      <div class="columna2">
        <label class="texto">Apellidos: </label><input class="miperfil" type="text" name="surname" placeholder="apellidos" value="<?php echo $reg['surname']; ?>">
        <br><br>
        <label class="texto">Ciudad: </label><input class="miperfil" type="text" name="city" placeholder="" value="<?php echo $reg['city']; ?>">
        <br><br>
        <label class="texto">Linkedin: </label><input class="miperfil" type="text" name="linkedin" placeholder="" value="<?php echo $reg['linkedin']; ?>">
      </div>
    </div>            
    
    <br>  
           
    <div class="contenedor-miperfil3" >
      <br>
      <h2 class="titulos2">Datos de mi empresa</h2>
      <br>
      
      <div class="columna3">
        <label class="texto2">Nombre: </label><br><input type="text"  class="miperfil" name="company_name" value="<?php echo $reg['company_name']; ?>">
        <br>
        <label class="texto2">Ciudad: </label><br>
        <input type="text" class="miperfil" name="company_location" value="<?php echo $reg['company_location']; ?>">
      </div>
      
      <div class="columna3-2" >
        <label class="texto2">Página Web: </label><input type="text" class="miperfil" name="company_website" value="<?php echo $reg['company_website']; ?>">
        <label class="texto2">Dirección: </label><input type="text" class="miperfil" name="company_address" value="<?php echo $reg['company_address']; ?>">
      </div>
      <br>
    </div>
    <br><br>
    <input  id="salto" class="boton-cliente miperfil limpiar" type="submit" name="modificar-cliente" value ="Modificar" style="margin-top: 60px;" /> 
  </form>
</div>
<?php 

        if ($_GET)
        {          
          if(isset($_GET['x']))
          {
            $msg=noLogin($_GET['x']);
                echo $msg; 
          }          
        }

include('footer.php'); 
}
else 
{ 
  $reg=obtenerEmpresa($id);
?> 
    <! perfil empresa ->    
    <br>
    <br>    
    <form action="validacion.php" method="POST" enctype="multipart/form-data" >
      <h1 class="titulos">Perfil de <?php echo $reg['name']; ?></h1>
      <div class="contenedor-miperfil2 limpiar">
        <img src="img/<?php echo $reg['profile_photo']; ?>">
        <br>
            
        
       <input type="file" name="imagen" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} archivos seleccionados" multiple />
<label for="file-1">
<svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
<span class="iborrainputfile">Seleccionar archivo</span>
</label>
    </div>  
        
        
      </div>
      <div class="contenedor-miperfil1 limpiar">
        <div class="columna1">
           <label class="texto">Nombre Empresa: </label><input class="miperfil" type="text" name="name"  value="<?php echo $reg['name']; ?>">
           <br><br>
           <label class="texto">Email: </label><input class="miperfil" type="text" name="email"  value="<?php echo $reg['email']; ?>" readonly>
           <br><br>
           <label class="texto">Web Site: </label><input class="miperfil" type="text" name="website"  value="<?php echo $reg['website']; ?>" >
           <input type="hidden" name="id" value="<?php echo $id; ?>">
           <input type="hidden" name="profile_photo" value="<?php echo $reg['profile_photo']; ?>">
        </div>
        <div class="columna2">          
          <label class="texto">CIF: </label><input class="miperfil" type="text" name="cif"  value="<?php echo $reg['cif']; ?>">
          <br><br>
          <label class="texto">Teléfono: </label><input class="miperfil" type="text" name="phone" value="<?php echo $reg['phone']; ?>" >
          <br><br>
          <label class="texto">Dirección: </label><input class="miperfil" type="text" name="address" value="<?php echo $reg['address']; ?>">
            <br>
        </div>
      </div>
     
      <div class="contenedor-miperfil4">
        <br>
        <h2 class="titulos2">Datos del manager</h2>
        <br>
       
        <div class="label-informanager">
          <label class="texto2" for="manager_name">Nombre : </label><label class="texto2" for="manager_surname" >Apellidos : </label><label class="texto2" for="manager_phone">Teléfono : </label>
        </div>
        <div class="input-infomanager">
          <input class="miperfil2" type="text" id="manager_name" name="manager_name" value="<?php echo $reg['manager_name']; ?>">
          <input class="miperfil2" type="text" name="manager_surname" id="manager_surname"  value="<?php echo $reg['manager_surname']; ?>">
          <input class="miperfil2" type="text" name="manager_phone" id="manager_phone" value="<?php echo $reg['manager_phone']; ?>">
        </div>  
        <br>
      </div>  
        <br><br>
        <input id="salto" class="boton-empresa miperfil limpiar" type="submit"  name="modificar-empresa" value="Modificar">    
    </form>    
<?php 

        if ($_GET)
        {          
          if(isset($_GET['x']))
          {
            $msg=noLogin($_GET['x']);
                echo $msg; 
          }          
        }

include('footer.php');     
}

?>


