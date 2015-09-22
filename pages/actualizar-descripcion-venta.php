<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Actualizacion Descripción Venta</title>
<?php include('../header.php'); ?>
<?php //variables:
$CODIGO=$_REQUEST['codigo'];	 
$MENSAJE=$_REQUEST['mensaje'];	?>

<?php 

/*VALIDAMOS EL STOCK DEL ARTICULO*/

$link=Conectarse();
$sql="SELECT ACODIGO,ADESCRI,ADESCRI2 FROM [011BDCOMUN].DBO.MAEART AS M 
INNER JOIN [011BDCOMUN].DBO.STKART AS S ON M.ACODIGO=S.STCODIGO
WHERE ACODIGO='$CODIGO' AND AESTADO='V' AND STALMA='01'
";
$result       =mssql_query($sql,$link);
if ($row      =mssql_fetch_array($result)) {
mssql_field_seek($result,0);
while ($field =mssql_fetch_field($result)) {

}do {
/*Almacenamos los  datos en variables*/

$Codigo          =$row[0];
$Descripcion  =utf8_encode($row[1]);
$Descripcion2       =$row[2];
} while ($row =mssql_fetch_array($result));

}else { 
?>

<?php 
} 

?>


</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-6 column">
<form role="form" method="POST" action="actualizar-descripcion-venta" 
autocomplete='Off'>
<div class="form-group">
<label class="text-success"><?php echo $MENSAJE; ?></label>  </br>
<label >CÓDIGO</label>
<input type="text" name="codigo"class="form-control" placeholder="INGRESAR EL CODIGO Y PRESIONAR ENTER" 
value="<?php echo $CODIGO;	 ?> " autofocus required/>
</form>
</div>
<form action="../actualizar/actualizar-descripcion-venta.php" method="POST" autocomplete="Off">
<div class="form-group">
<input type="hidden" name="codigo" value="<?php echo $CODIGO;?> ">
<label >DESCRIPCIÓN </label>
<input type="text" class="form-control" value="<?php echo $Descripcion;	 ?> " readonly/>
</div>
<div class="form-group">
<label >DESCRIPCIÓN DE VENTA</label>
<input type="text" class="form-control"  name="adescri2" 
value="<?php echo $Descripcion2; ?> " onchange="conMayusculas(this);"   required/>
</div>
<a id="modal-891271" href="#modal-container-891271"
role="button" class="btn btn-lg btn-primary" data-toggle="modal">ACTUALIZAR</a>


</div>
</div>
</div>


<!-- 	 -->

<div class="modal fade" id="modal-container-891271" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-success" id="myModalLabel">
CONFIRMACIÓN
</h4>
</div>
<div class="modal-body">
¿ESTA SEGURO DE ACTUALIZAR EL CÓDIGO <b class="text-success"><?php echo $CODIGO; ?> </b>CON LA INFORMACIÓN
INGRESADA?
</div>
<div class="modal-footer">

<button type="submit" class="btn btn-primary">SI</button>
<button type="button" class="btn btn-default" data-dismiss="modal">NO</button> 

</form>
</div>
</div>

</div>

</div>

<!-- 	 -->
</body>
</html>