
<?php
//Proceso de conexion con la base de datos
include('bd/conexion.php');
$link=Conectarse();

//Iniciar Sesion
session_start();

//Validar si se esta ingresando con sesion correctamente
if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "/overprime/compras/actualizacion-codigos/"
</script>';
}

$id_usuario = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>.:MODULO DE RESERVA:.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">


<link href="/overprime/compras/actualizacion-codigos/css/bootstrap.min.css" rel="stylesheet">
<link href="/overprime/compras/actualizacion-codigos/css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="/overprime/compras/actualizacion-codigos/img/favicon.ico">
<script type="text/javascript" src="/overprime/compras/actualizacion-codigos/js/jquery.min.js"></script>
<script type="text/javascript" src="/overprime/compras/actualizacion-codigos/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/overprime/compras/actualizacion-codigos/js/scripts.js"></script>
<!-- Inicio Script convertir en mayuscula al ingresar -->
<script language    =""="JavaScript">
function conMayusculas(field) {
field.value         = field.value.toUpperCase()
}
</script>
<!-- Fin Script convertir en mayuscula al ingresar-->
</head>

<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<nav class="navbar navbar-default" role="navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse"
 data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">
 Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar">
 	
 </span><span class="icon-bar"></span></button> <a class="navbar-brand" href="/overprime/compras/actualizacion-codigos/home">Inicio</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">

<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">PROCESOS<strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
<a href="/overprime/compras/actualizacion-codigos/pages/actualizar-descripcion-venta">Actualizacion de Códigos</a>
</li>
</ul>
</li>
</ul>

<ul class="nav navbar-nav navbar-right">
<li>
<a href="#"><i class="glyphicon glyphicon-user text-success"></i>
<?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?></a>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong class="caret"></strong></a>
<ul class="dropdown-menu">
<li>
<a href="/overprime/compras/actualizacion-codigos/adios">Salir</a>
</li>




</ul>
</li>
</ul>
</div>

</nav>
</div>
</div>
</div>
</body>



</html>
