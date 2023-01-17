<?php include("administrador/template/cabecera.php"); ?>

<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once './administrador/config/bd.php';
require_once './administrador/config/bdPDO.php';
$db = new DataSource();
$conn = $db->getConnection();

$db_1 = new TransactionSCI();
$conn_1 = $db_1->Connect();

//echo $insertId;

require_once ('./vendor/autoload.php');

if (isset($_POST["import"])) {
  //limpiar tabla stage    
  $allowedFileType = [
    'application/vnd.ms-excel', 'text/xls', 'text/xlsx',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  ];

  if (in_array($_FILES["file"]["type"], $allowedFileType)) {

    $targetPath = 'uploads/' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

    $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

    $spreadSheet = $Reader->load($targetPath);
    $excelSheet = $spreadSheet->getActiveSheet();
    $spreadSheetAry = $excelSheet->toArray();
    $sheetCount = count($spreadSheetAry);

    $insertId = $db_1->limpiarStage("SP_LimpiarTablaStageDataHistorica",$nombreUsuario);
    $conta=0;
    $continuar=1;
    //for ($i = 0; $i <= $sheetCount; $i ++) {
    //  PROCESO PARA VALIDAR SI LOS DATOS ESTAN COMPLETOS
    for ($i = 1; $i < $sheetCount; $i ++) {
      $dato_01 = '';
      $dato_02 = '';
      if (isset($spreadSheetAry[$i][13])) {
        $dato_01  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]); 
      }
      if (isset($spreadSheetAry[$i][14])) {
        $dato_02  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][14]); 
      }

      if (strlen($dato_01)>0 && strlen($dato_02)>3 ) {
        $type = "success";
        $message = "Todos los datos estan completos.";
      } else {
        $type = "error";
        $message = "Existen campos con valores incorrectos. Actualice y vuelva a subir el archivo. Error en el codigo " .$dato_01 ;
        $continuar=0;
        break;
      }       
    }

  //  PROCESO PARA ACTUALIZAR LAS OBSERVACIONES EN LA BD
    if ($continuar==1) {
      for ($i = 1; $i < $sheetCount; $i ++) {
        $dato_01 = "";
        $dato_02 = "";

        if (isset($spreadSheetAry[$i][13])) {
          $dato_01  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]); 
        }
        if (isset($spreadSheetAry[$i][14])) {
          $dato_02  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][14]); 
        }

        //$query = "update stage_00 set dato_144 = ?, dato_143=2 where id_stage = ?";
        //$paramType = "ss";
        //$paramArray = array($dato_02, $dato_01);
      //$insertId = $db->insert($query, $paramType, $paramArray);
        $insertId = $db_1->update_observaciones($dato_01, $dato_02);
        if ($insertId > 0) {        
          $type = "success";
          $message = "Todos los datos se almacenarón correctamente. <br /> El ultimo paso será ejecutar la migración de datos. NO TE OLVIDES!";
        } else {
          $type = "error";
          $message = "Problemas al guardar los datos. Intente de nuevo. Error en el codigo " .$dato_01 ;
          break;
        }
      }          
    }


  } else {
    $type = "error";
    $message = "El tipo de archivo seleccionado es invalido. Solo puede subir archivos de Excel.";
  }
}
?>

<div class="col-md-12">

  <div class="card text-dark bg-light">
    <div class="card-header">
      Subir observaciones registradas
    </div>
    <div class="card-body">
      <form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">Seleccione el archivo Excel a cargar:</label>
          <br>
          <br>
          <input type="file" class="form-control" name="file" id="file" accept=".xls,.xlsx"> 
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Importar observaciones</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class=card-text>
    <div class="<?php if(!empty($type)) { echo $type . " alert alert-success role=alert"; } ?>"><?php if(!empty($message)) { echo $message; } ?>
  </div>
</div>
</div>

<?php include("administrador/template/pie.php"); ?>