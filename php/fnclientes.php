<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
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
		
		echo "<form action='fnclientes.php' method='post'>
		Nombre:
		<br>
		<input type='text' name='nomb' required>
		<br>
		Apellidos:
		<br>
		<input type='text' name='apellidos' required>
		<br>
		Teléfono1:
		<br>
		<input type='text' name='telefono1' required>
		<br>
		Teléfono2:
		<br>
		<input type='text' name='telefono2'>
		<br>
		Nick:
		<br>
		<input type='text' name='nick' required>
		<br>
		Contraseña:
		<br>
		<input type='password' name='contrasena' required>
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


			$insertar = "INSERT INTO clientes (id,nombre,apellidos,telefono1,telefono2,nick,contraseña) VALUES (null,'$nombre','$apellidos',$telefono1,$telefono2,'$nick','$contrasena')";
			mysqli_query($conexion,$insertar);
	 		echo "Se insertó correctamente";
	 		mysqli_close($conexion);
		}

	?>
</body>
</html>