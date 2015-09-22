	<!DOCTYPE html>
	<html lang="es">
	<head>
	<meta charset="UTF-8">
	<title>Detalle</title>
	<?php  include('../../headerconsulta.php'); 
	include('../bd/conexion.php');
	?>
	<?php 
	/*variables recibidad por post*/
	$Codigo=$_REQUEST['codigo'];
	$Descripcion=$_REQUEST['descripcion'];
	$Cantidad=$_REQUEST['cantidad'];
	$Total=$_REQUEST['total'];
	?>
	</head>
	<body>
	<div class="container">
	
	<div class="row clearfix">
	
	<div class="col-md-3 column">
	<label for="">CÓDIGO:</label>
	<input type="text" class="form-control" value="<?php echo $Codigo; ?>" readonly>	
	</div>
	<div class="col-md-6 column">
	<label for="">DESCRIPCIÓN:</label>
	<input type="" class="form-control" value="<?php echo $Descripcion; ?>" readonly>
	</div>
	<div class="col-md-2 column">
	<label for="">STOCK DISPONIBLE:</label>
	<input type="" class="form-control" value="<?php echo $Cantidad; ?>" readonly>
	</div>
	</div>
	
	<div class="row clearfix">
	<br>
	<div class="col-md-12 column">
	<label for="">CANTIDAD PENDIENTE:</label>
	<label for=""><h3 class="text-danger"><?php echo $Total; ?></h3></label>
	<div class="table-responsive">
	<table class="table table-bordered table-condensed">
	<thead>
	<tr class="active">
	<th>NRO. RESERVA</th>
	<th>CANT. SOL.</th>
	<th>CANT. ATEND.</th>
	<th>SALDO</th>
	<th>SOLICITANTE</th>
	<th>OT</th>
	<th>ESTADO</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$link=Conectarse();
	$sql="SELECT D.NRORESERVA,D.CANTIDAD,T.TDESCRI,C.OT,D.CANT_PEND,
	(CASE C.ESTADO
	WHEN '00' THEN 'PENDIENTE'
	WHEN '01' THEN 'ATENDIDA'
	WHEN '02' THEN 'PENDIENTE NI'
	WHEN '03' THEN 'ANULADA'
	END)AS ESTADOS
	FROM [020BDCOMUN].DBO.RESERVA_DET AS D INNER JOIN 
	[020BDCOMUN].DBO.RESERVA_CAB AS C ON D.NRORESERVA=C.NRORESERVA 
	INNER JOIN [015BDCOMUN].DBO.TABAYU AS T ON C.SOLICITANTE=T.TCLAVE 
	WHERE  D.CODIGO='$Codigo'  AND TCOD='12'
	";    
	$result= mssql_query($sql) or die(mssql_error());
	if(mssql_num_rows($result)==0) die("*********************ARTICULO NO RESERVADO********************");
	while ($filas=mssql_fetch_array($result))
	{
	?>
	<tr class="success">
	<td><?php echo $filas['NRORESERVA']; ?></td>
	<td><?php echo $filas['CANTIDAD']; ?></td>
	<td><?php echo $filas['CANTIDAD']-$filas['CANT_PEND']; ?></td>
	<td><?php echo $filas['CANT_PEND']; ?></td>
	<td><?php echo utf8_encode($filas['TDESCRI']) ?></td>
	<td><?php echo utf8_encode($filas['OT']) ?></td>
	<td><?php echo utf8_encode($filas['ESTADOS']) ?></td>
	</tr>
	
	<?php
	}
	?>
	<tbody>
	
	</table>
	</div>
	
	</div>
	
	</div>
	
	</div>
	</body>
	</html>
	
	
