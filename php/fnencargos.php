<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Encargos</title>
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
		
		echo " <form action='fnencargos.php' method='post'>
		Fecha de Recogida:
		<br>
		<input type='date' name='fecha' required>
		<br>
		Hora de Recogida:
		<br>
		<input type='time' name='hora' required>
		<br>
		Producto encargado:
		<select name='producto'>";
		$consulta2 = "SELECT id,nombre FROM productos";
		$result = mysqli_query($conexion,$consulta2);
		while ($fila = mysqli_fetch_array($res,MYSQL_ASSOC)) {
			echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
		}
		echo "<br>
		Información Extra:
		<br>
		<input type='text' name='extra'>
		<br>
		ID Cliente:
		<select name='cliente'>";
		$consulta = "SELECT id,nombre FROM clientes";
		$res = mysqli_query($conexion,$consulta);
		selectCliente($res);
		echo "</select>
		<br><br>
		<input type='submit' name='enviar'>
		</form>";

		if (isset($_POST['enviar']) && $_POST['producto'] != "") {
			$hora = $_POST['hora'];
			$extra = $_POST['extra'];
			$fecha = $_POST['fecha'];
			$cliente = $_POST['cliente'];
			$producto = $_POST['producto'];

			$insertar = "INSERT INTO encargos (id,fecha,hora,producto,extra,cliente) VALUES (null,'$fecha','$hora',$producto,'$extra',$cliente)";
			mysqli_query($conexion,$insertar);
	 		echo "Se insertó correctamente";
	 		mysqli_close($conexion);
		}

	?>
	
</body>
</html>