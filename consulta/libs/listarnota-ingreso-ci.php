<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<?php
//VARIABLES DE SESION 
//session_start();
//$IDUSUARIO=$_SESSION['id_usuario'];	
//$COD_SOLICITANTE=$_SESSION['starsoft'];
//echo "$COD_SOLICITANTE";
?>
</head>
<body>

<div class="container">


<div class="row clearfix">

<div class="col-md-12 column">

<div class="table-responsive">


<script type="text/javascript" language="javascript" src="js/jslistadonota-ingreso-ci.js"></script>

<table class="table table-bordered table-condensed" id="tabla_lista_nota-ingreso-ci">
<thead>
<tr class="success">
<th width="">NRO. DE DOCUMENTO</th>
<th width="">TIPO DE  MOV.</th>
<th width="">O/F. DE REFERENCIA</th>
<th width="">O/F.</th>
<th width="">DOC. DE REFER.</th>
<th width="">FECHA</th>
<th>ESTADO</th>
<th><i class="glyphicon glyphicon-edit text-primary"></i></th>
</tr>
<?php require_once('../../bd/conexion.php');
$link=  Conectarse();
$listado=  mssql_query("SELECT  DENUMDOC,DEORDFAB,CAORDFAB,(CARFTDOC+'-'+CARFNDOC)AS DOC_REF,CACODMOV,CONVERT(VARCHAR,CAFECDOC,105)AS FECHA ,
CASE WHEN RTRIM(CAORDFAB)= '' THEN 'SIN O/F'
 eLSE ISNULL(CAORDFAB , 'SIN O/F') END ORFAB FROM [015BDCOMUN].DBO.MOVALMDET AS MD INNER JOIN [015BDCOMUN].DBO.MOVALMCAB AS MC ON
MD.DENUMDOC=MC.CANUMDOC WHERE
DECODMOV='CI' AND DETD='NI' AND DEALMA='01'  AND DEORDFAB IS NOT NULL
AND RTRIM(DEORDFAB)<>' ' /* AND DEORDFAB='AEC-0049'*/ AND CAALMA='01' AND CATD='NI' AND CATIPMOV='I' AND CASITGUI='V'
GROUP BY DENUMDOC,DEORDFAB,CAORDFAB,CARFTDOC,CARFNDOC,CACODMOV,CAFECDOC

 ",$link);
?>

<tbody>
<?php
while($reg=  mssql_fetch_array($listado)) 
{
?>
<tr class="active">

<td><?php echo utf8_encode($reg[DENUMDOC]); ?></td>
<td><?php echo utf8_encode($reg[CACODMOV]); ?></td>
<td><?php echo utf8_encode($reg[DEORDFAB]); ?></td>
<td><?php echo utf8_encode($reg[ORFAB]); ?></td>
<td><?php echo utf8_encode($reg[DOC_REF]); ?></td>
<td><?php echo utf8_encode($reg[FECHA]); ?></td>
<td><?php 
if ($reg[ORFAB]=='SIN O/F') {
	echo "<label class='text-danger'>PENDIENTE</label>";
}
else{
echo "<label class='text-primary'>ATENDIDO</label>";


}


 ?></td>
 <td><a href="../pages/nota-ingreso-ci?numero=<?php echo $reg[DENUMDOC]; ?>&
 of=<?php echo $reg[DEORDFAB]; ?> & v=<?php echo $reg[ORFAB]; ?>"> <i class="glyphicon glyphicon-edit"></i> </a></td>
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
<h4 class="modal-title" id="myModalLabel">
Modal title
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
ot=<?php echo $row[OT]; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
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