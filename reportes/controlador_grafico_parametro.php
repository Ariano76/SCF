<?php
	require_once ('../administrador/config/bdPDO.php');
	$region = $_POST['dato_region'];
	$situacion = $_POST['dato_situacion'];
	$sp = $_POST['dato_sp'];
	$MG = new TransactionSCI();
	$consulta = $MG -> traer_datos_reporte_parametro($sp, $region, $situacion);
	echo json_encode($consulta);

?>