<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarInvitado();
?>
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
      <script type="text/javascript" src="../assets/js/appVision.js"></script>
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
		$apellidos = $_GET['Apellidos'];
		$telefono1 = $_GET['Telefono1'];
		$telefono2 = $_GET['Telefono2'];
		$nick = $_GET['Nick'];
		$contrasena = $_GET['Contrasena'];

		if($_SESSION['id'] == 0){
				echo "<div class='container arriba'><form action='fmclientes.php?id=$id&Nombre=$nombre&Apellidos=$apellidos&Telefono1=$telefono1&Telefono2=$telefono2&Nick=$nick&Contrasena=$contrasena' method='post'>
			<div class='form-row'>
				<div class='form-group col-md-6'>
					<label for='nombre'>Nombre*</label>
					<input type='text' class='form-control' id='nombre' name='nomb' value='$nombre' required>
				</div>
				<div class='form-group col-md-6'>
					<label for='apellidos'>Apellidos*</label>
					<input type='text' class='form-control' id='apellidos' name='apellidos'  value='$apellidos' required>
				</div>
			</div>
			<div class='form-row'>
				<div class='form-group col-md-6'>
						<label for='telefono1'>Teléfono1*</label>
						<input type='text' class='form-control' id='telefono1' name='telefono1' value='$telefono1' required>
				</div>
				<div class='form-group col-md-6'>
					<label for='telefono2'>Teléfono2</label>
					<input type='text' class='form-control' id='telefono2' name='telefono2'>
				</div>
			</div>
			<div class='form-row'>
				<div class='form-group col-md-6'>
					<label for='nick'>Nick*</label>
					<input type='text' class='form-control' id='nick' name='nick' value='$nick' required>
				</div>
				<div class='form-group col-md-6'>
					<label for='contrasena'>Contraseña* <i id='vision' class=' fas fa-eye-slash'></i></label>
					<input type='password' class='form-control' id='contrasena' name='contrasena' value='$contrasena' required>
				</div>
			</div>
			<input class='btn-primary' type='submit' name='enviar'> 
			</form></div>";

			if (isset($_POST['enviar'])){
				if( $_POST['nomb'] != "" && $_POST['apellidos'] != "" && $_POST['telefono1'] != "" && $_POST['nick'] != "" && $_POST['contrasena'] != ""){
					$nombre = $_POST['nomb'];
					$apellidos = $_POST['apellidos'];
					$telefono1 = $_POST['telefono1'];
					$telefono2 = $_POST['telefono2'];
					$nick = $_POST['nick'];
					$contrasena = $_POST['contrasena'];

					
					if($telefono2 == ""){
						$telefono2 = "0";
						$actualizar = "UPDATE clientes SET nombre = '$nombre',apellidos = '$apellidos',telefono1 = $telefono1,telefono2 = $telefono2 ,nick = '$nick',contraseña = '$contrasena' where id = $id";
						mysqli_query($conexion,$actualizar);
				 		echo "Se modificó correctamente, será redirigido inmediatamente.";
						echo "<meta http-equiv='refresh' content='1;url=clientes.php'>";
					}else{
						$actualizar = "UPDATE clientes SET nombre = '$nombre',apellidos = '$apellidos',telefono1 = $telefono1,telefono2 = $telefono2 ,nick = '$nick',contraseña = '$contrasena' where id = $id";
						mysqli_query($conexion,$actualizar);
				 		echo "Se modificó correctamente, será redirigido inmediatamente.";
				 		echo "<meta http-equiv='refresh' content='1;url=clientes.php'>";
					}
					
				}else{
					echo "Ninguno de los campos con * puede estar vacío";
				}
			}
		}else{
				echo "<div class='container arriba'><form action='fmclientes.php?id=$id&Nombre=$nombre&Apellidos=$apellidos&Telefono1=$telefono1&Telefono2=$telefono2&Nick=$nick&Contrasena=$contrasena' method='post'>
			<div class='form-row'>
				<div class='form-group col-md-6'>
					<label for='nombre'>Nombre*</label>
					<input type='text' class='form-control' id='nombre' name='nomb' value='$nombre' required readonly>
				</div>
				<div class='form-group col-md-6'>
					<label for='apellidos'>Apellidos*</label>
					<input type='text' class='form-control' id='apellidos' name='apellidos'  value='$apellidos' required readonly>
				</div>
			</div>
			<div class='form-row'>
				<div class='form-group col-md-6'>
						<label for='telefono1'>Teléfono1*</label>
						<input type='text' class='form-control' id='telefono1' name='telefono1' value='$telefono1' required>
				</div>
				<div class='form-group col-md-6'>
					<label for='telefono2'>Teléfono2</label>
					<input type='text' class='form-control' id='telefono2' name='telefono2'>
				</div>
			</div>
			<div class='form-row'>
				<div class='form-group col-md-6'>
					<label for='nick'>Nick*</label>
					<input type='text' class='form-control' id='nick' name='nick' value='$nick' required readonly>
				</div>
				<div class='form-group col-md-6'>
					<label for='contrasena'>Contraseña* <i id='vision' class=' fas fa-eye-slash'></i></label>
					<input type='password' class='form-control' id='contrasena' name='contrasena' value='$contrasena' required>
				</div>
			</div>
			<input class='btn-primary' type='submit' name='enviar'> 
			</form></div>";

			if (isset($_POST['enviar'])){
				if($_POST['nomb'] != "" && $_POST['apellidos'] != "" && $_POST['telefono1'] != "" && $_POST['nick'] != "" && $_POST['contrasena'] != ""){
					$nombre = $_POST['nomb'];
					$apellidos = $_POST['apellidos'];
					$telefono1 = $_POST['telefono1'];
					$telefono2 = $_POST['telefono2'];
					$nick = $_POST['nick'];
					$contrasena = $_POST['contrasena'];

					if($_SESSION['id'] == $id && $_SESSION['nick'] == $nick && $_SESSION['nombre'] == $nombre && $_SESSION['apellidos'] == $apellidos){
						if($telefono2 == ""){
							$telefono2 = "0";
							$actualizar = "UPDATE clientes SET nombre = '$nombre',apellidos = '$apellidos',telefono1 = $telefono1,telefono2 = $telefono2 ,nick = '$nick',contraseña = '$contrasena' where id = $id";
							mysqli_query($conexion,$actualizar);
					 		echo "Se modificó correctamente, será redirigido inmediatamente.";
					 		echo "<meta http-equiv='refresh' content='1;url=misDatosPersonales.php'>";
						}else{
							$actualizar = "UPDATE clientes SET nombre = '$nombre',apellidos = '$apellidos',telefono1 = $telefono1,telefono2 = $telefono2 ,nick = '$nick',contraseña = '$contrasena' where id = $id";
							mysqli_query($conexion,$actualizar);
					 		echo "Se modificó correctamente, será redirigido inmediatamente.";
					 		echo "<meta http-equiv='refresh' content='1;url=misDatosPersonales.php'>";
						}
					}else{
						echo "No modifiques por url";
					}
					
				}else{
					echo "Ninguno de los campos con * puede estar vacío";
				}
			}
		}

		
		mysqli_close($conexion);
		footer();
	?>
</body>
</html>
