<?php include('header.php');?>

		
		
        </form>
		<div class="inicio-sesion">
			<h1 class='titulos'>Activar Contraseña</h1>
			<p class="texto centrar-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>sed do eiusmod tempor incididunt ut labore <br>et dolore magna aliqua.</p>
			<br/>

			<form action="validacion.php" method="POST">
			
		
				<p class='texto'>
					<input class="login " type ="email" name="email" placeholder="Correo electrónico"/><br/>
					<input class="login " type ="text" name="codigo" placeholder="Código recibido"/><br/>
					<input class="login " type="password" name="contra" placeholder="Nueva contraseña" /><br/>
					<input class="boton login" type="submit" value="Cambiar" />
					<input type="hidden" name="cambiar-contra" value="1" />
				</p>		
			</form>
		</div>
		<div class="">
			<?php if ($_GET)
        {
        	include 'funciones/funcionesPHP.php';
        	
        	if(isset($_GET['x']))
        	{
        		$msg=noLogin($_GET['x']);
	        			echo $msg; 
	        }

        	
        }
        ?>
		</div>
		
<?php include('footer.php');?>