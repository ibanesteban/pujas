<?php include('header.php');

if (isset($_GET['m']))

{



?>

	<h2 class="titulos">Contacta con nosotros</h2>
	<br><br>
	<p class="texto epigrafe-contacto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
	<br>
	<div class="estilo-contacto ">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.547349138578!2d-2.986182384513586!3d43.30280017913483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4e5a648234a707%3A0x189e0dd3cb6f4888!2sBIC+Bizkaia+Ezkerraldea!5e0!3m2!1ses!2ses!4v1489045869239" width="450" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<div class="estilo-contacto2 ">

		<form  action="enviarmail.php" method="POST">
			<p class="texto">
				<input type="text" name="nombre" placeholder="Nombre y Apellidos"/><br/>
				<input type="text" name="email" placeholder="Email"/><br/>
				<input type="text" name="asunto" placeholder="Asunto" /><br/>
				<textarea name="dudas" placeholder="Dudas o Sugerencias"></textarea></br>
				<input type="submit" value="Enviar" class="boton"/>	
			</p>
			
		</form>
	<div id="mensaje" class="msg-ok" style="width:65%;float:right;font-size:1.1em;"><p>Gracias, por contactar con nosotros.</p></div>
	</div>

<?php
}
else{
?>
		<h2 class="titulos">Contacta con nosotros</h2>
	<br><br>
	<p class="texto epigrafe-contacto">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
	<br>
	<div class="estilo-contacto ">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.547349138578!2d-2.986182384513586!3d43.30280017913483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4e5a648234a707%3A0x189e0dd3cb6f4888!2sBIC+Bizkaia+Ezkerraldea!5e0!3m2!1ses!2ses!4v1489045869239" width="450" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<div class="estilo-contacto2 ">

		<form  action="enviarmail.php" method="POST">
			<p class="texto">
				<input type="text" name="nombre" placeholder="Nombre y Apellidos"/><br/>
				<input type="text" name="email" placeholder="Email"/><br/>
				<input type="text" name="asunto" placeholder="Asunto" /><br/>
				<textarea name="dudas" placeholder="Dudas o Sugerencias"></textarea></br>
				<input type="submit" value="Enviar" class="boton"/>	
			</p>
			
		</form>
		<br><br>
	</div>

<?php	
}			

 include('footer.php');?>		