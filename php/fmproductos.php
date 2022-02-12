<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
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
		$conexion = conectarServidor();
		$ruta = "../";
		$archivos = "./";
		barra($ruta,$archivos);

		$id = $_GET['id'];
		$nombre = $_GET['Nombre'];
		$descripcion = $_GET['Descripción'];
		$precio = $_GET['Precio'];
		$imagen = $_GET['Imagen'];

		echo "<div class='container arriba'><form action='fmproductos.php?id=$id&Nombre=$nombre&Descripción=$descripcion&Precio=$precio&Imagen=$imagen' method='post' enctype=multipart/form-data>
		<div class='form-row'>
			<div class='form-group col-md-6'>
				<label for='nombre'>Nombre*</label>
				<input type='text' class='form-control' id='nombre' name='nomb' value='$nombre' required>
			</div>
			<div class='form-group col-md-6'>
				<label for='descripcion'>Descripción*</label>
				<textarea class='form-control' id='descripcion' name='descripcion' placeholder='$descripcion'></textarea>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group col-md-6'>
				<label for='precio'>Precio*</label>
				<input type='text' class='form-control' id='precio' name='precio' value='$precio' required>
			</div>
			<div class='form-group col-md-6'>
				<label for='imag'>Seleccionar una Imagen</label>
				<input class='form-control' type='file' id='imag' name='imagen'>
			</div>
		</div>
		<input class='btn-primary' type='submit' name='enviar'>
		</form></div>";

		if (isset($_POST['enviar'])){
			if($_POST['nomb'] != "" && $_POST['descripcion'] != "" && $_POST['precio'] != ""){
				$nombre = $_POST['nomb'];
				$descripcion = $_POST['descripcion'];
				$precio = $_POST['precio'];
				$nomb_tempo = $_FILES['imagen']['tmp_name'];
				$nombre_imagen = $_FILES['imagen']['name'];
				$ruta = "";

				if(!file_exists("../assets/images")){
					mkdir("../assets/images");
				}

				if($_FILES['imagen']['size'] == 0){
					$ruta = $imagen;
				}else{
					$ruta = "../assets/images/$id$imagen";
					move_uploaded_file($nomb_tempo,$ruta);
				}

				$actualizar = "UPDATE productos SET nombre = '$nombre',descripción = '$descripcion',precio = $precio,imagen = '$ruta'  where id = $id";
				mysqli_query($conexion,$actualizar);
		 		echo "Se modificó correctamente, será redirigido inmediatamente";
		 		header("refresh:1;url=productos.php");
			}else{
				echo "Ninguno de los campos con * puede estar vacío";
			}
		}
		mysqli_close($conexion);
		footer();
	?>
</body>
</html>