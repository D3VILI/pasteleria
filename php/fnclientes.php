<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
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
      <script type="text/javascript" src="../assets/js/appVision.js"></script>
</head>
<body>
	<?php
		$conexion = conectarServidor();
		$ruta = "../";
		$archivos = "./";
		barra($ruta,$archivos);

		$idIncremental = idActual("clientes");
		
		echo "<div class='container arriba'><form action='fnclientes.php' method='post'>
		<div class='form-row'>
			<div class='form-group col-md-6'>
				<label for='$idIncremental'>ID</label>
				<input type='text' class='form-control' id='$idIncremental' value='$idIncremental' disabled>
			</div>
			<div class='form-group col-md-6'>
				<label for='nombre'>Nombre*</label>
				<input type='text' class='form-control' id='nombre' name='nomb' required>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group col-md-6'>
				<label for='apellidos'>Apellidos*</label>
				<input type='text' class='form-control' id='apellidos' name='apellidos' required>
			</div>
			<div class='form-group col-md-6'>
				<label for='telefono1'>Teléfono1*</label>
				<input type='text' class='form-control' id='telefono1' name='telefono1' required>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group col-md-4'>
				<label for='telefono2'>Teléfono2</label>
				<input type='text' class='form-control' id='telefono2' name='telefono2'>
			</div>
			<div class='form-group col-md-4'>
				<label for='nick'>Nick*</label>
				<input type='text' class='form-control' id='nick' name='nick' required>
			</div>
			<div class='form-group col-md-4'>
				<label for='contrasena'>Contraseña* <i id='vision' class='fas fa-eye-slash'></i></label>
				<input type='password' class='form-control' id='contrasena' name='contrasena' required>
			</div>
		</div>
		<input class='btn-primary' type='submit' name='enviar'>
		</form></div>";

		if (isset($_POST['enviar'])){
			if ($_POST['nomb'] != "" && $_POST['apellidos'] != "" && $_POST['telefono1'] != "" && $_POST['nick'] != "" && $_POST['contrasena'] != ""){

			$nombre = $_POST['nomb'];
			$apellidos = $_POST['apellidos'];
			$telefono1 = $_POST['telefono1'];
			$telefono2 = $_POST['telefono2'];
			$nick = $_POST['nick'];
			$contrasena = $_POST['contrasena'];

			$consulta = "SELECT count(nick) from clientes where nick = '$nick'";
			$res = mysqli_query($conexion,$consulta);
			$fila = mysqli_fetch_array($res,MYSQLI_NUM);

			if ($fila[0] == 0){
				if(strlen($telefono1) == 9){
					if ($telefono2 != "" && $telefono2 == 9) {
						$insertar = "INSERT INTO clientes (id,nombre,apellidos,telefono1,telefono2,nick,contraseña) VALUES (null,'$nombre','$apellidos',$telefono1,$telefono2,'$nick','$contrasena')";
						mysqli_query($conexion,$insertar);
			 			echo "Se insertó correctamente,sera redirigido inmediatamente";
			 			header("refresh:1;url=clientes.php");		
					}else{
						$insertar = "INSERT INTO clientes (id,nombre,apellidos,telefono1,telefono2,nick,contraseña) VALUES (null,'$nombre','$apellidos',$telefono1,$telefono2,'$nick','$contrasena')";
						mysqli_query($conexion,$insertar);
			 			echo "Se insertó correctamente,sera redirigido inmediatamente";
			 			header("refresh:1;url=clientes.php");
					}
				}else{
					echo "El teléfono tiene que tener 9 caracterés";
				}
			}else{
				echo "El nick ya existe";
			}

			}else{
				echo "Ninguno de los campos con * puede estar vacío";
			}
		}
		mysqli_close($conexion);
		footer();
	?>
</body>
</html>