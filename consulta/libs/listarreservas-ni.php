<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<?php
//VARIABLES DE SESION 
session_start();
$IDUSUARIO=$_SESSION['id_usuario'];	
$COD_SOLICITANTE=$_SESSION['starsoft'];
//echo "$COD_SOLICITANTE";
?>
</head>
<body>

<div class="container">
<!-- 

<div class="row clearfix">
<div class="col-md-12 column">
<a id="modal-221645" href="#modal-container-221645" 
role="button" class="btn btn-primary" data-toggle="modal">REGISTRAR RESERVA</a>
</div>
</div> -->



<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadoreservas-ni.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_reservas-ni">
<thead>
<tr class="success">
<th width="20">NRO. RESERVA</th>
<th width="20">SOLICITANTE</th>
<th width="20">OT</th>
<th width="40">EDITAR O CONSULTAR</th>
</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT CRV.NRORESERVA,CRV.OT,T.TDESCRI,CRV.USUARIO,T.TCLAVE FROM [020BDCOMUN].DBO.RESERVA_CAB AS CRV
INNER JOIN [015BDCOMUN].DBO.TABAYU AS T ON CRV.SOLICITANTE=T.TCLAVE WHERE TCOD='12' AND 
CRV.ESTADO='02' /*AND CRV.USUARIO='$IDUSUARIO'*/
ORDER BY CRV.NRORESERVA DESC ",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr class="active">

<td><?php echo utf8_encode($reg[NRORESERVA]); ?></td>
<td><?php echo utf8_encode($reg[TDESCRI]); ?></td>
<td><?php echo utf8_encode($reg[OT]); ?></td>
<td><?php 	
if ($reg[TCLAVE]==$COD_SOLICITANTE) {
echo "

<a href='../pages/editar-reserva-ni?reserva=$reg[NRORESERVA]'>
<i class='glyphicon glyphicon-edit'></i></a>";
}
else{

echo "
<a href='../pages/consultar-reservas-ni?reserva=$reg[NRORESERVA]'>
<i class='glyphicon glyphicon-edit text-danger'></i></a></td>";
}


?></td>










</tr>
<?php
}
?>
</tbody>
</table>

</div>

</div>
</div>

</div>

</body>
<?php 

/*Realizamos la consulta para  generar el 
codigoautomatico*/

$link=Conectarse();
$sql="SELECT CTNNUMERO FROM [020BDCOMUN].DBO.NUM_DOCCOMPRAS WHERE CTNCODIGO='RV' ";
$result       =mssql_query($sql,$link);
if ($row      =mssql_fetch_array($result)) {
mssql_field_seek($result,0);
while ($field =mssql_fetch_field($result)) {

}do {

$IDRESERVA=$row[0];

} while ($row =mssql_fetch_array($result));

}else { 

} 

$ReservaActual=$IDRESERVA+1;
?>
<!-- INICIO MODAL REGISTRAR -->
<div class="modal fade" id="modal-container-221645" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary" id="myModalLabel">
CREAR RESERVA
</h4>
</div>
<form action="../registrar/crear-reserva.php" method="POST">
<div class="modal-body">
<label for="">NÚMERO DE RESERVA:</label>
<input type="text" name="numeroreserva" class="form-control" 
value="<?php echo 	$ReservaActual; ?>" readonly>
<label for="">SOLICITANTE:</label>
<select name="solicitante" class="form-control" readonly>
<?php
$link=Conectarse();
$Sql="SELECT TCLAVE,TDESCRI FROM [015BDCOMUN].dbo.TABAYU 
WHERE TCOD='12' AND TCLAVE='$COD_SOLICITANTE' ORDER BY TDESCRI";
$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option value ="<?php echo $row['TCLAVE']?>"><?php echo utf8_encode($row['TDESCRI'])?></option>
<?php }?>
</select>
<label for="">ORDEN DE FABRICACIÓN:</label>
<select name="ot" class="form-control" required>
<option value="">Seleccione la O/T...</option>
<?php
$link=Conectarse();
$Sql ="SELECT CODIGOOT FROM [020BDCOMUN].dbo.CENCOSOT
GROUP BY CODIGOOT ORDER BY CODIGOOT ";

$result=mssql_query($Sql) or die(mssql_error());
while ($row=mssql_fetch_array($result)) {
?>
<option class="text-primary" value="<?php echo $row['CODIGOOT']?>">
<?php echo $row['CODIGOOT']?></option>
<?php }?>
</select>

<input type="hidden" name="usuario"value="<?php echo $IDUSUARIO; ?>">
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">GRABAR</button>
<button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button> 
</form>
</div>
</div>

</div>

</div>

<!-- FIN MODAL REGISTRAR -->



</html>