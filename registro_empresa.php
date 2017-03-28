<?php include('header.php');?>

	<h1 id="titulo" class="titulos" style="color:#bb83d2;"> Regístrate como empresa </h1> 
    <div id="panel" class="texto">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
    </div>  
    <div id="contenido">
        <form id="registro-empresa" action="validacion.php" method="post">
            <input type="hidden" name="registro-empresa" value="1"> 
                <p><input type="text" name="name2" placeholder="Nombre" required/></p>
                <p><input type="text" name="cif" placeholder="CIF" ></p>
                <p><input type="text" name="web" placeholder="Web" /> </p>
		        <p><input type="email" name="email" placeholder="Email" required/></p>
		        <p><input type="password" name="password" placeholder="Password" required/></p>
                <p><a href="registro.php">Soy un cliente</a></p> <!--Enlazar a formulario de registro_cliente-->
		        <p><input type="submit" name="registrar" value="Registrar" class="boton-empresa" /></p>
              
        </form>
    </div>
      <?php if ($_GET)
                {
                    if($_GET['m']==1)
                    {
                        echo "<div class='msg-error'>Ya hay un usuario registrado con ese email</div>";
                    }
                    else
                    {
                        echo "<div class='msg-error'>Introduce una contraseña de más de 6 carácteres</div>";
                    }
                }
    ?>
    
<?php include('footer.php');?>      