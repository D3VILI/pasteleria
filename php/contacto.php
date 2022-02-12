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
	<title>Contacto</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/estilos.css">

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
     <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../assets/js/app.js"></script>

</head>
<body>
 <?php 
  require_once("../funciones/funciones.php");
    $ruta="../";
    $archivos="./";
    barra($ruta,$archivos);


   echo "<div class='container-fluid arriba'>
  <h2 class='text-center'>Contacto</h2>
  <div class='row'>
    <div class='offset-md-2 col-md-4' id='mapa'>
    <iframe src='https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d25427.83626015466!2d-3.611650499999999!3d37.1888381!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1571661654653!5m2!1ses!2ses' width='600' height='450' frameborder='0' style='border:0;' allowfullscreen=''></iframe>
    </div>
    <div class='col-md-4' id='formulario'>
      <form>
    <div class='col-md-4 mb-3'>
      <label for='nombre'>Nombre Completo</label>
      <input type='text' class='form-control' id='nombre' placeholder='Nombre Completo' required>
    </div>
    <div class='col-md-4 mb-3'>
      <label for='email'>Email</label>
      <input type='email' class='form-control' id='email' placeholder='Email' required>
    </div>
      <div class='col-md-4 mb-3'>
      <input type='asunto' class='form-control' id='asunto' placeholder='asunto' required>
    </div>
    <textarea  class='form-control' id='mensaje' placeholder='Escribe...' required></textarea>
  <div class='form-group'>
    <div class='form-check'>
      <input class='form-check-input' type='checkbox' value='' id='terminos' required>
      <label class='form-check-label' for='terminos'>
       Acepto los terminos y condiciones
      </label>
    </div>
  </div>
  <button class='btn btn-primary' type='submit'>Enviar</button>
</form>
    </div>
  </div>
</div>";

footer();

 ?>
</body>
</html>