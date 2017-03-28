<!-- CREAMOS HEADER -->
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Mamayak</title>

      <!-- LINK´S -->
      <link type="text/css" rel="stylesheet" href="css/reset.css" />
      <link type="text/css" rel="stylesheet" href="css/estilos.css" />
      <link type="text/css" rel="stylesheet" href="css/file-input.css" />
      
      <link rel="icon" href="favicon.ico" type="image/x-icon" />
      
      <!-- ENLACES PARA HACER FUNCIONAR LA FUNCION JS DE LA FECHA-->
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
      
      <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
      <script src="jquery.ui.datepicker-es.js"></script>
    
    <script type="text/javascript"  src="js/javascript.js"></script>

      
      
      <!-- FUENTES -->
       <link href="https://fonts.googleapis.com/css?family=Baloo|Lato|Montserrat|Open+Sans" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

</head>

<body>
  
  <div id="wrap">
  <?php
    $nombre=$_SESSION['nombre'];
  ?>
  <div class="header limpiar" >
    <div class="logotipo"><img src="img/logo.png" alt="logo" class="iconologo"><p class="logo" >Mamayak</p></div>
    <ul class="menuvertical">
    <div class="dropdown">
      <button class="dropbtnempresa"><?php echo $nombre; ?></button>
      <div class="dropdown-content ">
        <a href="miperfil.php">Mi Perfil</a>
        <a href="mispujas.php" >Mis Pujas</a>
        <a href="proyectos.php" >Proyectos</a>
        <a href="logout.php">Cerrar sesión</a>
      </div>
    </div>
    </ul>
  </div>
<div class="contenedor">
