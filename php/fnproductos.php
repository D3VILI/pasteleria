<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Productos</title>
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

		$idIncremental = idActual("productos");

		echo "<form action='fnproductos.php' method='post' enctype='multipart/form-data'>
		Nombre:
		<br>
		<input type='text' name='nomb' required>
		<br>
		Descripción:
		<br>
		 <textarea name='descripcion' placeholder='Escribe...' required></textarea>
		<br>
		Precio:
		<br>
		<input type='text' name='precio'>
		<br>
		Seleccionar una Imagen:
		<br>
		<input type='file' name='imagen' required>
		<br><br>
		<input type='submit' name='enviar'>
		</form>";

		if (isset($_POST['enviar']) && $_POST['nomb'] != "") {
			$nombre = $_POST['nomb'];
			$descripcion = $_POST['descripcion'];
			$precio = $_POST['precio'];
			$nomb_tempo = $_FILES['imagen']['tmp_name'];
			$nombre_imagen = $_FILES['imagen']['name'];

			if(!file_exists("../assets/images")){
				mkdir("../assets/images");
			}

			$ruta = "../assets/images/$idIncremental$nombre_imagen";
			move_uploaded_file($nomb_tempo,$ruta);

			$insertar = "INSERT INTO productos (id,nombre,descripción,precio,imagen) VALUES (null,'$nombre','$descripcion',$precio,'$ruta')";
			mysqli_query($conexion,$insertar);
	 		echo "Se insertó correctamente";
	 		mysqli_close($conexion);
		}

	?>
</body>
</html>