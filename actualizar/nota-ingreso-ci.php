<?php  
include('../bd/conexion.php');




$DOCUMENTO=$_REQUEST['documento'];
$OF=$_REQUEST['of'];

$link           =Conectarse();

$Sql="UPDATE [015BDCOMUN].DBO.MOVALMCAB SET CAORDFAB='$OF'
WHERE CANUMDOC='$DOCUMENTO' AND CATD='NI' AND CATIPMOV='I' 
AND CACODMOV='CI' AND CAALMA='01'";


$result         =mssql_query($Sql);

if (!$result){echo "Error al guardar";}
else{

?>

<script> alert('El documento <?php echo $DOCUMENTO; ?> fue actualizado');</script>
<script>

window.location = "/overprime/compras/actualizacion-codigos//consulta/nota-ingreso-ci"

</script>

<?php

}



?>
