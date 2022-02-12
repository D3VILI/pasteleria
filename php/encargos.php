<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarInvitado();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Encargos</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/estilos.css">

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
     <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../assets/js/app.js"></script>
       <script type="text/javascript" src="../assets/js/appEncargadoPrincipal.js"></script>

</head>
<body>
	<?php
		$conexion = conectarServidor();
		$ruta="../";
		$archivos="./";
		barra($ruta,$archivos);

		$ruta = "encargos.php";
		$archivos = "fnencargos.php";

		barraBusqueda($ruta,$archivos,"Nuevo Encargo","fecha","nombre");

		if (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "0") {
			tablaEncargos($_POST['ordenar'],"escrito");
		}elseif(isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "fecha") {
			tablaEncargos($_POST['ordenar'],"escrito");
		}elseif(isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "nombre") {
			tablaEncargos($_POST['ordenar'],"escrito");
		}elseif(isset($_POST['buscar']) && $_POST['buscf'] != "" && $_POST['ordenar'] == "0"){
			tablaEncargos($_POST['ordenar'],"fecha");
		}elseif(isset($_POST['buscar']) && $_POST['buscf'] != "" && $_POST['ordenar'] == "fecha"){
			tablaEncargos($_POST['ordenar'],"fecha");
		}elseif(isset($_POST['buscar']) && $_POST['buscf'] != "" && $_POST['ordenar'] == "nombre"){
			tablaEncargos($_POST['ordenar'],"fecha");
		}else{
			tablaEncargos("todo","todo");
		}
		
		mysqli_close($conexion);
		footer();
	  ?>
</body>
</html>