<?php  
include('../bd/conexion.php');

$link=Conectarse();
$Sql="UPDATE [020BDCOMUN].DBO.RESERVA_DET SET 
CANT_PEND=RD.CANTIDAD-D.REQ_CANTIDAD_DESPACHADA
FROM [015BDCOMUN].DBO.INV_REQMATERIAL_CAB AS C 
INNER JOIN [015BDCOMUN].DBO.INV_REQMATERIAL_DET AS D ON
C.REQ_NUMERO=D.REQ_NUMERO  INNER JOIN [020BDCOMUN].DBO.RESERVA_DET  AS RD
ON D.ACODIGO=RD.CODIGO AND C.REQ_NUMERO=RD.REQUERIMIENTO
";


$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{

?>
<script>alert('RECALCULO CORRECTO');</script>
<script>

window.location = "/overprime/compras/actualizacion-codigos/home"
</script>

<?php

}



?>
