<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar Producto</title>
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

		$id = $_GET['id'];
		$nombre = $_GET['Nombre'];
		$descripcion = $_GET['Descripción'];
		$precio = $_GET['Precio'];

		echo "<form action='fmproductos.php?id=$id&Nombre=$nombre&Descripción=$descripcion&Precio=$precio' method='post' enctype=multipart/form-data>
		Nombre:
		<br>
		<input type='text' name='nomb' placeholder='$nombre' required>
		<br>
		Descripción:
		<br>
		 <textarea name='descripcion' placeholder='$descripcion' required></textarea>
		<br>
		Precio:
		<br>
		<input type='text' placeholder='$precio' name='precio'>
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

			$ruta = "../assets/images/$nombre_imagen";
			move_uploaded_file($nomb_tempo,$ruta);


			$actualizar = "UPDATE productos SET nombre = '$nombre',descripción = '$descripcion',precio = $precio,imagen = '$ruta'  where id = $id";
			mysqli_query($conexion,$actualizar);
	 		echo "Se modificó correctamente, será redirigido inmediatamente";
	 		header("refresh:1;url=productos.php");
	 		mysqli_close($conexion);
		}

	?>
</body>
</html>