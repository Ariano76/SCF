<?php include("../administrador/template/cabecera.php"); ?>

<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require_once ('../administrador/config/bdPDO.php');

$db_1 = new TransactionSCI();
$contperiodos = 0;
$xperiodos = "";

require_once ('../vendor/autoload.php');

if (isset($_POST["import"])) {
  $type = "success";
  
  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $check = $_POST["flexRadioDefault"];
  $xper = $_POST["txtPeriodos"];

  $var = $db_1->migrar_data_gerencia($check, $xper);
  //echo "<script>console.log('entre al IF var: " . $var . "');</script>"; 
  if (!empty($var) && $var == 1) { 
      //echo "<script>console.log('entre al IF 1: " . $var . "');</script>"; 
    $type = "success";
    $message = "La migración se ha realizado con exito.";
  } else {
      //echo "<script>console.log('entre al IF 2: " . $var . "');</script>"; 
    $type = "error";
    $message = "Se presentarón problemas al momento de la migración. Intente de nuevo";           
  }       

}
?>

<div class="col-md-12">
  <div class="card text-dark bg-light">
    <div class="card-header">
      Migrar datos de JETPERU
    </div>
    <div class="card-body">
      <form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">Este proceso realiza la migración de datos de los proyectos del ambiente Stage a la tabla de Resultados de Proyectos.</label>
          <br>
        </div>        
        <br>

        <br>
        
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Migrar Datos</button>
        </div>

      </form>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class=card-text>
    <div class="<?php if(!empty($type)){ echo $type . " alert alert-success role=alert"; } ?>
    <?php if(!empty($message1) && $_SESSION['validaciongerencia'] == 0){ echo "error alert alert-success role=alert"; } ?>
    ">
    <?php if(!empty($var)) { echo $message; } 
    if(!empty($message1) && $_SESSION['validaciongerencia'] == 1 ) { echo $message1; } 
    ?>
  </div>
</div>
</div>

<?php include("../administrador/template/pie.php"); ?>