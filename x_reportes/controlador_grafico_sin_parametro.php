<?php
	require_once ('../administrador/config/bdPDO.php');
	$situacion = $_POST['dato_situacion'];	
	$sp = $_POST['dato_sp'];
	$MG = new TransactionSCI();
	$consulta = $MG -> traer_datos_reporte_sin_parametro($sp, $situacion);
	echo json_encode($consulta);

?>