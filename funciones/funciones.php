<?php
	function conectarServidor(){
		$conexion = mysqli_connect("localhost","root","","pasteleria");
    setlocale("LC_All", "es-ES");
		mysqli_set_charset($conexion,"utf8");
		if(!$conexion){
			echo "<h3> Error al conectar con la SGBD</h3>";
		}
		return $conexion;
  }
		function barra($ruta,$archivos){
        echo "<nav class='navbar navbar-expand-lg navbar-expand-sm navbar-light bg-light'>
        <a class='navbar-brand' href='#'>Pasteleria</a>
       <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
       <span class='navbar-toggler-icon'></span>
      </button>
  <div class='collapse navbar-collapse' id='navbarNav'>
    <ul class='navbar-nav mr-auto'>
      <li class='nav-item active'>
        <a class='nav-link' href='".$ruta."index.php'>Inicio <span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."noticias.php'>Noticias</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."clientes.php'>Clientes</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."productos.php'>Productos</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."trabajos.php'>Trabajos</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."encargos.php'>Encargos</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='#'>Contacto</a>
      </li> 
    </ul>
      <button name='IniciarSesion' class='btn btn-outline-success btn-sm my-sm-0 d-inline' type='submit'>Acceder</button>
  </div>
</nav>";
		}
  //Esto sirve para poder quitarle a la ruta de la imagen ../ 
  function imagenes($ruta){
     $datos = explode("/",$ruta);
      $datImagen = "";
      for ($i=1; $i < sizeof($datos); $i++) {
          if ($i < sizeof($datos) - 1) {
            $datImagen .= $datos[$i]."/";
          }else{
            $datImagen .= $datos[$i];
          }
            
        }
        return $datImagen;
  }
  //Muestra Los Clientes

  function tablaClientes($res){
    echo "<table class='table table-dark'>";
      echo "<thead>
            <tr>
                <th scope='col'>Nombre</th>
                <th scope='col'>Apellidos</th>
                <th scope='col'>Telefono</th>
                <th scope='col'>Modificar</th>
            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        echo "<tr><th>".$fila['nombre']."</th><th>".$fila['apellidos']."</th><th>".$fila['telefono1']."</th><th><a name='modificar' href='./fmclientes.php?id=$fila[id]&Nombre=$fila[nombre]&Apellidos=$fila[apellidos]&Telefono1=$fila[telefono1]&Telefono2=$fila[telefono2]&Contrasena=$fila[contraseña]&Nick=$fila[nick]'>Modificar</a></th></tr>";
      }
      echo "</table>";
  }
  //Muestra Los Productos

  function tablaProductos($res){
    echo "<table class='table table-dark'>";
      echo "<thead>
            <tr>
                <th scope='col'>Foto</th>
                <th scope='col'>Nombre</th>
                <th scope='col'>Descripción</th>
                <th scope='col'>Precio</th>
                <th scope='col'>Modificar</th>
            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        echo "<tr><th><img src='".$fila['imagen']."'></th><th>".$fila['nombre']."</th><th>".$fila['descripción']."</th><th>".$fila['precio']."</th><th><a name='modificar' href='./fmproductos.php?id=$fila[id]&Nombre=$fila[nombre]&Descripción=$fila[descripción]&Precio=$fila[precio]'>Modificar</a></th></tr>";
      }
      echo "</table>";
  }
  //Muestra Las Noticias

  function tablaNoticias($res){
  echo "<table class='table table-dark'>";
      echo "<thead>
            <tr>
                <th scope='col'>Foto</th>
                <th scope='col'>Titular</th>
                <th scope='col'>Fecha</th>
                <th scope='col'>Modificar</th>
            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        echo "<tr><th><img src='".$fila['imagen']."'></th><th>".$fila['titular']."</th><th>".fechaEspañol($fila['fecha'])."</th><th><a role='button' class='btn btn-success' name='eliminar'href='./borrarNoticia.php?id=$fila[id]'>Eliminar</a></th></tr>";
      }
      echo "</table>";
  }
  //Muestra Los Trabajos

  function tablaTrabajos($res){
    echo "<table class='table table-dark'>";
      echo "<thead>
            <tr>
                <th scope='col'>Foto</th>
                <th scope='col'>Titulo</th>
                <th scope='col'>Descripción</th>
                <th scope='col'>Precio</th>
                <th scope='col'>Cliente</th>
                <th scope='col'></th>
                <th scope='col'></th>

            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        echo "<tr><th><img src='".$fila['imagen']."'></th><th>".$fila['titulo']."</th><th>".$fila['descripción']."</th><th>".$fila['precio']."</th><th>".dimeCliente($fila['cliente'])."</th><th><a name='modificar' href='./fmtrabajos.php?id=$fila[id]&Cliente=$fila[cliente]&Titulo=$fila[titulo]&Imagen=$fila[imagen]&Descripción=$fila[descripción]&Precio=$fila[precio]'>Modificar</a></th><th><a role='button' class='btn btn-success' name='eliminar' href='./borrarTrabajo.php?id=$fila[id]'>Eliminar</a></th></tr>";
      }
      echo "</table>";
  }

  function dimeCliente($idCliente){
    $nombre = "disponible";
    if($idCliente != 0){
        $conexion = conectarServidor();
        $consulta = "SELECT nombre,apellidos FROM clientes where id=$idCliente";
        $res = mysqli_query($conexion,$consulta);
        $fila = mysqli_fetch_array($res,MYSQLI_ASSOC);
        $nombre = "Vendido a ".$fila['nombre']." ".$fila['apellidos'];
        mysqli_close($conexion);
      }
    return $nombre;
  }

  function selectCliente($res){
    echo "<option value='0'>Valor por Defecto</option>";
    while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
      echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
    }
  }
 function fechaEspañol($fechaInglesa){
  $fechaFinal = explode("-", $fechaInglesa);

  $dia = $fechaFinal[0];
  $mes = $fechaFinal[1];
  $anio = $fechaFinal[2];

  $fecha = $anio."-".$mes."-".$dia;
  return $fecha;
 }
 function idActual($nombretabla){
  $conexion = conectarServidor();
  $consulta = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'pasteleria' AND   TABLE_NAME   = '$nombretabla'";
  $res = mysqli_query($conexion,$consulta);
  $fila = mysqli_fetch_array($res,MYSQLI_NUM);
  return $fila[0];
 }
 function numeroResultados($res){
  $numero = mysqli_num_rows($res);
  return $numero;
 }
 function paginasTotales($elementos,$porPagina){
  return ceil($elementos / $porPagina);
 }
 function paginacion($ruta,$numPaginas){
  echo "<nav aria-label='Page navigation example'>
            <ul class='pagination'>";
            for ($i=1; $i <= $numPaginas ; $i++) { 
              echo "<li class='page-item'><a class='page-link' href='noticias.php?page=".$i."'>".$i."</a></li>";
            }
          echo "</ul>
      </nav>";
 }

?>

