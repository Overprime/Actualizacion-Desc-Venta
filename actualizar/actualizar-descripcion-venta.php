<?php  
include('../bd/conexion.php');

$CODIGO=$_REQUEST['codigo'];
$ADESCRI2=$_REQUEST['adescri2'];



$link=Conectarse();
$Sql="UPDATE [011BDCOMUN].DBO.MAEART  SET ADESCRI2='$ADESCRI2'
WHERE ACODIGO='$CODIGO' AND AESTADO='V' ";


$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{

header("Location: /overprime/compras/actualizacion-codigos/pages/actualizar-descripcion-venta?codigo=$CODIGO&mensaje=EL CÓDIGO SE ACTUALIZO  CORRECTAMENTE");

}



?>
