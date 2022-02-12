<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Clientes</title>
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
		$ruta="../";
		$archivos="./";
		barra($ruta,$archivos);

		$ruta = "clientes.php";
		$archivos = "fnclientes.php";

		barraBusqueda($ruta,$archivos,"Nuevo Cliente","nombre","apellidos");
		
		if (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "0") {
			$consulta = "SELECT * FROM clientes where nombre like '%".$_POST['busc']."%' or apellidos like '%".$_POST['busc']."%' or telefono1 like '%".$_POST['busc']."%' or telefono2 like '%".$_POST['busc']."%'";
			$res = mysqli_query($conexion,$consulta);
			tablaClientes($res);
		}elseif(isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "nombre"){
			$consulta = "SELECT * FROM clientes where nombre like '%".$_POST['busc']."%' or apellidos like '%".$_POST['busc']."%' or telefono1 like '%".$_POST['busc']."%' or telefono2 like '%".$_POST['busc']."%' order by nombre";
			$res = mysqli_query($conexion,$consulta);
			tablaClientes($res);
		}elseif(isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "apellidos"){
			$consulta = "SELECT * FROM clientes where nombre like '%".$_POST['busc']."%' or apellidos like '%".$_POST['busc']."%' or telefono1 like '%".$_POST['busc']."%' or telefono2 like '%".$_POST['busc']."%' order by apellidos";
			$res = mysqli_query($conexion,$consulta);
			tablaClientes($res);
		}else{
			$consulta = "SELECT * FROM clientes";
			$res = mysqli_query($conexion,$consulta);
			tablaClientes($res);
		}
		 mysqli_close($conexion);
		 footer();
	  ?>
</body>
</html>