<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar Trabajo</title>
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
		$titulo = $_GET['Titulo'];
		$cliente = $_GET['Cliente'];
		$precio = $_GET['Precio'];
		$imagen = $_GET['Imagen'];
		$descripcion = $_GET['Descripción'];
		echo "<div class='container arriba'><form action='fmtrabajos.php?id=$id&Cliente=$cliente&Titulo=$titulo&Descripción=$descripcion&Imagen=$imagen&Precio=$precio' method='post'>
		<div class='form-row'>
			<div class='form-group col-md-6'>
				<label for='cliente'>Nombre Del Cliente Actual</label>
				<input type='text' class='form-control' value='".dimeCliente($cliente)."' disabled>
			</div>
			<div class='form-group col-md-6'>
				<label for='cliente'>Cliente*</label>
				<select  class='form-control' name='cliente' id='cliente'>";
				$consulta = "SELECT id,nombre FROM clientes";
				$res = mysqli_query($conexion,$consulta);
				selectCliente($res);
			echo "</select></div>
		</div>
		<input class='btn-primary' type='submit' name='enviar'>
		</form></div>";

		if (isset($_POST['enviar'])) {
			if($_POST['cliente'] != ""){
				$cliente = $_POST['cliente'];
				$actualizar = "UPDATE trabajos SET titulo = '$titulo',descripción = '$descripcion',cliente = $cliente,precio = $precio,imagen = '$imagen' where id = $id";
				mysqli_query($conexion,$actualizar);
		 		echo "Se modificó correctamente, será redirigido inmediatamente";
		 		header("refresh:1;url=trabajos.php");
			}
		}
		mysqli_close($conexion);
		footer();
	?>
</body>
</html>