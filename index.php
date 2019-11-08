<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pastelería Ángel García López</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">

    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
     <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="assets/js/app.js"></script>
</head>
<body>
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

    echo "<div class='container'><img class='offset-1' src='".$misImagenes[$miImagen]."' alt='Responsive image'></div>";

    // $primera = 0;
    // $segunda = 0;
    // $tercera = 0;

//     if($rango == $miImagen){
//       $primera = $miImagen;
//       $segunda = $miImagen - 1;
//       $tercera = 0;
//     }elseif ($miImagen == 0) {
//       $primera = $miImagen;
//       $segunda = $miImagen + 1;
//       $tercera = sizeof($misImagenes) - 1;
//     }
//     else{
//       $primera = $miImagen - 1;
//       $segunda = $miImagen;
//       $tercera = $miImagen + 1;
//     }
    
//     Slider 
// echo"<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
//     <div class='carousel-inner alturaCarrusell'>
//         <div class='carousel-item active'>
//           <img src='".$misImagenes[$primera]."' class='d-block w-100' alt='Responsive image'>
//         </div>
//         <div class='carousel-item'>
//           <img src='".$misImagenes[$segunda]."' class='d-block w-100' alt='Responsive image'>
//         </div>
//         <div class='carousel-item'>
//           <img src='".$misImagenes[$tercera]."' class='d-block w-100' alt='Responsive image'>
//         </div>
//     </div>
//         <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
//           <span class='carousel-control-prev-icon' aria-hidden='true'></span>
//           <span class='sr-only'>Previous</span>
//         </a>
//         <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
//           <span class='carousel-control-next-icon' aria-hidden='true'></span>
//           <span class='sr-only'>Next</span>
//         </a>
//     </div>";
   
    $dia = date("d");
    $mes = date("m");
    $anio = date("Y");

    $fechaActual = $anio."-".$mes."-".$dia;
      $consulta = "SELECT * FROM noticias where fecha <= '$fechaActual' order by fecha desc limit 3";
      $res = mysqli_query($conexion,$consulta);
      echo "<table class='table table-dark'>";
       echo "<thead>
            <tr>
                <th scope='col'>Foto</th>
                <th scope='col'>Fecha</th>
                <th scope='col'>Titulo</th>
            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        echo "<tr><th><img src='".imagenes($fila['imagen'])."'></th><th>".$fila['fecha']."</th><th>".$fila['titular']."</th><th><a role='button' class='btn btn-success' href='php/noticiasCompletas.php?Fecha=$fila[fecha]&Titular=$fila[titular]&Imagen=$fila[imagen]&Contenido=$fila[contenido]'>Ver más</a></th></tr>";
      }
      echo "</table>";

      mysqli_close($conexion);
  ?>
 <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="colores">Contacto</h5>
                 <p class="text-lighten-4 colores">Contacta para más información: <a id="verde" href="https://www.gmail.com">aagarcia2010@gmail.com</a></p>
                 <i class="fab fa-facebook-square iconos-sociales"></i>
                 <i class="fab fa-instagram iconos-sociales"></i>
                 <i class="fab fa-twitter-square iconos-sociales"></i>
              </div>
              <div class="col l4 offset-l2 s12 colores">
                <h5 class="colores">Términos Legales</h5>
                <ul>
                  <li><a id="verde" class="text-lighten-3" href="#!">Avisos Legales</a></li>
                  <li><a id="verde" class="text-lighten-3" href="#!">Politica de Cookies</a></li>
                  <li><a id="verde" class="text-lighten-3" href="#!">Politica de Privacidad</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container colores">
            © Ángel García López
            </div>
          </div>
        </footer>
	
</body>
</html>