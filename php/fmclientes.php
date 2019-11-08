<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar Cliente</title>
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
		$apellidos = $_GET['Apellidos'];
		$telefono1 = $_GET['Telefono1'];
		$telefono2 = $_GET['Telefono2'];
		$nick = $_GET['Nick'];
		$contrasena = $_GET['Contrasena'];

		echo "<form action='fmclientes.php?id=$id&Nombre=$nombre&Apellidos=$apellidos&Telefono1=$telefono1&Telefono2=$telefono2&Nick=$nick&Contrasena=$contrasena' method='post'>
		Nombre:
		<br>
		<input type='text' name='nomb' placeholder='$nombre' required>
		<br>
		Apellidos:
		<br>
		<input type='text' name='apellidos' placeholder='$apellidos' required>
		<br>
		Teléfono1:
		<br>
		<input type='text' name='telefono1' placeholder='$telefono1' required>
		<br>
		Teléfono2:
		<br>
		<input type='text' name='telefono2' placeholder='$telefono2'>
		<br>
		Nick:
		<br>
		<input type='text' name='nick' placeholder='$nick' required>
		<br>
		Contraseña:
		<br>
		<input type='password' name='contrasena' value='$contrasena' required>
		<br><br>
		<input type='submit' name='enviar'>
		</form>";

		if (isset($_POST['enviar']) && $_POST['nomb'] != "") {
			$nombre = $_POST['nomb'];
			$apellidos = $_POST['apellidos'];
			$telefono1 = $_POST['telefono1'];
			$telefono2 = $_POST['telefono2'];
			$nick = $_POST['nick'];
			$contrasena = $_POST['contrasena'];
			


			$actualizar = "UPDATE clientes SET nombre = '$nombre',apellidos = '$apellidos',telefono1 = $telefono1,telefono2 = $telefono2 ,nick = '$nick',contraseña = '$contrasena' where id = $id";
			mysqli_query($conexion,$actualizar);
	 		echo "Se modificó correctamente, será redirigido inmediatamente.";
	 		header("refresh:1;url=clientes.php");
	 		mysqli_close($conexion);
		}

	?>
</body>
</html>
