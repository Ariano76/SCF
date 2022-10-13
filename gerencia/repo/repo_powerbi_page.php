<?php include("../../administrador/template/cabecera.php"); ?>

<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require_once '../../administrador/config/bdPDO.php';

?>

<div class="col-md-12">

  <div class="card text-dark bg-light">
    <div class="card-header">
      REPORTE PARA ALIMENTAR DASHBOARD POWER BI
    </div>
    <div class="card-body">
      <form action="repo_powerbi.php" method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En este apartado podremos generar el reporte con la informacion de los  beneficiarios necesaria para actualizar el dashboard en Power BI.</label>
          <br>
          <br>          
        </div>
        
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Generar Reporte data Power BI</button>
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

<?php include("../../administrador/template/pie.php"); ?>