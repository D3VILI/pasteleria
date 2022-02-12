<?php
  session_start();
  if(isset($_COOKIE['sesion'])){
    session_decode($_COOKIE['sesion']);
  }
  if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
  		
  }else{
  	header("refresh:0;url=acceso.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Productos</title>
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

		$ruta = "productos.php";
		$archivos = "fnproductos.php";

		barraBusqueda($ruta,$archivos,"Nuevo Producto","nombre","precio");
		
		$porPagina = 5;
		$numProductos = 0;

		if (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "0") {
			$consulta = "SELECT * FROM productos";
			$res = mysqli_query($conexion,$consulta);
			//Me devuelve el numero de productos que tengo.
			$numProductos= numeroResultados($res);
			//Con el número de productos lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numProductos,$porPagina);
				
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;

			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM productos where nombre like '%".$_POST['busc']."%' or precio like '%".$_POST['busc']."%' order by precio,nombre LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaProductos($resPaginacion);
			paginacion($numeroDePaginas,$resPaginacion);
			
		}elseif (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "nombre") {
			$consulta = "SELECT * FROM productos";
			$res = mysqli_query($conexion,$consulta);

			//Me devuelve el numero de productos que tengo.
			$numProductos= numeroResultados($res);
			//Con el número de productos lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numProductos,$porPagina);
				
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;

			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM productos where nombre like '%".$_POST['busc']."%' or precio like '%".$_POST['busc']."%' order by nombre LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaProductos($resPaginacion);
			paginacion($numeroDePaginas,$resPaginacion);

		}elseif (isset($_POST['buscar']) && $_POST['busc'] != "" && $_POST['ordenar'] == "precio") {
			$consulta = "SELECT * FROM productos";
			$res = mysqli_query($conexion,$consulta);

			//Me devuelve el numero de productos que tengo.
			$numProductos= numeroResultados($res);
			//Con el número de productos lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numProductos,$porPagina);
				
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;

			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM productos where nombre like '%".$_POST['busc']."%' or precio like '%".$_POST['busc']."%' order by precio LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaProductos($resPaginacion);
			paginacion($numeroDePaginas,$resPaginacion);

		}else{
			$consulta = "SELECT * FROM productos";
			$res = mysqli_query($conexion,$consulta);

			//Me devuelve el numero de productos que tengo.
			$numProductos= numeroResultados($res);
			//Con el número de productos lo divido por los que quiero poner por página y obtengo el número de páginas
			$numeroDePaginas = paginasTotales($numProductos,$porPagina);
				
			if(!isset($_GET['page'])){
				$page = 1;
			}else{
				$page = $_GET['page'];
			}

			$limite = ($page-1)*$porPagina;

			//Hago la consulta con los límites para mostrar de 5 en 5.
			$consulta = "SELECT * FROM productos LIMIT ".$limite.",".$porPagina;
			$resPaginacion = mysqli_query($conexion,$consulta);

			tablaProductos($resPaginacion);
			paginacion($numeroDePaginas,$resPaginacion);
		}
		 mysqli_close($conexion);
		 footer();
	  ?>
</body>
</html>