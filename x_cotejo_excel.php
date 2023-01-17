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
      Validar registros en el mismo documento
    </div>
    <div class="card-body">
      <form action="cotejo_excel_001.php" method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En este proceso se realiza una primera verificación de los datos del documento que hemos cargado para encontrar posibles casos de duplicidad entre los registros existentes. </label>
          <br>
          <br>
          <label for="txtImagen">Este proceso tomará algunos segundos, dependiendo de la cantidad de registros a revisar, y posteriormente se genera un archivo Excel en el cual se mostraran los resultados del cotejo para su análisis.</label>
          <br>          
        </div>
        <br>
        <input type="hidden" name="txtUsuario" value="<?php echo $nombreUsuario;?>" />
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Validar registros</button>
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