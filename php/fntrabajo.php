<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Trabajo</title>
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

		$idIncremental = idActual("trabajos");
		
	echo "<div class='container arriba'><form action='fntrabajo.php' method='post' enctype='multipart/form-data'>
		<div class='form-row'>
			<div class='form-group col-md-4'>
				<label for='$idIncremental'>ID</label>
				<input type='text' class='form-control' id='$idIncremental' value='$idIncremental' disabled>
			</div>
			<div class='form-group col-md-4'>
				<label for='titulo'>Titulo*</label>
				<input type='text' class='form-control' id='titulo' name='titulo' required>
			</div>
			<div class='form-group col-md-4'>
				<label for='descripcion'>Descripción*</label>
				<textarea class='form-control' id='descripcion' name='descripcion' required></textarea>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group col-md-4'>
				<label for='precio'>Precio*</label>
				<input type='text' class='form-control' id='precio' name='precio' required>
			</div>
			<div class='form-group col-md-4'>
				<label for='cliente'>ID Cliente*</label>
				<select class='form-control' name='cliente'>";
				$consulta = "SELECT id,nombre FROM clientes";
			    $res = mysqli_query($conexion,$consulta);
			    selectCliente($res);
			echo "</select>
			</div>
			<div class='form-group col-md-4'>
				<label for='imag'>Seleccionar una Imagen*</label>
				<input class='form-control' type='file' id='imag' name='imagen' required>
			</div>
		</div>
		<input class='btn-primary' type='submit' name='enviar'>
		</form></div>";
		if (isset($_POST['enviar'])) {
			if($_POST['titulo'] != "" && $_POST['descripcion'] != "" && $_POST['precio'] != "" && $_FILES['imagen']['size'] > 0){
				
				$titulo = $_POST['titulo'];
				$descripcion = $_POST['descripcion'];
				$precio = $_POST['precio'];
				$cliente = $_POST['cliente'];
				$nomb_tempo = $_FILES['imagen']['tmp_name'];
				$nombre = $_FILES['imagen']['name'];

				if(!file_exists("../assets/images")){
					mkdir("../assets/images");
				}

					$ruta = "../assets/images/$idIncremental$nombre";
					move_uploaded_file($nomb_tempo,$ruta);

					$insertar = "INSERT INTO trabajos (id,titulo,descripción,precio,cliente,imagen) VALUES (null,'$titulo','$descripcion',$precio,$cliente,'$ruta')";
					mysqli_query($conexion,$insertar);
			 		echo "Se insertó correctamente,sera redirigido inmediatamente";
	 				header("refresh:1;url=trabajos.php");
			 		}else{
				echo "Ninguno de los campos con * puede estar vacío";
			}
		}
		mysqli_close($conexion);
		footer();
	?>
</body>
</html>