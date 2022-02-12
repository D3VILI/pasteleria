<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar Encargos</title>
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
		$fecha = $_GET['Fecha'];
		$hora = $_GET['Hora'];
		$producto = $_GET['Producto'];
		$extra = $_GET['Extra'];
		$cliente = $_GET['Cliente'];

		echo "<div class='container arriba'><form action='fmencargos.php?id=$id&Fecha=$fecha&Hora=$hora&Producto=$producto&Extra=$extra&Cliente=$cliente' method='post'>
		<div class='form-row'>
			<div class='form-group col-md-6'>
				<label for='fecha'>Fecha Recogida*</label>
				<input type='date' class='form-control' id='fecha' name='fecha' value='$fecha' required>
			</div>
			<div class='form-group col-md-6'>
				<label for='horario'>Hora de Recogida*</label>
				<input type='time' class='form-control' id='horario' name='horario' value='$hora' required>
			</div>

		</div>
		<div class='form-row'>
			<div class='form-group col-md-4'>
				<input type='text' value='$producto' disabled>
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
					<input type='text' class='form-control' id='extra' name='extra' value='$extra'>
			</div>	
			<div class='form-group col-md-4'>
				<input type='text' value='".dimeCliente($cliente)."' disabled>
				<label for='cliente'>ID Cliente*</label>
				<select class='form-control' name='cliente' id='cliente'>";
				if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
					$consulta = "SELECT id,nombre FROM clientes";
				}else{
					$consulta = "SELECT id,nombre FROM clientes where id = $_SESSION[id]";
				}
				$res = mysqli_query($conexion,$consulta);
				selectCliente($res);
				echo "</select>
			</div>
		</div>
		<input class='btn-primary' type='submit' name='enviar'>
		</form></div>";

		if (isset($_POST['enviar'])){
			if( $_POST['fecha'] != "" && $_POST['horario'] != "" && $_POST['producto'] != "" && $_POST['cliente'] != ""){
				$fecha = $_POST['fecha'];
				$horario = $_POST['horario'];
				$producto = $_POST['producto'];
				$extra = $_POST['extra'];
				$cliente = $_POST['cliente'];
				
				$actualizar = "UPDATE encargos SET fecha = '$fecha',hora = '$horario',producto = $producto,extra = '$extra' ,cliente = '$cliente' where id = $id";
				mysqli_query($conexion,$actualizar);
		 		echo "Se modificó correctamente, será redirigido inmediatamente.";
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
