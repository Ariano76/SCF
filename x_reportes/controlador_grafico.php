<?php
	require_once ('../administrador/config/bdPDO.php');
	$MG = new TransactionSCI();
	$consulta = $MG -> traer_datos_reporte();
	echo json_encode($consulta);

?>