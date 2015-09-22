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

<div class="row clearfix">
<div class="col-md-12 column">
<a id="modal-90561" href="#modal-container-90561"
role="button" class="btn btn-primary" data-toggle="modal">CREAR REQUERIMIENTO</a>
</div>
</div>
<p>  <!-- LINEA DE SEPARACION ENTRE BOTON Y TABLA -->  </p>


<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadorq-materiales.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_rq-materiales">
<thead>
<tr class="success">
<th width="">NRO. DE REQUERIMIENTO</th>
<th width="">SOLICITANTE</th>
<th width="">FECHA DE EMISION</th>
<th width="">FECHA DE AUTORIZACIÓN</th>
<th width="">ESTADO</th>
<th><i class="glyphicon glyphicon-edit text-primary"></i></th>
</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT REQ_NUMERO,CONVERT(VARCHAR,REQ_FECHA_EMISION,105)AS FECHAE,CONVERT(VARCHAR,REQ_FECHA_AUTORI,105)AS FECHAA,
CASE REQ_ESTADO
WHEN  00 THEN 'EMITIDA'
WHEN  01 THEN 'APROBADA'
WHEN  03 THEN 'REC.PARCIAL'
WHEN  04 THEN 'REC.TOTAL'
WHEN  05 THEN 'LIQUIDADA'
WHEN  06 THEN 'ANULADA'
END  AS ESTADO,
T.TDESCRI,
CENCOST_CODIGO FROM [015BDCOMUN].dbo.INV_REQMATERIAL_CAB  AS C 
INNER JOIN [015BDCOMUN].DBO.TABAYU AS T ON C.REQ_PERSONAL_SOLIC=T.TCLAVE WHERE TCOD='12'  ",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr class="active">

<td><?php echo utf8_encode($reg[REQ_NUMERO]); ?></td>
<td><?php echo utf8_encode($reg[TDESCRI]); ?></td>
<td><?php echo utf8_encode($reg[FECHAE]); ?></td>
<td><?php echo utf8_encode($reg[FECHAA]); ?></td>
<td><?php echo utf8_encode($reg[ESTADO]); ?></td>
<td><a href="../pages/reporte-requerimiento?id=<?php echo $reg[REQ_NUMERO]; ?>" 
 target="_blank"><i class="glyphicon glyphicon-edit text-primary"></i></a></td>
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
<div class="modal fade" id="modal-container-90561" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-primary" id="myModalLabel">
MIS RESERVAS CREADAS
</h4>
</div>
<div class="modal-body">
<div class="container">
<div class="row clearfix">
<div class="col-md-5 column">
<div class="table-responsive">

<table class="table table-bordered table-condensed">		
<thead>	
<tr class="success">	
<th>ID RESERVA</th>
<th>SOLICITANTE</th>
<th>O/T</th>
<th><i class="glyphicon glyphicon-edit"></i></th>
</tr>
</thead>

<?php 
//variable sesion usuario solicitante
$usuario=$_SESSION['id_usuario'];
$solicitante=$_SESSION['starsoft'];
$link=Conectarse();
$sql="SELECT CRV.NRORESERVA,CRV.OT,T.TDESCRI,CRV.USUARIO FROM [020BDCOMUN].DBO.RESERVA_CAB AS CRV
INNER JOIN [015BDCOMUN].DBO.TABAYU AS T ON CRV.SOLICITANTE=T.TCLAVE WHERE TCOD='12' AND 
CRV.ESTADO='00' AND CRV.USUARIO='$IDUSUARIO' AND 
CRV.NRORESERVA IN (SELECT NRORESERVA FROM [020BDCOMUN].DBO.RESERVA_DET)
ORDER BY CRV.NRORESERVA DESC

";
$result= mssql_query($sql) or die(mssql_error());
if(mssql_num_rows($result)==0) die("******NO HAY RESERVAS DISPONIBLES ACTUALMENTE****");
while($row=mssql_fetch_array($result))
{
?>
<tbody>	
<tr>			
<td><?php echo $row[NRORESERVA]; ?></td>
<td><?php echo $row[TDESCRI]; ?></td>
<td><?php echo $row[OT]; ?></td>
<td><a href="../pages/requerimiento?reserva=<?php echo $row[NRORESERVA]; ?>&
ot=<?php echo $row[OT]; ?>" ><i class="glyphicon glyphicon-edit"></i></a></td>
</tr>
<?php 
}?>
</tr>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
</div>
</div>

</div>

</div>

<!-- FIN MODAL REGISTRAR -->



</html>