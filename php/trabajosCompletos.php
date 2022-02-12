<?php
  session_start();
  require_once("../funciones/funciones.php");
  comprobarClienteNormal();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Trabajo Completo</title>
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
		$ruta="../";
		$archivos="./";
		barra($ruta,$archivos);
		
		$titular = $_GET['Titulo'];
		$precio = $_GET['Precio'];
		$contenido = $_GET['Descripción'];
		$imagen = $_GET['Imagen'];
		

		echo "<div class='container-fluid mb-3 arriba'>
				<div class ='row no-gutters'>
					<div class='col-md-4'>
						<img src='".$imagen."' class='card-img' alt='Responsive image'>
					</div>
						<div class='card col-mb-8 iv'>
							<div class='card-body'>
				   				<h3 class='card-title'>$titular</h3>
				    			<p class='card-text'>$contenido.</p>
				    			<p class='card-text'><small class='text-muted'>".$precio."€</small>
				 		 	</div>
						</div>
				</div>
			</div>";
			footer();
	  ?>
</body>
</html>