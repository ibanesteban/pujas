<?php include('header.php');?>

		
		
        </form>
		<div class="inicio-sesion">
			<h1 class='titulos'>Inicia Sesión</h1>
			<p class="texto centrar-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>sed do eiusmod tempor incididunt ut labore <br>et dolore magna aliqua.</p>
			<br/>

			<form action="validacion.php" method="POST">
			
		
				<p class='texto'>
					<input class="login " type ="text" name="email" placeholder="Correo eletrónico"/><br/>
					<input class="login " type="password" name="pass" placeholder="Contraseña" /><br/>
					<a href="recuperar-contrasena.php">He olvidado mi contraseña</a><br/><br><br>
					<input class="boton login" type="submit" value="Iniciar Sesión" />					
					<input type="hidden" name="login" value="1" />
				</p>		
			</form>

		</div>
		<div class="">
			<?php if ($_GET)
        {
        	include 'funciones/funcionesPHP.php';
        	if(isset($_GET['n'])){        	
        		activarUsuario($_GET['n']);
        	}

        	if(isset($_GET['x']))
        	{
        		$msg=noLogin($_GET['x']);
	        			echo $msg; 
	        }

        	
        }
        ?>
		
		</div>
<?php include('footer.php');?>		
	

