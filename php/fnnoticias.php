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
		require_once("../funciones/funciones.php");
		$conexion = conectarServidor();
		$ruta = "../";
		$archivos = "./";
		barra($ruta,$archivos);
		
		$idIncremental = idActual("noticias");

		echo "<form action='fnnoticias.php' method='post' enctype='multipart/form-data'>
		Titular:
		<br>
		<input type='text' name='titular' required>
		<br>
		Contenido:
		<br>
		 <textarea name='contenido' placeholder='Escribe...' required></textarea>
		<br>
		Fecha:
		<br>
		<input type='date' name='fecha'>
		<br>
		Seleccionar una Imagen:
		<br>
		<input type='file' name='imagen' required>
		<br><br>
		<input type='submit' name='enviar'>
		</form>";
		
		if (isset($_POST['enviar']) && $_POST['titular'] != "") {
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
	 		echo "Se insertó correctamente";
	 		mysqli_close($conexion);
		}

	?>
	
</body>
</html>