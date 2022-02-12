<?php
  session_start();
  if(isset($_COOKIE['sesion'])){
    session_decode($_COOKIE['sesion']);
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Pastelería Ángel García López</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menuDesplegable.css">
    <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">


    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
     <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="assets/js/app.js"></script>
      <script type="text/javascript" src="assets/js/appIndex.js"></script>
</head>
<body>
  <!-- Menu desplegable -->
  <?php
      if(isset($_SESSION['id']) == "" ){
        echo "<div id='rmenu' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
          <a class='dropdown-item' href='index.php'>Inicio</a>
          <a class='dropdown-item' href='php/productos.php'>Productos</a>
          <a class='dropdown-item' href='php/trabajos.php'>Trabajos</a>
          <a class='dropdown-item' href='php/contacto.php'>Contacto</a>
        </div>";
      }else if($_SESSION['id'] == 0){
        echo "<div id='rmenu' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
            <a class='dropdown-item' href='index.php'>Inicio</a>
            <a class='dropdown-item' href='php/noticias.php'>Noticias</a>
            <a class='dropdown-item' href='php/clientes.php'>Clientes</a>
            <a class='dropdown-item' href='php/productos.php'>Productos</a>
            <a class='dropdown-item' href='php/trabajos.php'>Trabajos</a>
            <a class='dropdown-item' href='php/encargos.php'>Encargos</a>
            <a class='dropdown-item' href='php/contacto.php'>Contacto</a>
          </div>";
      }else{
        echo "<div id='rmenu' class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
            <a class='dropdown-item' href='index.php'>Inicio</a>
            <a class='dropdown-item' href='php/misDatosPersonales.php'>Datos Personales</a>
            <a class='dropdown-item' href='php/trabajos.php'>Trabajos</a>
            <a class='dropdown-item' href='php/encargos.php'>Encargos</a>
            <a class='dropdown-item' href='php/trabajosDisponibles.php'>Trabajos Disponibles</a>
            <a class='dropdown-item' href='php/contacto.php'>Contacto</a>
          </div>";
      }
  ?>
  
  
  <?php
    require_once("funciones/funciones.php");
    $ruta = "./";
    $archivos = "php/";
    barra($ruta,$archivos);
    $conexion = conectarServidor();
    $consulta = "SELECT imagen FROM trabajos";
    $resul = mysqli_query($conexion,$consulta);
    while ($imagenes = mysqli_fetch_array($resul,MYSQLI_ASSOC)) {
      $misImagenes[] = imagenes($imagenes['imagen']);
    }
    
    $rango = sizeof($misImagenes) - 1;
  
    $miImagen = rand(0,$rango);

    //echo "<img class='col-sm-12' src='".$misImagenes[$miImagen]."' alt='Responsive image'>";

    $primera = 0;
    $segunda = 0;
    $tercera = 0;

    if($rango == $miImagen){
      $primera = $miImagen;
      $segunda = $miImagen - 1;
      $tercera = 0;
    }elseif ($miImagen == 0) {
      $primera = $miImagen;
      $segunda = $miImagen + 1;
      $tercera = sizeof($misImagenes) - 1;
    }
    else{
      $primera = $miImagen - 1;
      $segunda = $miImagen;
      $tercera = $miImagen + 1;
    }
    
    //Slider 
echo "<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
    <div class='carousel-inner alturaCarrusell'>
        <div class='carousel-item active'>
          <img src='".$misImagenes[$primera]."' class='d-block w-100' alt='Responsive image'>
        </div>
        <div class='carousel-item'>
          <img src='".$misImagenes[$segunda]."' class='d-block w-100' alt='Responsive image'>
        </div>
        <div class='carousel-item'>
          <img src='".$misImagenes[$tercera]."' class='d-block w-100' alt='Responsive image'>
        </div>
    </div>
    </div>";
   
    $dia = date("d");
    $mes = date("m");
    $anio = date("Y");

    $fechaActual = $anio."-".$mes."-".$dia;
      $consulta = "SELECT * FROM noticias where fecha < '$fechaActual' order by fecha desc limit 3";
      $res = mysqli_query($conexion,$consulta);
      echo"<h2 class='titulo'>Últimas Noticias</h2>";
      echo "<div class='container'><table class='table table-dark'>";
       echo "<thead>
            <tr>
                <td scope='col'>Foto</td>
                <td scope='col'>Fecha</td>
                <td scope='col'>Titulo</td>
                <td scope='col'>Visualizar Completa</td>
            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        echo "<tr><td><img class='img-fluid imagen' src='".imagenes($fila['imagen'])."' alt='Responsive image'></td><td>".fechaEspañol($fila['fecha'])."</td><td>".$fila['titular']."</td><td><a role='button' class='btn' href='php/noticiasCompletas.php?Fecha=$fila[fecha]&Titular=$fila[titular]&Imagen=$fila[imagen]&Contenido=$fila[contenido]'>Ver más</a></td></tr>";
      }
      echo "</table></div>";

     
     
      mysqli_close($conexion);
      footer();
  ?>	
</body>
</html>