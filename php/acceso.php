<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Iniciar Sesión</title>
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
		require_once("../funciones/funciones.php");
	 	$conexion = conectarServidor();
		echo "<div class='container'><h1 id='iniciar'>Iniciar Sesión</h1><form action='#' method='post'>
		<div class='form-row'>
			<div class='form-group offset-md-4 col-md-4'>
				<label for='nick'>Nick</label>
			    <input type='text' class='form-control' id='nick' name='nick'>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group offset-md-4  col-md-4'>
				<label for='contrasena'>Contraseña <i id='vision' class='fas fa-eye-slash'></i></label>	
				<input type='password' class='form-control' id='contrasena' name='contrasena'>
			</div>
		</div>
		<div class='form-row'>
			<div class='form-group offset-md-4  col-md-4'>
			<label><input name='abierta' type='checkbox' id='cbox1' value='abierta'>Mantener Sesion abierta</label>
			</div>
		</div>
		<div class='col-md-12 text-center'>
			<input type='submit' class='btn btn-primary text-center' name='enviar' value='Iniciar Sesion'>
		</div>
		</form></div>";
		if(isset($_POST['enviar']) && $_POST['nick'] != "" && $_POST['contrasena'] !=""){
			$nick = $_POST['nick'];
			$contrasena = $_POST['contrasena'];

			$consulta = "SELECT count(nick) from clientes where nick = '$nick'";
			$consulta2 = "SELECT count(contraseña) from clientes where contraseña = '$contrasena'";
			
			$res = mysqli_query($conexion,$consulta);
			$fila = mysqli_fetch_array($res,MYSQLI_NUM);
			$res = mysqli_query($conexion,$consulta2);
			$fila2 = mysqli_fetch_array($res,MYSQLI_NUM);

			if($fila[0] > 0 && $fila2[0] > 0){
				$consulta = "SELECT contraseña from clientes where nick = '$nick'";
				$res = mysqli_query($conexion,$consulta);
				$fila = mysqli_fetch_array($res,MYSQLI_ASSOC);

				if($fila['contraseña'] == $contrasena){
					$consulta = "SELECT id from clientes where nick = '$nick'";
					$res = mysqli_query($conexion,$consulta);
					$fila = mysqli_fetch_array($res,MYSQLI_ASSOC);

					$_SESSION['id'] = $fila['id'];
					$_SESSION['nick'] = $nick;

					$consulta = "SELECT nombre,apellidos from clientes where id= $fila[id]";
					$res = mysqli_query($conexion,$consulta);
					$fila = mysqli_fetch_array($res,MYSQLI_ASSOC);

					$_SESSION['nombre'] = $fila['nombre'];
					$_SESSION['apellidos'] = $fila['apellidos'];

					
					if(isset($_POST['abierta'])){
						setcookie("sesion",session_encode(),time()+(365*60*60),"/");
					}

					header("refresh:0;url=../index.php");
				}else{
					echo "Contraseña no coincide";
				}
				
			}else{
				echo "No coincide alguno de los campos.";
			}
		}
		mysqli_close($conexion);
	?>
</body>
</html>