<?php
	include 'funciones/funcionesPHP.php';

    // Si alguien logueado vuelve al inicio, destruimos la sesión
    // para que cargue el menú antiguo
    session_start();
    session_destroy();

	sesion();
?>
<style type="text/css">
          body {
            background-image: url("img/slider03.jpg");
            background-size: 100% 100%;
            background-repeat: no-repeat;
          }
        </style>

	<div id="home" >
	<h1 id="titulo" class="titulos" style="color:white; font-size:3em;">Bienvenidos a Mamayak</h1>

	<p class="titulos" style="font-size:1.5em; width:50%;margin:0 auto;margin-bottom:2%;padding: 30px 80px; background-color: rgba(200,255,220,0.7);">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
	


	<input class="boton-index" type="submit" name="registrate-home" value="Regístrate" onClick="window.location.href='registro.php'"
			style="width:25%; height:3em; font-size:1.8em;">
	</div>



<?php	
	require("footer.php");
?>


