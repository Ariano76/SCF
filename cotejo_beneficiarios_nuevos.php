<?php include("administrador/template/cabecera.php"); ?>

<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

//require_once './administrador/config/bd.php';
require_once './administrador/config/bdPDO.php';

$db_1 = new TransactionSCI();

require_once ('./vendor/autoload.php');

if (isset($_POST["import"])) {
  $type = "OK";
  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $var=true;

  if (!empty($var)) {        
    $type = "success";
    $message = "Datos se importaron al archivo : Resultado Cotejar Usuarios en Data Historica_" . $timestamp1 . ".xlsx";
  } else {
    $type = "error";
    $message = "Problemas al importar los datos de Excel. Intente de nuevo";
  }
}

?>

<div class="col-md-12">

  <div class="card text-dark bg-light">
    <div class="card-header">
      Cotejar nuevos beneficiarios en Base de Datos Historica
    </div>
    <div class="card-body">
      <form action="cotejo_beneficiarios_nuevos_001.php" method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En este proceso se realiza el cotejo de datos de los nuevos beneficiarios que están en proceso de selección y se validará contra nuestra Base Histórica, para determinar si en algún momento participaron en otros proyectos de apoyo social.</label>
          <br>
          <br>
          <label for="txtImagen">Este proceso tomará algunos minutos, dependiendo de la cantidad de registros a revisar, y posteriormente se genera un archivo Excel en el cual se mostraran los resultados del cotejo para su análisis.</label>
          <br>          
        </div>
        <br>
        <input type="hidden" name="txtUsuario" value="<?php echo $nombreUsuario;?>" />
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Cotejar Nuevos Beneficiarios</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class=card-text>
    <div class="<?php if(!empty($type)) { echo $type . " alert alert-success role=alert"; } ?>"><?php if(!empty($var)) { echo $message; } ?>
  </div>
</div>
</div>

<?php include("administrador/template/pie.php"); ?>