<?php
  session_start();
 require_once("../funciones/funciones.php");
  comprobarAdmin();
?>
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
		$conexion = conectarServidor();
		$ruta="../";
		$archivos="./";
		barra($ruta,$archivos);

		$ruta = "noticias.php";
		$archivos = "fnnoticias.php";

		barraBusqueda($ruta,$archivos,"Nueva Noticia","titular","fecha");

		$porPagina = 5;
		$numNoticias = 0;


		if (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "0") {
			$consulta = "SELECT * FROM noticias";
			$res = mysqli_query($conexion,$consulta);
			//Me devuelve el numero de noticias que tengo.
			$numNoticias= numeroResultados($res);
			//Con el número de noticias lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numNoticias,$porPagina);
			

			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;
			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM noticias where titular like '%".$_POST['busc']."%' order by titular DESC,fecha DESC LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaNoticias($resPaginacion);

			paginacion($numeroDePaginas,$resPaginacion);

		}elseif (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "titular") {
			$consulta = "SELECT * FROM noticias";
			$res = mysqli_query($conexion,$consulta);
			//Me devuelve el numero de noticias que tengo.
			$numNoticias= numeroResultados($res);
			//Con el número de noticias lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numNoticias,$porPagina);
			

			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;
			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM noticias where titular like '%".$_POST['busc']."%' order by titular ASC LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaNoticias($resPaginacion);
			paginacion($numeroDePaginas,$resPaginacion);
			
		}elseif (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "fecha") {
			$consulta = "SELECT * FROM noticias";
			$res = mysqli_query($conexion,$consulta);
			
			//Me devuelve el numero de noticias que tengo.
			$numNoticias= numeroResultados($res);
			//Con el número de noticias lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numNoticias,$porPagina);
			

			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;
			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM noticias where titular like '%".$_POST['busc']."%' order by fecha DESC LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaNoticias($resPaginacion);
			paginacion($numeroDePaginas,$resPaginacion);

		}else{
			$consulta = "SELECT * FROM noticias";
			
			$res = mysqli_query($conexion,$consulta);
			//Me devuelve el numero de noticias que tengo.
			$numNoticias= numeroResultados($res);
			//Con el número de noticias lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numNoticias,$porPagina);

			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;

			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM noticias order by fecha DESC LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			
			tablaNoticias($resPaginacion);
			paginacion($numeroDePaginas,$resPaginacion);
			

		}
		 mysqli_close($conexion);
		 footer();
	  ?>
</body>
</html>