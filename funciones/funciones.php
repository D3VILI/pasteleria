<?php
	function conectarServidor(){
		$conexion = mysqli_connect("localhost","root","","pasteleria");
    setlocale(LC_ALL, "es-ES");
		mysqli_set_charset($conexion,"utf8");
		if(!$conexion){
			echo "<h3> Error al conectar con la SGBD</h3>";
		}
		return $conexion;
  }
		function barra($ruta,$archivos){
      if(isset($_SESSION['id']) == ""){
        echo "<nav class='navbar navbar-expand-lg navbar-expand-sm navbar-dark bg-dark fixed-top'>
        <a class='navbar-brand' href='#'><i class=' fas fa-cookie'></i></a>
       <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
       <span class='navbar-toggler-icon'></span>
      </button>
  <div class='collapse navbar-collapse' id='navbarNav'>
    <ul class='navbar-nav mr-auto'>
      <li class='nav-item active'>
        <a class='nav-link' href='".$ruta."index.php'>Inicio<span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."productos.php'>Productos</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."trabajos.php'>Trabajos</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."contacto.php'>Contacto</a>
      </li> 
    </ul>
      <small class='text-muted botonDerecha' id='hora'></small>
      <a name='IniciarSesion' class='btn  btn-sm my-sm-0 d-inline botonDerecha' href='".$archivos."acceso.php' type='submit'>Acceder</a>
  </div>
</nav>";
   //Administrador
      }else if($_SESSION['id'] == 0){
         echo "<nav class='navbar navbar-expand-lg navbar-expand-sm navbar-dark bg-dark fixed-top'>
        <a class='navbar-brand' href='#'><i class=' fas fa-cookie'></i></a>
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
        <a class='nav-link' href='".$archivos."contacto.php'>Contacto</a>
      </li> 
    </ul>
      <small class='text-muted botonDerecha' id='hora'></small>
       <form action='".$ruta."index.php' method='post'><input name='cerrar' class='btn  btn-sm my-sm-0 d-inline botonDerecha' type='submit' value='Cerrar Sesion ".$_SESSION['nombre']." ".$_SESSION['apellidos']."'></form>
  </div>
</nav>";
  //Clientes Normales
      }else{
        echo "<nav class='navbar navbar-expand-lg navbar-expand-sm navbar-dark bg-dark fixed-top'>
        <a class='navbar-brand' href='#'><i class=' fas fa-cookie'></i></a>
       <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
       <span class='navbar-toggler-icon'></span>
      </button>
  <div class='collapse navbar-collapse' id='navbarNav'>
    <ul class='navbar-nav mr-auto'>
      <li class='nav-item active'>
        <a class='nav-link' href='".$ruta."index.php'>Inicio <span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."misDatosPersonales.php'>Datos Personales</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."trabajos.php'>Trabajos</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."encargos.php'>Encargos</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."trabajosDisponibles.php'>Trabajos Disponibles</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='".$archivos."contacto.php'>Contacto</a>
      </li> 
    </ul>
    <small class='text-muted botonDerecha' id='hora'></small>
    <form action='".$ruta."index.php' method='post'><input name='cerrar' class='btn  btn-sm my-sm-0 d-inline botonDerecha' type='submit' value='Cerrar Sesion ".$_SESSION['nombre']." ".$_SESSION['apellidos']."'></form>
  </div>
</nav>";
      }
       if (isset($_POST['cerrar'])){
        
          $_SESSION = array();
          session_destroy();


          if (isset($_COOKIE['sesion'])) {
            setcookie("sesion","",time()-1,"/");
          }
         
          header("refresh:0;url=index.php");
        } 
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
  // Esto sirve para los diferentes clientes.
  function comprobarInvitado(){
    if(isset($_COOKIE['sesion'])){
      session_decode($_COOKIE['sesion']);
    }
    if(isset($_SESSION['id']) == ""){
      header("refresh:0;url=acceso.php"); 
    }
  }

  function comprobarClienteNormal(){
    if(isset($_COOKIE['sesion'])){
      session_decode($_COOKIE['sesion']);
    }
    if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
      header("refresh:0;url=acceso.php");
    }
  }

  function comprobarAdmin(){
    if(isset($_COOKIE['sesion'])){
      session_decode($_COOKIE['sesion']);
    }
    if(isset($_SESSION['id']) == "" || $_SESSION['id'] != 0){
      header("refresh:0;url=acceso.php");
    }
  }

  //Muestra Los Clientes

  function tablaClientes($res){
    $numero = mysqli_num_rows($res);
    if($numero > 0){
      if (isset($_SESSION['id']) == "" || $_SESSION['id'] == 0) {
         echo "<table class='table table-dark table-striped table-responsive-sm'>";
      echo "<thead>
            <tr>
                <td scope='col'>Nombre</td>
                <td scope='col'>Apellidos</td>
                <td scope='col'>Teléfono 1</td>
                <td scope='col'>Teléfono 2</td>
                <td scope='col'>Nick</td>
                <td scope='col'>Contraseña</td>
                <td scope='col'>Modificar</td>
            </tr>
        </thead>"; 
      }else{
         echo "<table class='table table-dark table-striped table-responsive-sm arriba'>";
      echo "<thead>
            <tr>
                <td scope='col'>Nombre</td>
                <td scope='col'>Apellidos</td>
                <td scope='col'>Teléfono 1</td>
                <td scope='col'>Teléfono 2</td>
                <td scope='col'>Nick</td>
                <td scope='col'>Contraseña</td>
                <td scope='col'>Modificar</td>
            </tr>
        </thead>";
      }
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        if($fila['telefono2'] == 0){
          echo "<tr><td>".$fila['nombre']."</td><td>".$fila['apellidos']."</td><td>".$fila['telefono1']."</td><td>---</td><td>".$fila['nick']."</td><td>".$fila['contraseña']."</td><td><a class='modificar' name='modificar' href='./fmclientes.php?id=$fila[id]&Nombre=$fila[nombre]&Apellidos=$fila[apellidos]&Telefono1=$fila[telefono1]&Telefono2=$fila[telefono2]&Contrasena=$fila[contraseña]&Nick=$fila[nick]'><i class='fas fa-pencil-alt'></i></a></td></tr>";

        }else{
          echo "<tr><td>".$fila['nombre']."</td><td>".$fila['apellidos']."</td><td>".$fila['telefono1']."</td><td>".$fila['telefono2']."</td><td>".$fila['nick']."</td><td>".$fila['contraseña']."</td><td><a class='modificar' name='modificar' href='./fmclientes.php?id=$fila[id]&Nombre=$fila[nombre]&Apellidos=$fila[apellidos]&Telefono1=$fila[telefono1]&Telefono2=$fila[telefono2]&Contrasena=$fila[contraseña]&Nick=$fila[nick]'><i class='fas fa-pencil-alt'></i></a></td></tr>";
        }
      }
      echo "</table>";
    }else{
      echo "No se ha encontrado ningún Cliente";
    }
    
  }
  //Muestra Los Productos

  function tablaProductos($res){
     $numero = mysqli_num_rows($res);
     if($numero > 0){
         echo "<table class='table table-dark table-responsive-sm'>";
         echo "<thead>
            <tr>
                <td scope='col'>Foto</td>
                <th scope='col'>Nombre</td>
                <td scope='col'>Descripción</td>
                <td scope='col'>Precio</td>
                <td scope='col'>Modificar</td>
            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
        if(isset($_SESSION['id']) == ""){
          echo "<tr><td><img class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['nombre']."</td><td>".$fila['descripción']."</td><td>".$fila['precio']."</td><td><a class='modificar disabled' name='modificar' href='./fmproductos.php?id=$fila[id]&Nombre=$fila[nombre]&Descripción=$fila[descripción]&Precio=$fila[precio]&Imagen=$fila[imagen]'><i class='fas fa-pencil-alt'></i></a></td></tr>";
        }else{
          echo "<tr><td><img class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['nombre']."</td><td>".$fila['descripción']."</td><td>".$fila['precio']."</td><td><a class='modificar' name='modificar' href='./fmproductos.php?id=$fila[id]&Nombre=$fila[nombre]&Descripción=$fila[descripción]&Precio=$fila[precio]&Imagen=$fila[imagen]'><i class='fas fa-pencil-alt'></i></a></td></tr>";
        }
        
      }
      echo "</table>";
     }else{
      echo "No se ha encontrado ningún Producto";
     }
   
  }
  //Muestra Las Noticias

  function tablaNoticias($res){
     $numero = mysqli_num_rows($res);
     if($numero > 0){
      echo "<table class='table table-dark table-striped col-sm-12'>";
      echo "<thead>
            <tr>
                <td scope='col'>Foto</td>
                <td scope='col'>Titular</td>
                <td scope='col'>Fecha</td>
                <td scope='col'>Eliminar</td>
            </tr>
        </thead>";
      while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        if(isset($_SESSION['id']) == ""){
          echo "<tr><td><img  class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['titular']."</td><td>".fechaEspañol($fila['fecha'])."</td><td><a role='button' class='btn borrarn disabled' name='eliminar'href='./borrarNoticia.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }else{
          echo "<tr><td><img  class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['titular']."</td><td>".fechaEspañol($fila['fecha'])."</td><td><a role='button' class='btn borrarn' name='eliminar'href='./borrarNoticia.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }
        
      }
      echo "</table>";
     }else{
      echo "No se ha encontrado ningúna Noticia";
     }
  
  }

  //Muestra Los Trabajos

  function tablaTrabajos($res,$ruta){
    $numero = mysqli_num_rows($res);
     if($numero > 0){
        if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
           echo "<table class='table table-dark table-responsive-sm'>";
      echo "<thead>
            <tr>
                <td scope='col'>Foto</td>
                <td scope='col'>Título</td>
                <td scope='col'>Descripción</td>
                <td scope='col'>Precio</td>
                <td scope='col'>Cliente</td>
                <td scope='col'>Modificar</td>
                <td scope='col'>Eliminar</td>

            </tr>
        </thead>";
        }else{
          if($ruta == "trabajos.php"){
               echo "<table class='table table-dark table-responsive-sm'>";
          echo "<thead>
                <tr>
                  <td scope='col'>Foto</td>
                  <td scope='col'>Título</td>
                  <td scope='col'>Descripción</td>
                  <td scope='col'>Precio</td>
                  <td scope='col'>Cliente</td>
                  <td scope='col'>Modificar</td>
                  <td scope='col'>Eliminar</td>
                </tr>
            </thead>";

          }else{

             echo "<table class='table table-dark table-responsive-sm'>";
          echo "<thead>
                <tr>
                  <td scope='col'>Foto</td>
                  <td scope='col'>Título</td>
                  <td scope='col'>Precio</td>
                  <
                </tr>
            </thead>";

          }
      }
        
      while($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)){

        if(dimeCliente($fila['cliente']) == "disponible" && isset($_SESSION['id']) == ""){
           echo "<tr><td><img class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['titulo']."</td><td>".$fila['descripción']."</td><td>".$fila['precio']."</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='modificar disabled' name='modificar' href='./fmtrabajos.php?id=$fila[id]&Cliente=$fila[cliente]&Titulo=$fila[titulo]&Imagen=$fila[imagen]&Descripción=$fila[descripción]&Precio=$fila[precio]'><i class='fas fa-pencil-alt'></i></a></td><td><a class=' disabled btn borrart' name='eliminar' href='./borrarTrabajo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }else if(dimeCliente($fila['cliente']) == "disponible" && $_SESSION['id'] == 0 ){
           echo "<tr><td><img class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['titulo']."</td><td>".$fila['descripción']."</td><td>".$fila['precio']."</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='modificar' name='modificar' href='./fmtrabajos.php?id=$fila[id]&Cliente=$fila[cliente]&Titulo=$fila[titulo]&Imagen=$fila[imagen]&Descripción=$fila[descripción]&Precio=$fila[precio]'><i class='fas fa-pencil-alt'></i></a></td><td><a class='btn borrart' name='eliminar' href='./borrarTrabajo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }else if(isset($_SESSION['id']) > 0){
          if($ruta == "trabajos.php"){
               echo "<tr><td><img class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['titulo']."</td><td>".$fila['descripción']."</td><td>".$fila['precio']."</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='modificar disabled' name='modificar' href='./fmtrabajos.php?id=$fila[id]&Cliente=$fila[cliente]&Titulo=$fila[titulo]&Imagen=$fila[imagen]&Descripción=$fila[descripción]&Precio=$fila[precio]'><i class='fas fa-pencil-alt'></i></a></td><td><a class=' disabled btn borrart' name='eliminar' href='./borrarTrabajo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
          }else{
            echo "<tr><td><img class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['titulo']."</td><td>".$fila['precio']."</td><td><a role='button' class='btn' href='trabajosCompletos.php?id=$fila[id]&Cliente=$fila[cliente]&Titulo=$fila[titulo]&Imagen=$fila[imagen]&Descripción=$fila[descripción]&Precio=$fila[precio]'>Ver más</a></td></tr>";
          }
        }else{
           echo "<tr><td><img class='img-fluid imagen' src='".$fila['imagen']."' alt='Responsive image'></td><td>".$fila['titulo']."</td><td>".$fila['descripción']."</td><td>".$fila['precio']."</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='modificar disabled' name='modificar' href='./fmtrabajos.php?id=$fila[id]&Cliente=$fila[cliente]&Titulo=$fila[titulo]&Imagen=$fila[imagen]&Descripción=$fila[descripción]&Precio=$fila[precio]'><i class='fas fa-pencil-alt'></i></a></td><td><a class=' disabled btn borrart' name='eliminar' href='./borrarTrabajo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }
      }
      
      echo "</table>";
     }else{
       echo "No se ha encontrado ningún Trabajo";
     }
  }
  //Muestra Los Encargos

  function tablaEncargos($ordenar,$tipo){
    $conexion = conectarServidor();
    
    $diaActual = strftime("%d");

    //Te saca los meses y años dependiendo de si quieres ir hacia delante o atras

    if(isset($_GET['mesD']) && isset($_GET['anioD'])){
        $anio = $_GET['anioD'];
        $mes = $_GET['mesD'];
      }elseif(isset($_GET['mesA']) && isset($_GET['anioA'])){
        $anio = $_GET['anioA'];
        $mes = $_GET['mesA'];
      }else{
        $anio = strftime("%Y");
        $mes = strftime("%m");
      }
      echo "<div class='container'>";
      if($mes>1){
        echo "<a name='detras' href='?mesD=".($mes-1)."&anioD=".($anio)."
        '><i class='fas fa-angle-left iconosCalendario'></i></a>";
      }elseif ($mes == 1) {
        echo "<a name='detras' href='?mesD=12&anioD=".($anio-1)."'><i class='fas fa-angle-left  iconosCalendario'></i></a>";
      }      
      
      if($mes<12){
        echo "<a name='adelante' href='?mesA=".($mes+1)."&anioA=".($anio)."'><i class='fas fa-angle-right  iconosCalendario'></i></a>";
      }elseif($mes == 12){
        echo "<a name='adelante' href='?mesA=1&anioA=".($anio+1)."'><i class='fas fa-angle-right  iconosCalendario'></i></a>";
      }

    //
            
    pintartabla($diaActual,$mes,$anio);

    //Muestra los datos a raíz del botón pulsado
    $fechaActual = $anio."-".$mes."-".$diaActual;

    if(isset($_GET['fecha'])){

      $consulta = "SELECT * FROM encargos where fecha = '$_GET[fecha]'";
      $result = mysqli_query($conexion,$consulta);

      echo "<div class='calendario'><table class='table table-dark table-responsive-sm'>
        <thead>
            <tr>
                <td scope='col'>Fecha</td>
                <td scope='col'>Hora</td>
                <td scope='col'>Producto</td>
                <td scope='col'>Extra</td>
                <td scope='col'>Cliente</td>
                <td scope='col'>Modificar</td>
                <td scope='col'>Eliminar</td>    
            </tr>
        </thead>";

    while($fila=mysqli_fetch_array($result,MYSQLI_ASSOC)){
      
        if($fila['fecha'] > $fechaActual && $_SESSION['id'] == 0){
             echo "<tr><td>".fechaEspañol($fila['fecha'])."</td><td>$fila[hora]</td><td>$fila[producto]</td><td>$fila[extra]</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='modificar' name='modificar' href='./fmencargos.php?id=$fila[id]&Fecha=$fila[fecha]&Hora=$fila[hora]&Producto=$fila[producto]&Extra=$fila[extra]&Cliente=$fila[cliente]'><i class='fas fa-pencil-alt'></i></a></td><td><a class='btn borrare' name='eliminar' href='./borrarEncargo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }else{
           echo "<tr><td>".fechaEspañol($fila['fecha'])."</td><td>$fila[hora]</td><td>$fila[producto]</td><td>$fila[extra]</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='disabled modificar' name='modificar' href='./fmencargos.php?id=$fila[id]&Fecha=$fila[fecha]&Hora=$fila[hora]&Producto=$fila[producto]&Extra=$fila[extra]&Cliente=$fila[cliente]'><i class='fas fa-pencil-alt'></i></a></td><td><a class='btn borrare disabled' name='eliminar' href='./borrarEncargo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }
      echo "</table></div>";
    }
  }

  if(isset($_POST['buscar'])){
    //Tuve que dividir mis consultas a la hora de buscar por uno u otro campo

    if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
      if($ordenar == "0" && $tipo == "escrito"){
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and nombre like '%".$_POST['busc']."%' or fecha like '%".$_POST['busc']."%'";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "fecha" && $tipo == "escrito") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and nombre like '%".$_POST['busc']."%' or fecha like '%".$_POST['busc']."%' order by fecha";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "nombre" && $tipo == "escrito") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and nombre like '%".$_POST['busc']."%' or fecha like '%".$_POST['busc']."%' order by clientes.nombre";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "0" && $tipo == "fecha") {
        $consulta = "SELECT * FROM encargos where fecha like '%".$_POST['buscf']."%'";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "fecha" && $tipo == "fecha") {
        $consulta = "SELECT * FROM encargos where fecha like '%".$_POST['buscf']."%' order by fecha";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "nombre" && $tipo == "fecha") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and fecha like '%".$_POST['buscf']."%' order by clientes.nombre";
        $res = mysqli_query($conexion,$consulta);
      }else{
        $consulta = "SELECT * FROM encargos";
        $res = mysqli_query($conexion,$consulta);
      }
    }else{
      if($ordenar == "0" && $tipo == "escrito"){
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id] and nombre like '%".$_POST['busc']."%' or fecha like '%".$_POST['busc']."%'";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "fecha" && $tipo == "escrito") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id] and nombre like '%".$_POST['busc']."%' or fecha like '%".$_POST['busc']."%' order by fecha";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "nombre" && $tipo == "escrito") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id] and nombre like '%".$_POST['busc']."%' or fecha like '%".$_POST['busc']."%' order by clientes.nombre";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "0" && $tipo == "fecha") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id] and fecha like '%".$_POST['buscf']."%'";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "fecha" && $tipo == "fecha") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id] and fecha like '%".$_POST['buscf']."%' order by fecha";
        $res = mysqli_query($conexion,$consulta);
      }else if ($ordenar == "nombre" && $tipo == "fecha") {
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id] and fecha like '%".$_POST['buscf']."%' order by clientes.nombre";
        $res = mysqli_query($conexion,$consulta);
      }else{
        $consulta = "SELECT * FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id]";
        $res = mysqli_query($conexion,$consulta);
      }
    }
  
   echo "<div class='calendario'><table class='table table-dark table-responsive-sm'>";
   echo "
        <thead>
            <tr>
                <td scope='col'>Fecha</td>
                <td scope='col'>Hora</td>
                <td scope='col'>Producto</td>
                <td scope='col'>Extra</td>
                <td scope='col'>Cliente</td>
                <td scope='col'>Modificar</td>
                <td scope='col'>Eliminar</td>
            </tr>
        </thead>";
    while($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        if($fila['fecha'] > $fechaActual && $_SESSION['id'] == 0){
             echo "<tr><td>".fechaEspañol($fila['fecha'])."</td><td>$fila[hora]</td><td>$fila[producto]</td><td>$fila[extra]</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='modificar' name='modificar' href='./fmencargos.php?id=$fila[id]&Fecha=$fila[fecha]&Hora=$fila[hora]&Producto=$fila[producto]&Extra=$fila[extra]&Cliente=$fila[cliente]'><i class='fas fa-pencil-alt'></i></a></td><td><a class='btn borrare' name='eliminar' href='./borrarEncargo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }else{
           echo "<tr><td>".fechaEspañol($fila['fecha'])."</td><td>$fila[hora]</td><td>$fila[producto]</td><td>$fila[extra]</td><td>".dimeCliente($fila['cliente'])."</td><td><a class='disabled modificar' name='modificar' href='./fmencargos.php?id=$fila[id]&Fecha=$fila[fecha]&Hora=$fila[hora]&Producto=$fila[producto]&Extra=$fila[extra]&Cliente=$fila[cliente]'><i class='fas fa-pencil-alt'></i></a></td><td><a class='btn borrare disabled' name='eliminar' href='./borrarEncargo.php?id=$fila[id]'><i class='fas fa-trash'></i></a></td></tr>";
        }
    }
     echo "</table></div>";
  }

  mysqli_close($conexion);    
  }

  function pintartabla($diaActual,$mes,$anio){
    $ultimoDiaMes = strftime("%d",(mktime(0,0,0,$mes+1,1,$anio)-1));
    $nombMes = strftime("%B",mktime(0,0,0,$mes,$diaActual,$anio));
    $nombMesFinal = ucfirst($nombMes);
    $diaSemana = strftime("%w",mktime(0,0,0,$mes,1,$anio))+7;
    $celdaAnterior = $diaSemana + $ultimoDiaMes;
    $mesActual = strftime("%m");
    $fechaEncargo = "";
  
     echo "<table class='table table-dark table-striped table-responsive-sm'><h5>$nombMesFinal de $anio</h5>";
    echo "<thead><tr><td>L</td><td>M</td><td>X</td><td>J</td>
    <th>V</td><td>S</td><td>D</td></tr></thead><tr>";

  for ($i=1; $i <= 42; $i++) {
      if($i == $diaSemana){
        $dia = 1;
      }
      if($i < $diaSemana || $i >= $celdaAnterior){
        echo "<td>&nbsp</td>";
      }else{
        $fechaEncargo = $anio."-".$mes."-".$dia;
        $entra = traerEncargo($dia,$fechaEncargo);
          if($diaActual == $dia && $mesActual == $mes){
             echo "<td><a class='btn' href='?fecha=$fechaEncargo' role='button'>$dia</a></td>";
          }elseif($entra){
              echo "<td><a class='btn btn-primary pulsarEncargo' href='?fecha=$fechaEncargo' role='button'>$dia</a></td>";
          }else{
            echo "<td>$dia</td>";
          }
          $dia++;
      }  
      if($i%7==0)
      {
        echo "</tr><tr>";
      }
  }
  echo "</tr></table></div>";
  
}

function traerEncargo($dia,$fechaEncargo){
    $conexion = conectarServidor();
    if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
      $consulta = "SELECT fecha FROM encargos where fecha = '$fechaEncargo'";
    }else{
      $consulta = "SELECT fecha FROM encargos,clientes where encargos.cliente = clientes.id and clientes.id = $_SESSION[id] and fecha = '$fechaEncargo'";
    }
    
    $res = mysqli_query($conexion,$consulta);
    $entra = false;
    while($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)){
          $marca_fecha = strtotime($fila['fecha']);
          $dia_fecha = strftime('%d', $marca_fecha);

          if($dia == $dia_fecha){
            $entra = true;
          }
    }
    return $entra;
  }

  function dimeCliente($idCliente){
    $nombre = "disponible";
    if($idCliente != 0){
        $conexion = conectarServidor();
        $consulta = "SELECT nombre,apellidos FROM clientes where id=$idCliente";
        $res = mysqli_query($conexion,$consulta);
        $fila = mysqli_fetch_array($res,MYSQLI_ASSOC);
        $nombre = $fila['nombre']." ".$fila['apellidos'];
        mysqli_close($conexion);
      }
    return $nombre;
  }
  // function Administrador($id){
  //       $conexion = conectarServidor();
  //       $consulta = "SELECT nombre,apellidos FROM clientes where id=$id";
  //       $res = mysqli_query($conexion,$consulta);
  //       $fila = mysqli_fetch_array($res,MYSQLI_ASSOC);
  //       $nombre = $fila['nombre']." ".$fila['apellidos'];
       
  //       mysqli_close($conexion);
  //       return $nombre;
  // }

  function selectCliente($res){
    if(isset($_SESSION['id']) == "" || $_SESSION['id'] == 0){
      echo "<option value='0'>Disponible</option>";
    }
    while ($fila = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
      if($fila['id'] != 0){
        echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
      }
    }
  }

 function fechaEspañol($fechaInglesa){
  $fechaFinal = explode("-", $fechaInglesa);

  $dia = $fechaFinal[2];
  $mes = $fechaFinal[1];
  $anio = $fechaFinal[0];

  $fecha = $dia."-".$mes."-".$anio;
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

 function paginacion($numPaginas,$resPaginacion){
  $numero = mysqli_num_rows($resPaginacion);
      if($numero > 0){
        echo "<ul class='pagination'>";
            for ($i=1; $i <= $numPaginas ; $i++) { 
              echo "<li class='page-item'><a class='page-link' href='?page=".$i."'>".$i."</a></li>";
            }
          echo "</ul>";
      }
 }
 
 function barraBusqueda($principal,$formulario,$nuevo,$valor1,$valor2){
  if($valor1 != "" && $valor2 != "" && $principal != "encargos.php" && isset($_SESSION['id']) == ""){
    echo "<div class=' arriba container'><form class='form-group mb-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
           <select class='form-control' name='ordenar'>
           <option value='0'>Opción de ordenación</option>
           <option value='".$valor1."'>".$valor1."</option>
           <option value='".$valor2."'>".$valor2."</option>
           </select>
           </div>
            <div class='form-group col-md-6'>
             <button class='btn btn-sm my-lg-1 my-sm-0' name='buscar' type='submit'>Buscar</button>
            </div>
         </div>
       </form></div>";
  }elseif($principal == "encargos.php" && isset($_SESSION['id']) == ""){
    echo "<div class='arriba container'><form class='form-group mb-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
         <div class='form-group col-md-4'>
         <input type='date' class='form-control' name='buscf' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
           <select class='form-control' name='ordenar'>
           <option value='0'>Opción de ordenación</option>
           <option value='".$valor1."'>".$valor1."</option>
           <option value='".$valor2."'>".$valor2."</option>
           </select>
           </div>
            <div class='form-group col-md-6'>
             <button class='btn btn-sm my-lg-1 my-sm-0' name='buscar' type='submit'>Buscar</button>
            </div>
         </div>
       </form></div>";
  }else if($valor1 != "" && $valor2 == "" && $principal != "encargos.php" && isset($_SESSION['id']) == ""){
    echo "<div class='arriba container'><form class='form-group my-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
         <select class='form-control' name='ordenar'>
         <option value='0'>Opción de ordenación</option>
         <option value='".$valor1."'>".$valor1."</option>
         </select>
         </div>
         <div class='form-group col-md-6'>
            <button class='btn btn-sm my-sm-0 my-lg-1' name='buscar' type='submit'>Buscar</button>
          </div>
         </div>
       </form></div>";
  }else if($principal == "encargos.php" && $_SESSION['id'] == 0){
    echo "<div class='arriba container'><form class='form-group mb-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
         <div class='form-group col-md-4'>
         <input type='date' class='form-control' name='buscf' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
           <select class='form-control' name='ordenar'>
           <option value='0'>Opción de ordenación</option>
           <option value='".$valor1."'>".$valor1."</option>
           <option value='".$valor2."'>".$valor2."</option>
           </select>
           </div>
            <div class='form-group col-md-6'>
             <button class='btn btn-sm my-lg-1 my-sm-0' name='buscar' type='submit'>Buscar</button>
            </div>
         </div>
       </form></div>
       <form action='".$formulario."'>
       <input class='botonNew' type='submit' value='".$nuevo."'/>
       </form>";
  }else if($valor1 != "" && $valor2 != "" && $principal != "encargos.php" && $_SESSION['id'] == 0){
    echo "<div class='arriba container'><form class='form-group mb-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
           <select class='form-control' name='ordenar'>
           <option value='0'>Opción de ordenación</option>
           <option value='".$valor1."'>".$valor1."</option>
           <option value='".$valor2."'>".$valor2."</option>
           </select>
           </div>
            <div class='form-group col-md-6'>
             <button class='btn btn-sm my-lg-1 my-sm-0' name='buscar' type='submit'>Buscar</button>
            </div>
         </div>
       </form></div>
       <form action='".$formulario."'>
       <input class='botonNew' type='submit' value='".$nuevo."'/>
       </form>";
  }else if($valor1 != "" && $valor2 == "" && $principal != "encargos.php" && $_SESSION['id'] == 0){
    echo "<div class='arriba container'><form class='form-group my-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
         <select class='form-control' name='ordenar'>
         <option value='0'>Opción de ordenación</option>
         <option value='".$valor1."'>".$valor1."</option>
         </select>
         </div>
         <div class='form-group col-md-6'>
            <button class='btn btn-sm my-sm-0 my-lg-1' name='buscar' type='submit'>Buscar</button>
          </div>
         </div>
       </form></div>
       <form action='".$formulario."'>
       <input class='botonNew' type='submit' value='".$nuevo."'/>
     </form>";
  }else if($valor1 != "" && $valor2 != "" && $principal != "encargos.php" && $_SESSION['id'] > 0){
    echo "<div class='arriba container'><form class='form-group mb-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
           <select class='form-control' name='ordenar'>
           <option value='0'>Opción de ordenación</option>
           <option value='".$valor1."'>".$valor1."</option>
           <option value='".$valor2."'>".$valor2."</option>
           </select>
           </div>
            <div class='form-group col-md-6'>
             <button class='btn btn-sm my-lg-1 my-sm-0' name='buscar' type='submit'>Buscar</button>
            </div>
         </div>
       </form></div>";
  }else if($valor1 != "" && $valor2 == "" && $principal != "encargos.php" && $_SESSION['id'] > 0){
     echo "<div class='arriba container'><form class='form-group my-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
         <select class='form-control' name='ordenar'>
         <option value='0'>Opción de ordenación</option>
         <option value='".$valor1."'>".$valor1."</option>
         </select>
         </div>
         <div class='form-group col-md-6'>
            <button class='btn btn-sm my-sm-0 my-lg-1' name='buscar' type='submit'>Buscar</button>
          </div>
         </div>
       </form></div>";
  }else{
    echo "<div class='arriba container'><form class='form-group mb-2 my-lg-2' action='".$principal."' method='post'>
        <div class='form-row'>
        <div class='form-group col-md-4'>
         <input type='Search' class='form-control' name='busc' placeholder='Buscar' aria-label='Search' readonly>
         </div>
         <div class='form-group col-md-4'>
         <input type='date' class='form-control' name='buscf' aria-label='Search'>
         </div>
        </div>
        <div class='form-row'>
         <div class='form-group col-md-6'>
           <select class='form-control' name='ordenar'>
           <option value='0'>Opción de ordenación</option>
           <option value='".$valor1."'>".$valor1."</option>
           <option value='".$valor2."'>".$valor2."</option>
           </select>
           </div>
            <div class='form-group col-md-6'>
             <button class='btn btn-sm my-lg-1 my-sm-0' name='buscar' type='submit'>Buscar</button>
            </div>
         </div>
       </form></div>";
  }

 }

 function footer(){
 echo "
 <div class='container-fluid' id='footer'>
  <div class='row align-items-center'>
        <div class='col-md-4 col-lg-4 col-sm-12 derecha'>
          <p>©Angel Garcia</p>
        </div>
          <div class='col-md-4 col-lg-4 centro'>
          <p>
            <a href='#' role='button' data-toggle='modal' data-target='#exampleModalAvisos'>Avisos Legales</a> | <a href='#'  role='button' data-toggle='modal' data-target='#exampleModalCookie'>Politica de Cookies</a> | <a href='#'  role='button' data-toggle='modal' data-target='#exampleModalPrivi'>Politica de privacidad</a>
          </p>
        </div>
          <div class='col-md-4 col-lg-4 izquierda'>
          <i class='fab fa-facebook-square iconos-sociales'></i>
          <i class='fab fa-instagram iconos-sociales'></i>
          <i class='fab fa-twitter-square iconos-sociales'></i>
        </div>
  </div>
</div>";

//Avisos Legales

  echo "<div class='modal fade' id='exampleModalAvisos' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLongTitle'>Avisos Legales</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        <h5> Identificación y Titularidad</h5>

        <p>En cumplimiento del artículo 10 de la Ley 34 / 2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico, el Titular expone sus datos identificativos.</p>

        <ul>
        <li>Titular: Ángel García López</li>
        <li>Registro mercantil: Autónomo</li>
        <li>Titulación: Técnico Superior</li>
        <li>NIF: 76740890X</li>
        <li>Domicilio: C:/ Huetor Vega nº10</li>
        <li>Correo Electrónico: aagarcia2010@gmail.com</li>
        <li>Sitio web: localhost/index.php </li>
        </ul>
         <h5> Finalidad </h5>
          <p>La finalidad del sitio Web localhost/index.php es gestionar una pasteleria a nivel de administrador.</p>
        <h5>Condiciones de Uso</h5>

        <p>La utilización del sitio Web le otorga la condición de Usuario, e implica la aceptación completa de todas las cláusulas y condiciones de uso incluidas en las páginas:  Aviso Legal  Política de Privacidad  Política de Cookies Si no estuviera conforme con todas y cada una de estas cláusulas y condiciones absténgase de utilizar este sitio Web. El acceso a este sitio Web no supone, en modo alguno, el inicio de una relación comercial con el Titular.</p> 

          <p>A través de este sitio Web, el Titular le facilita el acceso y la utilización de diversos contenidos que el Titular o sus colaboradores han publicado por medio de Internet.</p>
          <p>A tal efecto, usted está obligado y comprometido a NO utilizar cualquiera de los contenidos del sitio Web con fines o efectos ilícitos, prohibidos en este Aviso Legal o por la legislación vigente, lesivos de los derechos e intereses de terceros, o que de cualquier forma puedan dañar, inutilizar, sobrecargar, deteriorar o impedir la normal utilización de los contenidos, los equipos informáticos o los documentos, archivos y toda clase de contenidos almacenados en cualquier equipo informático propios o contratados por el Titular, de otros usuarios o de cualquier usuario de Internet.</p>
            
            <h5>Medidas de seguridad</h5>
            <p>Los datos personales que facilite al Titular pueden ser almacenados en bases de datos automatizadas o no, cuya titularidad corresponde en exclusiva a el Titular, que asume todas las medidas de índole técnica, organizativa y de seguridad que garantizan la confidencialidad, integridad y calidad de la información contenida en las mismas de acuerdo con lo establecido en la normativa vigente en protección de datos.</p>

            <p>No obstante, debe ser consciente de que las medidas de seguridad de los sistemas informáticos en Internet no son enteramente fiables y que, por tanto el Titular no puede garantizar la inexistencia de virus u otros elementos que puedan producir alteraciones en los sistemas informáticos (software y hardware) del Usuario o en sus documentos electrónicos y ficheros contenidos en los mismos aunque el Titular pone todos los medios necesarios y toma las medidas de seguridad oportunas para evitar la presencia de estos elementos dañinos.</p>

            <h5>Datos personales</h5>
            <p>Usted puede consultar toda la información relativa al tratamiento de datos personales que recoge el Titular en la página de la Política de Privacidad.</p>
            
            <h5>Contenidos</h5>

            <p>El Titular ha obtenido la información, el contenido multimedia y los materiales incluidos en el sitio Web de fuentes que considera fiables, pero, si bien ha tomado todas las medidas razonables para asegurar que la información contenida es correcta, el Titular no garantiza que sea exacta, completa o actualizada. El Titular declina expresamente cualquier responsabilidad por error u omisión en la información contenida en las páginas de este sitio Web.</p>

            <p>Queda prohibido transmitir o enviar a través del sitio Web cualquier contenido ilegal o ilícito, virus informáticos, o mensajes que, en general, afecten o violen derechos de el Titular o de terceros.</p>

            <p>Los contenidos del Sitio Web tienen únicamente una finalidad informativa y bajo ninguna circunstancia deben usarse ni considerarse como oferta de venta, solicitud de una oferta de compra ni recomendación para realizar cualquier otra operación, salvo que así se indique expresamente.</p>

            <p>El Titular se reserva el derecho a modificar, suspender, cancelar o restringir el contenido del Sitio Web, los vínculos o la información obtenida a través del sitio Web, sin necesidad de previo aviso. 
            El Titular no es responsable de los daños y perjuicios que pudieran derivarse de la utilización de la información del sitio Web o de la contenida en las redes sociales del Titular.</p>

            <h5>Política de cookies</h5>
            <p>En la página Política de Cookies puede consultar toda la información relativa a la política de recogida y tratamiento de las cookies. El Titular sólo obtiene y conserva la siguiente información acerca de los visitantes del Sitio Web:</p>

            <p>El nombre de dominio del proveedor (PSI) y/o dirección IP que les da acceso a la red.  La fecha y hora de acceso al sitio Web.  La dirección de Internet origen del enlace que dirige al sitio Web.  El número de visitantes diarios de cada sección.  La información obtenida es totalmente anónima, y en ningún caso puede ser asociada a un Usuario concreto e identificado.</p>

            <h5>Enlaces a otros sitios Web</h5>
            <p>El Titular puede proporcionarle acceso a sitios Web de terceros mediante enlaces con la finalidad exclusiva de informar sobre la existencia de otras fuentes de información en Internet en las que podrá ampliar los datos ofrecidos en el sitio Web.</p>
            <p>Estos enlaces a otros sitios Web no suponen en ningún caso una sugerencia o recomendación para que usted visite las páginas web de destino, que están fuera del control del Titular, por lo que Titular no es responsable del contenido de los sitios web vinculados ni del resultado que obtenga al seguir los enlaces.</p>
            <p>Estos enlaces a otros sitios Web no suponen en ningún caso una sugerencia o recomendación para que visites las páginas web de destino, que están fuera del control del Titular, por lo que Titular no es responsable del contenido de los sitios web vinculados ni del resultado que obtengas al seguir los enlaces.</p>
            <p>Asimismo, el Titular no responde de los links o enlaces ubicados en los sitios web vinculados a los que le proporciona acceso.</p>
            <p>El establecimiento del enlace no implica en ningún caso la existencia de relaciones entre Titular y el propietario del sitio en el que se establezca el enlace, ni la aceptación o aprobación por parte del Titular de sus contenidos o servicios.</p>
            <p>Si accede a un sitio Web externo desde un enlace que encuentre en el Sitio Web usted deberá leer la propia política de privacidad del otro sitio web que puede ser diferente de la de este sitio Web.</p>

            <h5>Propiedad intelectual e industrial</h5>

            <p>Todos los derechos están reservados.</p>
            <p>Todo acceso a este sitio Web está sujeto a las siguientes condiciones: la reproducción, almacenaje permanente y la difusión de los contenidos o
              cualquier otro uso que tenga finalidad pública o comercial queda expresamente prohibida sin el consentimiento previo expreso y por escrito de Titular.</p>
            
            <h5>Limitación de responsabilidad</h5>
            <p>La información y servicios incluidos o disponibles a través de este sitio Web pueden incluir incorrecciones o errores tipográficos. De forma periódica el Titular incorpora mejoras y/o cambios a la información contenida y/o los Servicios que puede introducir en cualquier momento.</p>
            <p>El Titular no declara ni garantiza que los servicios o contenidos sean interrumpidos o que estén libres de errores, que los defectos sean corregidos, o que el servicio o el servidor que lo pone a disposición estén libres de virus u otros componentes nocivos sin perjuicio de que el Titular realiza todos los esfuerzos en evitar este tipo de incidentes.</p>
            <p>Titular declina cualquier responsabilidad en caso de que existan interrupciones o un mal funcionamiento de los Servicios o contenidos ofrecidos en Internet, cualquiera que sea su causa. Asimismo, el Titular no se hace responsable por caídas de la red, pérdidas de negocio a consecuencia de dichas caídas, suspensiones temporales de fluido eléctrico o cualquier otro tipo de daño indirecto que te pueda ser causado por causas ajenas a el Titular. Antes de tomar decisiones y/o acciones con base a la información incluida en el sitio Web, el Titular le recomienda comprobar y contrastar la información recibida con otras fuentes.</p>

            <h5>Jurisdicción</h5>
            <p>Este Aviso Legal se rige íntegramente por la legislación española.</p>
            <p>Siempre que no haya una norma que obligue a otra cosa, para cuantas cuestiones se susciten sobre la interpretación, aplicación y cumplimiento de este Aviso Legal, así como de las reclamaciones que puedan derivarse de su uso, las partes acuerdan someterse a los Jueces y Tribunales de la provincia de Granada, con renuncia expresa de cualquier otra jurisdicción que pudiera corresponderles.</p>

            <h5>Contacto</h5>
            <p>En caso de que usted tenga cualquier duda acerca de estas Condiciones legales o quiera realizar cualquier comentario sobre este sitio Web, puede enviar un mensaje de correo electrónico a la dirección aagarcia2010@gmail.com.</p>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
      </div>
    </div>
  </div>
</div>";

//Politica de Cookies

 echo "<div class='modal fade' id='exampleModalCookie' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLongTitle'>Politica de Cookies</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>

        <h6>En cumplimiento con lo dispuesto en el artículo 22.2 de la Ley 34⁄2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico, esta página web le informa, en esta sección, sobre la política de recogida y tratamiento de cookies.</h6>

        <h5>¿Qué son las cookies?</h5>

        <p>Una cookie es un fichero que se descarga en su ordenador al acceder a determinadas páginas web. Las cookies permiten a una página web, entre otras cosas, almacenar y recuperar información sobre los hábitos de navegación de un usuario o de su equipo y, dependiendo de la información que contengan y de la forma en que utilice su equipo, pueden utilizarse para reconocer al usuario.</p>

        <p>Por ahora la página web</p>

        <h5>¿Qué tipos de cookies utiliza esta página web?</h5>

        <p>Cookies de análisis - Son aquéllas que bien tratadas por nosotros o por terceros, nos permiten cuantificar el número de usuarios y así realizar la medición y análisis estadístico de la utilización que hacen los usuarios del servicio ofertado. Para ello se analiza su navegación en nuestra página web con el fin de mejorar la oferta de productos o servicios que le ofrecemos.</p>
        <p>Cookies publicitarias - Son aquéllas que, bien tratadas por nosotros o por terceros, nos permiten gestionar de la forma más eficaz posible la oferta de los espacios publicitarios que hay en la página web, adecuando el contenido del anuncio al contenido del servicio solicitado o al uso que realice de nuestra página web. Para ello podemos analizar sus hábitos de navegación en Internet y podemos mostrarle publicidad relacionada con su perfil de navegación.</p>

        <h5>Cómo desactivar las Cookies</h5>

        <p>Puede usted permitir, bloquear o eliminar las cookies instaladas en su equipo mediante la configuración de las opciones del navegador instalado en su ordenador.</p>

        <p>A continuación puede acceder a la configuración de los navegadores webs más frecuentes para aceptar, instalar o desactivar las cookies:  Firefox  Safari  Google Chrome</p>

        <h5>Cookies de Terceros</h5>

        <p>Esta página web utiliza servicios de terceros para recopilar información con fines estadísticos y de uso de la web.</p>

        <p>En este caso no se usa ninguna cookie.</p>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
      </div>
    </div>
  </div>
</div>";


//Politica de Privacidad

echo "<div class='modal fade' id='exampleModalPrivi' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLongTitle'>Politica de Cookies</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        <h6>Te informa sobre su Política de Privacidad respecto del tratamiento y
          protección de los datos de carácter personal de los usuarios y clientes que
          puedan ser recabados por la navegación o contratación de servicios a través del
          sitio Web</h6>

          <p>En este sentido, el Titular garantiza el cumplimiento de la normativa vigente en
          materia de protección de datos personales, reflejada en la Ley Orgánica 3/2018,
          de 5 de diciembre, de Protección de Datos Personales y de Garantía de
          Derechos Digitales (LOPD GDD). Cumple también con el Reglamento (UE)
          2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo
          a la protección de las personas físicas (RGPD).</p>

          <p>El uso de sitio Web implica la aceptación de esta Política de Privacidad así
          como las condiciones incluidas en el Aviso Legal.</p>

        <h5>Identidad del responsable</h5>

        <ul><li>Titular: Ángel García López</li>
        <li> Titulos: Técnico Superior DAW y DAM.</li>
        <li> NIF/CIF: 76740890X</li>
        <li>Domicilio: C:/ Huetor Vega nº 10 18140</li>
        <li>Correo electrónico: aagarcia2010@gmail.com</li>
        <li>Sitio Web: localhost/index.php</li></ul>

        <h5>Principios aplicados en el tratamiento de datos</h5>

        <p>En el tratamiento de tus datos personales, el Titular aplicará los siguientes
        principios que se ajustan a las exigencias del nuevo reglamento europeo de
        protección de datos:</p>

        <ul>
        <li>Principio de licitud, lealtad y transparencia: El Titular siempre requerirá el
        consentimiento para el tratamiento de tus datos personales que puede
        ser para uno o varios fines específicos sobre los que te informará
        previamente con absoluta transparencia.</li>
        <li>Principio de minimización de datos: El Titular te solicitará solo los datos
        estrictamente necesarios para el fin o los fines que los solicita.</li>
        <li>Principio de limitación del plazo de conservación: Los datos se
        mantendrán durante el tiempo estrictamente necesario para el fin o los
        fines del tratamiento.
        El Titular te informará del plazo de conservación correspondiente según
        la finalidad. En el caso de suscripciones, el Titular revisará
        periódicamente las listas y eliminará aquellos registros inactivos durante
        un tiempo considerable.</li>
        <li>Principio de integridad y confidencialidad: Tus datos serán tratados de tal
        manera que su seguridad, confidencialidad e integridad esté garantizada.
        Debes saber que el Titular toma las precauciones necesarias para evitar
        el acceso no autorizado o uso indebido de los datos de sus usuarios por
        parte de terceros.</li>
        </ul>

        <h5>Obtención de datos personales</h5>

        <h5>Para navegar por localhost/index.php no es necesario que facilites ningún dato
        personal. Los casos en los que sí proporcionas tus datos personales son los
        siguientes:</h5>

        <ul><li>Al contactar a través de los formularios de contacto o enviar un correo
        electrónico.</li></ul>
        
        <h5>Tus derechos</h5>

        <p>El Titular te informa que sobre tus datos personales tienes derecho a:</p>

        <ul><li>Solicitar el acceso a los datos almacenados.</li>
        <li>Solicitar una rectificación o la cancelación.</li>
        <li>Solicitar la limitación de su tratamiento.</li>
        <li>Oponerte al tratamiento.</li>
        <li>Solicitar la portabilidad de tus datos.</li></ul>

      <p>El ejercicio de estos derechos es personal y por tanto debe ser ejercido
      directamente por el interesado, solicitándolo directamente al Titular, lo que
      significa que cualquier cliente, suscriptor o colaborador que haya facilitado sus
      datos en algún momento puede dirigirse al Titular y pedir información sobre los
      datos que tiene almacenados y cómo los ha obtenido, solicitar la rectificación de
      los mismos, solicitar la portabilidad de sus datos personales, oponerse al
      tratamiento, limitar su uso o solicitar la cancelación de esos datos en los
      ficheros del Titular.
      Para ejercitar tus derechos de acceso, rectificación, cancelación, portabilidad y
      oposición tienes que enviar un correo electrónico a CORREO
      ELECTRÓNICO junto con la prueba válida en derecho como una fotocopia del
      D.N.I. o equivalente.
      Tienes derecho a la tutela judicial efectiva y a presentar una reclamación ante la
      autoridad de control, en este caso, la Agencia Española de Protección de Datos,
      si consideras que el tratamiento de datos personales que te conciernen infringe
      el Reglamento.</p>

      <h5>Finalidad del tratamiento de datos personales</h5>

      <p>Cuando te conectas al sitio Web para mandar un correo al Titular, te suscribes a
      su boletín o realizas una contratación, estás facilitando información de carácter
      personal de la que el responsable es el Titular. Esta información puede incluir
      datos de carácter personal como pueden ser tu dirección IP, nombre y apellidos,
      dirección física, dirección de correo electrónico, número de teléfono, y otra
      información. Al facilitar esta información, das tu consentimiento para que tu
      información sea recopilada, utilizada, gestionada y almacenada por
      superadmin.es , sólo como se describe en el Aviso Legal y en la presente
      Política de Privacidad.</p>

      <ul><li>Formularios de contacto: El Titular solicita datos personales entre los que
        pueden estar: Nombre y apellidos, dirección de correo electrónico,
        número de teléfono y dirección de tu sitio Web con la finalidad de
        responder a tus consultas.
        Por ejemplo, el Titular utiliza esos datos para dar respuesta a tus
        mensajes, dudas, quejas, comentarios o inquietudes que puedas tener
        relativas a la información incluida en el sitio Web, los servicios que se
        prestan a través del sitio Web, el tratamiento de tus datos personales,
        cuestiones referentes a los textos legales incluidos en el sitio Web, así
        como cualquier otra consulta que puedas tener y que no esté sujeta a las
        condiciones del sitio Web o de la contratación.</li>

        <li> Formularios de suscripción a contenidos: El Titular solicita los siguientes
        datos personales: Nombre y apellidos, dirección de correo electrónico,
        número de teléfono y dirección de tu sitio web para gestionar la lista de
        suscripciones, enviar boletines, promociones y ofertas especiales.
        Los datos que facilites al Titular estarán ubicados en los servidores de
        The Rocket Science Group LLC d/b/a, con domicilio en EEUU.
        (Mailchimp).</li></ul>

        <h6>Existen otras finalidades por las que el Titular trata tus datos personales:</h6>

        <ul><li>Para garantizar el cumplimiento de las condiciones recogidas en el Aviso
        Legal y en la ley aplicable. Esto puede incluir el desarrollo de
        herramientas y algoritmos que ayuden a este sitio Web a garantizar la
        confidencialidad de los datos personales que recoge.</li>
        <li>Para apoyar y mejorar los servicios que ofrece este sitio Web.</li>
        <li>Para analizar la navegación. El Titular recoge otros datos no
        identificativos que se obtienen mediante el uso de cookies que se
        descargan en tu ordenador cuando navegas por el sitio Web cuyas
        caracterísiticas y finalidad están detalladas en la Política de Cookies.</li>
        <li>Para gestionar las redes sociales. el Titular tiene presencia en redes
        sociales. Si te haces seguidor en las redes sociales del Titular el
        tratamiento de los datos personales se regirá por este apartado, así
        como por aquellas condiciones de uso, políticas de privacidad y
        normativas de acceso que pertenezcan a la red social que proceda en
        cada caso y que has aceptado previamente.</li></ul>

        <h6>Puedes consultar las políticas de privacidad de las principales redes sociales en
        estos enlaces:</h6>

        <ul><li>Facebook</li>
          <li>Twitter</li>
          <li>YouTube</li>
          <li>Instagram</li></ul>

        <p>El Titular tratará tus datos personales con la finalidad de administrar
        correctamente su presencia en la red social, informarte de sus actividades,
        productos o servicios, así como para cualquier otra finalidad que las normativas
        de las redes sociales permitan.</p>

        <p>En ningún caso el Titular utilizará los perfiles de seguidores en redes sociales
        para enviar publicidad de manera individual.</p>

        <h5>Seguridad de los datos personales</h5>

        <p>Para proteger tus datos personales, el Titular toma todas las precauciones
        razonables y sigue las mejores prácticas de la industria para evitar su pérdida,
        mal uso, acceso indebido, divulgación, alteración o destrucción de los mismos.</p>

        <p>El sitio Web está alojado en este momento está en local. La
        seguridad de tus datos está garantizada, ya que toman todas las medidas de
        seguridad necesarias para ello. Puedes consultar su política de privacidad para
        tener más información.</p>

        <h5>Contenido de otros sitios web</h5>

        <p>Las páginas de este sitio Web pueden incluir contenido incrustado (por ejemplo,
        vídeos, imágenes, artículos, etc.). El contenido incrustado de otras web se
        comporta exactamente de la misma manera que si hubieras visitado la otra web.</p>

        <p>Estos sitios Web pueden recopilar datos sobre ti, utilizar cookies, incrustar un
        código de seguimiento adicional de terceros, y supervisar tu interacción usando
        este código.</p>

        <h5>Política de Cookies</h5>

        <p>Para que este sitio Web funcione correctamente necesita utilizar cookies, que es
        una información que se almacena en tu navegador web.</p>

        <p>En la página Política de Cookies puedes consultar toda la información relativa a
        la política de recogida, la finalidad y el tratamiento de las cookies.</p>

        <h5>Legitimación para el tratamiento de datos</h5>

        <p>La base legal para el tratamiento de tus datos es: el consentimiento.</p>

        <p>Para contactar con el Titular, suscribirte a un boletín o realizar comentarios en
        este sitio Web tienes que aceptar la presente Política de Privacidad.</p>
        
        <h5>Categorías de datos personales</h5>

        <h6>Las categorías de datos personales que trata el Titular son:</h6>

        <ul><li> Datos identificativos.</li></ul>

        <h5>Conservación de datos personales</h5>

        <p>Los datos personales que proporciones al Titular se conservarán hasta que
        solicites su supresión.</p>
        
        <h5>Destinatarios de datos personales</h5>

        <ul>
          <li>Mailrelay CPC Servicios Informáticos Aplicados a Nuevas Tecnologías
          S.L. (en adelante “CPC”) , con domicilio social en C/ Nardo, 12 28250 –
          Torrelodones – Madrid.
          Encontrarás más información en: https://mailrelay.com
          CPC trata los datos con la finalidad de prestar sus servicios de email el
          Titulareting al Titular.</li>

          <li>Mailchimp The Rocket Science Group LLC d/b/a , con domicilio en EEUU.
              Encontrarás más información en: https://mailchimp.com
              The Rocket Science Group LLC d/b/a trata los datos con la finalidad de
              prestar sus servicios de email el Titulareting al Titular.</li>

          <li>SendinBlue SendinBlue, sociedad por acciones simplificada (société par
          actions simplifiée) inscrita en el Registro Mercantil de París con el
          número 498 019 298, con domicilio social situado en 55 rue
          d’Amsterdam, 75008, París (Francia).
          Encontrarás más información en: https://es.sendinblue.com
          SendinBlue trata los datos con la finalidad de ofrecer soluciones para el
          envío de correos electrónicos, SMS transaccionales y de el Titulareting al
          Titular.</li>

          <li>Google Analytics es un servicio de analítica web prestado por Google,
            Inc., una compañía de Delaware cuya oficina principal está en 1600
            Amphitheatre Parkway, Mountain View (California), CA 94043, Estados
            Unidos (“Google”). Encontrarás más información
            en: https://analytics.google.com
            Google Analytics utiliza “cookies”, que son archivos de texto ubicados en
            tu ordenador, para ayudar al Titular a analizar el uso que hacen los
            usuarios del sitio Web. La información que genera la cookie acerca del
            uso del sitio Web (incluyendo tu dirección IP) será directamente
            transmitida y archivada por Google en los servidores de Estados Unidos.</li>

          <li>DoubleClick by Google es un conjunto de servicios publicitarios
          proporcionado por Google, Inc., una compañía de Delaware cuya oficina
          principal está en 1600 Amphitheatre Parkway, Mountain View (California),
          CA 94043, Estados Unidos (“Google”).
          Encontrarás más información en: https://www.doubleclickbygoogle.com
          DoubleClick utiliza “cookies”, que son archivos de texto ubicados en tu
          ordenador y que sirven para aumentar la relevancia de los anuncios
          relacionados con tus búsquedas recientes. En la Política de privacidad de
          Google se explica cómo Google gestiona tu privacidad en lo que respecta
          al uso de las cookies y otra información.</li>

        </ul>

        <p>También puedes ver una lista de los tipos de cookies que utiliza Google y sus
        colaboradores y toda la información relativa al uso que hacen de cookies
        publicitarias.</p>

        <h5>Navegación Web</h5>

        <p>Al navegar por localhost/index.php se pueden recoger datos no identificativos, que
        pueden incluir, la dirección IP, geolocalización, un registro de cómo se utilizan
        los servicios y sitios, hábitos de navegación y otros datos que no pueden ser
        utilizados para identificarte.</p>

        <h6>El sitio Web utiliza los siguientes servicios de análisis de terceros:</h6>

        <ul><li>Google Analytics</li>
        <li>DoubleClick por Google</li></ul>

        <p>El Titular utiliza la información obtenida para obtener datos estadísticos, analizar
        tendencias, administrar el sitio, estudiar patrones de navegación y para recopilar
        información demográfica.</p>
        
        <h5>Exactitud y veracidad de los datos personales</h5>

        <p>Te comprometes a que los datos facilitados al Titular sean correctos, completos,
        exactos y vigentes, así como a mantenerlos debidamente actualizados.</p>


        <p>Como Usuario del sitio Web eres el único responsable de la veracidad y
        corrección de los datos que remitas al sitio exonerando a el Titular de cualquier
        responsabilidad al respecto.</p>

        <h5>Aceptación y consentimiento</h5>

        <p>Como Usuario del sitio Web declaras haber sido informado de las condiciones
        sobre protección de datos de carácter personal, aceptas y consientes el
        tratamiento de los mismos por parte de el Titular en la forma y para las
        finalidades indicadas en esta Política de Privacidad.</p>

        <h5>Revocabilidad</h5>

        <p>Para ejercitar tus derechos de acceso, rectificación, cancelación, portabilidad y
        oposición tienes que enviar un correo electrónico a aagarcia2010@gmail.com junto con la prueba válida en derecho como una fotocopia del
        D.N.I. o equivalente.</p>

        <p>El ejercicio de tus derechos no incluye ningún dato que el Titular esté obligado a
        conservar con fines administrativos, legales o de seguridad.</p>

        <h5>Cambios en la Política de Privacidad</h5>

        <p>El Titular se reserva el derecho a modificar la presente Política de Privacidad
        para adaptarla a novedades legislativas o jurisprudenciales, así como a
        prácticas de la industria.</p>

        <p>Estas políticas estarán vigentes hasta que sean modificadas por otras
        debidamente publicadas.</p>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
      </div>
    </div>
  </div>
</div>";
 } 
?>