<?php  
//Iniciar Sesion
session_start();
$IDUSUARIO = $_SESSION['id_usuario'];
include('../bd/conexion.php');

$CODIGOACTUAL=$_REQUEST['codigoactual'];
$CODIGONUEVO=$_REQUEST['codigonuevo'];
$CANTIDADNUEVA=$_REQUEST['cantidadnueva'];
$CANTIDADACTUAL=$_REQUEST['cantidadactual'];

$link=Conectarse();
$Sql="UPDATE [020BDCOMUN].DBO.DATOS_RSV SET CANTIDAD='$CANTIDADNUEVA',CODIGO='$CODIGONUEVO'
WHERE CODIGO='$CODIGOACTUAL' AND CANTIDAD='$CANTIDADACTUAL' AND  USUARIO='$IDUSUARIO'";


$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{

?>
<script>

window.location = "/overprime/compras/actualizacion-codigos//archivo/pages/consulta"
</script>

<?php

}



?>
