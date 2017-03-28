<?php include('header.php');?>

		
		
        </form>
		<div class="inicio-sesion">
			<h1 class='titulos'>Recuperar contraseña</h1>
			<p class="texto centrar-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>sed do eiusmod tempor incididunt ut labore <br>et dolore magna aliqua.</p>
			<br/>

			<form action="validacion.php" method="POST">		
				<p class='texto'>
					<input class="login " type="text" name="email" placeholder="Correo eletrónico"/><br/>
					<input class="boton login" type="submit" value="RECUPERAR CONTRASEÑA" />
					<input type="hidden" name="recuperar" value="1" />
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