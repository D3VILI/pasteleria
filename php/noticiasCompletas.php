<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Noticia</title>
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
		$ruta="../";
		$archivos="./";
		barra($ruta,$archivos);
		
		$titular = $_GET['Titular'];
		$fecha = $_GET['Fecha'];
		$contenido = $_GET['Contenido'];
		$imagen = $_GET['Imagen'];

		echo "<div class='container'>
				<div class ='row'>
						<div class='card col dimensionDiv'>
							<div class='card-body'>
				   				<h3 class='card-title'>$titular</h3>
				    			<p class='card-text'>$contenido.</p>
				    			<p class='card-text'><small class='text-muted'>".fechaEspañol($fecha)."</small></p>
				 		 	</div>
				  		<img src='".$imagen."' class='card-img-top' alt='Responsive image'>
						</div>
				</div>
			</div>";

	  ?>
</body>
</html>