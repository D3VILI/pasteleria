<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Encargo</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/estilos.css">

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
     <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../assets/js/app.js"></script>
      <script type="text/javascript" src="../assets/js/appEncargo.js"></script>
</head>
<body>
	<?php
		$conexion = conectarServidor();
		$ruta = "../";
		$archivos = "./";
		barra($ruta,$archivos);
		$idIncremental = idActual("encargos");
		
		echo "<div class='container arriba'><form action='fnencargos.php' method='post'>
		<div class='form-row'>
			<div class='form-group col-md-4'>
				<label for='$idIncremental'>ID</label>
				<input type='text' class='form-control' id='$idIncremental' value='$idIncremental' disabled>
			</div>
			<div class='form-group col-md-4'>
				<label for='fecha'>Fecha Recogida*</label>
				<input type='date' class='form-control' id='fecha' name='fecha' required>
			</div>
			<div class='form-group col-md-4'>
				<label for='horario'>Hora de Recogida*</label>
				<input type='time' class='form-control' id='horario' name='horario' required>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group col-md-4'>
				<label for='producto'>Producto encargado*</label>
				<select class='form-control' name='producto' id='producto'>";
				$consulta2 = "SELECT id,nombre FROM productos";
				$result = mysqli_query($conexion,$consulta2);
				while ($fila = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
				}
				echo "
				</select>
			</div>
			<div class='form-group col-md-4'>
					<label for='extra'>Información Extra</label>
					<input type='text' class='form-control' id='extra' name='extra'>
			</div>
			
			<div class='form-group col-md-4'>
				<label for='cliente'>ID Cliente*</label>
				<select class='form-control' name='cliente' id='cliente'>";
				$consulta = "SELECT id,nombre FROM clientes";
				$res = mysqli_query($conexion,$consulta);
				selectCliente($res);
				echo "</select>
			</div>
		</div>
		<input class='btn-primary' type='submit' name='enviar' id='encargado'>
		</form></div>";

		if (isset($_POST['enviar'])) {
			if($_POST['producto'] != "" && $_POST['horario'] != "" && $_POST['cliente'] != ""){
				
				$horario = $_POST['horario'];
				$extra = $_POST['extra'];
				$fecha = $_POST['fecha'];
				$cliente = $_POST['cliente'];
				$producto = $_POST['producto'];

				$insertar = "INSERT INTO encargos (id,fecha,hora,producto,extra,cliente) VALUES (null,'$fecha','$horario',$producto,'$extra',$cliente)";

				mysqli_query($conexion,$insertar);
		 		echo "Se insertó correctamente,sera redirigido inmediatamente";
		 		header("refresh:1;url=encargos.php");
			}else{
				echo "Ninguno de los campos con * puede estar vacío";
			}
			
		}
		mysqli_close($conexion);
		footer();
	?>
	
</body>
</html>