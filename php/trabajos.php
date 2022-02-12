<?php
  session_start();
  if(isset($_COOKIE['sesion'])){
    session_decode($_COOKIE['sesion']);
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Trabajos</title>
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
		$ruta ="../";
		$archivos ="./";
		barra($ruta,$archivos);

		$ruta = "trabajos.php";
		$archivos = "fntrabajo.php";

		barraBusqueda($ruta,$archivos,"Nuevo Trabajo","cliente","");

	if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
		if(isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "0") {
			$consulta = "SELECT * FROM trabajos where titulo like '%".$_POST['busc']."%'";
			$res = mysqli_query($conexion,$consulta);
			tablaTrabajos($res,$ruta);
		}elseif (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "cliente") {
			$consulta = "SELECT * FROM trabajos,clientes where clientes.id=trabajos.cliente and titulo like '%".$_POST['busc']."%' order by clientes.nombre";
			$res = mysqli_query($conexion,$consulta);
			tablaTrabajos($res,$ruta);
		}else{
			$consulta = "SELECT * FROM trabajos";
			$res = mysqli_query($conexion,$consulta);
			tablaTrabajos($res,$ruta);
		}
	}else{
		if(isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "0") {
			$consulta = "SELECT * FROM trabajos,clientes where clientes.id=trabajos.cliente and clientes.id = $_SESSION[id] and titulo like '%".$_POST['busc']."%'";
			$res = mysqli_query($conexion,$consulta);
			tablaTrabajos($res,$ruta);
		}elseif (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "cliente") {
			$consulta = "SELECT * FROM trabajos,clientes where clientes.id=trabajos.cliente and clientes.id = $_SESSION[id] and titulo like '%".$_POST['busc']."%' order by clientes.nombre";
			$res = mysqli_query($conexion,$consulta);
			tablaTrabajos($res,$ruta);
		}else{
			$consulta = "SELECT * FROM trabajos,clientes where clientes.id = trabajos.cliente and clientes.id = $_SESSION[id]";
			$res = mysqli_query($conexion,$consulta);
			tablaTrabajos($res,$ruta);
		}
	}
	mysqli_close($conexion);
	footer();
	?>
</body>
</html>