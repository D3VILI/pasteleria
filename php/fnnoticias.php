<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Noticias</title>
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
		$conexion = conectarServidor();
		$ruta = "../";
		$archivos = "./";
		barra($ruta,$archivos);
		
		$idIncremental = idActual("noticias");

		echo "<div class='container arriba'><form action='fnnoticias.php' method='post' enctype='multipart/form-data'>
		<div class='form-row'>
			<div class='form-group col-md-4'>
				<label for='$idIncremental'>ID</label>
				<input type='text' class='form-control' id='$idIncremental' value='$idIncremental' disabled>
			</div>
			<div class='form-group col-md-4'>
			 <label for='titula'>Titular*</label>
			 <input type='text' class='form-control' id='titula' name='titular' required>
			</div>
			<div class='form-group col-md-4'>
				<label for='fech'>Fecha*</label>
				<input type='date' class='form-control' id='fech' name='fecha' required>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group col-md-6'>
				<label for='contenid'>Contenido*</label>
			 	<textarea name='contenido' class='form-control' id='contenid' placeholder='Escribe...' required></textarea>
			</div>
			<div class='form-group col-md-6'>
				<label for='imag'>Seleccionar una Imagen*</label>
				<input class='form-control' type='file' id='imag' name='imagen' required>
			</div>
		</div>
		<input class='btn-primary' type='submit' name='enviar'>
		</form></div>";
		
		if (isset($_POST['enviar'])) {
			if($_POST['titular'] != ""  && $_POST['contenido'] != ""  && $_POST['fecha'] != ""  && $_FILES['imagen']['size'] > 0){
				$titular = $_POST['titular'];
				$contenido = $_POST['contenido'];
				$fecha = $_POST['fecha'];
				$nomb_tempo = $_FILES['imagen']['tmp_name'];
				$nombre_imagen = $_FILES['imagen']['name'];

				if(!file_exists("../assets/images")){
					mkdir("../assets/images");
				}

				$ruta = "../assets/images/$idIncremental$nombre_imagen";
				move_uploaded_file($nomb_tempo,$ruta);

				$insertar = "INSERT INTO noticias (id,titular,contenido,imagen,fecha) VALUES (null,'$titular','$contenido','$ruta','$fecha')";
				mysqli_query($conexion,$insertar);
		 		echo "Se insertó correctamente,sera redirigido inmediatamente";
		 		header("refresh:1;url=noticias.php");
			}else{
				echo "Ninguno de los campos con * puede estar vacío";
			}
		}
		mysqli_close($conexion);
		footer();
	?>
	
</body>
</html>