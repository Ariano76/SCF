<?php include("administrador/template/cabecera.php"); ?>

<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

//require_once './administrador/config/bd.php';
require_once './administrador/config/bdPDO.php';

$db_1 = new TransactionSCI();
//$conn_1 = $db_1->Connect();

//echo $insertId;

require_once ('./vendor/autoload.php');

if (isset($_POST["import"])) {
  $type = "OK";
  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $db_1->cotejo($timestamp1,$nombreUsuario);

  $usuarios = $db_1->resultado_cotejo($timestamp1);

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Users");
  $sheet->setCellValue("A1", "ID_BUSQUEDA");
  $sheet->setCellValue("B1", "Id_Cotejo");
  $sheet->setCellValue("C1", "Id_Caso");
  $sheet->setCellValue("D1", "Id_Resultado");
  $sheet->setCellValue("E1", "Tipo_Busqueda");
  $sheet->setCellValue("F1", "nombre_1");
  $sheet->setCellValue("G1", "nombre_2");
  $sheet->setCellValue("H1", "apellido_1");
  $sheet->setCellValue("I1", "apellido_2");
  $sheet->setCellValue("J1", "Tipo_Documento");
  $sheet->setCellValue("K1", "Numero_Documento");
  $sheet->setCellValue("L1", "Proyecto");
  $sheet->setCellValue("M1", "Cod_Familia");
  $i = 2;
  foreach($usuarios as $usuario) {
    $sheet->setCellValue("A".$i, $usuario[0]);
    $sheet->setCellValue("B".$i, $usuario[1]);
    $sheet->setCellValue("C".$i, $usuario[2]);
    $sheet->setCellValue("D".$i, $usuario[3]);
    $sheet->setCellValue("E".$i, $usuario[4]);
    $sheet->setCellValue("F".$i, $usuario[5]);
    $sheet->setCellValue("G".$i, $usuario[6]);
    $sheet->setCellValue("H".$i, $usuario[7]);
    $sheet->setCellValue("I".$i, $usuario[8]);
    $sheet->setCellValue("J".$i, $usuario[9]);
    $sheet->setCellValue("K".$i, $usuario[10]);
    $sheet->setCellValue("L".$i, $usuario[11]);
    $sheet->setCellValue("M".$i, $usuario[12]);
    $i++;
  }

  $db_1->delete_resultado_cotejo($timestamp1);
  
  $writer = new Xlsx($spreadsheet);
  $writer->save("Resultado Cotejar Usuarios en Data Historica_" . $timestamp1 . ".xlsx");
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
      <form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En este proceso se realiza el cotejo de datos de los nuevos beneficiarios que están en proceso de selección y se validará contra nuestra Base HIstorica, para determinar si en algún momento participaron en otros proyectos de apoyo social.</label>
          <br>
          <br>
          <label for="txtImagen">Este proceso tomará algunos minutos, dependiendo de la cantidad de registros a revisar, y posteriormente se genera un archivo Excel en el cual se mostraran los resultados del cotejo para su análisis.</label>
          <br>          
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Cotejar Beneficiarios</button>
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