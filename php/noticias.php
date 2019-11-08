<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Noticias</title>
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
		$ruta="../";
		$archivos="./";
		barra($ruta,$archivos);
		
		echo "<form class='form-inline my-2 my-lg-0' action='./noticias.php' method='post'>
      	 <input class='form-control' type='Search' name='busc' placeholder='Buscar' aria-label='Search'>
         <button class='btn btn-outline-success btn-sm my-sm-0 d-inline' name='buscar' type='submit'>Buscar</button>
    	 </form>
    	 <form action='./fnnoticias.php'>
    	 <input type='submit' value='Nueva Noticia'/>
		 </form>";

		 $porPagina = 5;
		 $numNoticias = 0;
		 $ruta = "noticias.php";
		 $limite = 0;

		if (isset($_POST['buscar']) && $_POST['busc'] != "") {
			$consulta = "SELECT * FROM noticias where titular like '%".$_POST['busc']."%'";
			$res = mysqli_query($conexion,$consulta);
			tablaNoticias($res);
			$numNoticias = numeroResultados($res);
		}else{
			$consulta_General = "SELECT * FROM noticias";
			$consulta = "SELECT * FROM noticias LIMIT ".$limite.",".$porPagina;

			$res = mysqli_query($conexion,$consulta_General);
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaNoticias($resPaginacion);

			$numNoticias= numeroResultados($res);
			$numeroDePaginas = paginasTotales($numNoticias,$porPagina);
			paginacion($ruta,$numeroDePaginas);

			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}
			$limite = ($page-1)*$porPagina;
		}
		 mysqli_close($conexion);
	  ?>
</body>
</html>