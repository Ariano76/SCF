<?php include("../administrador/template/cabecera.php"); ?>

<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once '../administrador/config/bd.php';
require_once '../administrador/config/bdPDO.php';
$db = new DataSource();
$conn = $db->getConnection();

$db_1 = new TransactionSCI();
$conn_1 = $db_1->Connect();

//echo $insertId;

require_once ('../vendor/autoload.php');

if (isset($_POST["import"])) {

    //limpiar tabla stage
    

  $allowedFileType = [
    'application/vnd.ms-excel', 'text/xls', 'text/xlsx',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  ];

  if (in_array($_FILES["file"]["type"], $allowedFileType)) {

    $targetPath = '../uploads/' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

    $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

    $spreadSheet = $Reader->load($targetPath);
    $excelSheet = $spreadSheet->getActiveSheet();
    $spreadSheetAry = $excelSheet->toArray();
    $sheetCount = count($spreadSheetAry);

    $insertId = $db_1->ejecutarstoredprocedure("SP_limpiar_stage_gastos");
    $conta=0;
    //for ($i = 0; $i <= $sheetCount; $i ++) {
    for ($i = 1; $i < $sheetCount; $i ++) {
        $dato_01 = "";
        if (isset($spreadSheetAry[$i][0])) {
            $dato_01  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]); }
        $dato_02 = "";
        if (isset($spreadSheetAry[$i][1])) {
            $dato_02  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]); }
        $dato_03 = "";
        if (isset($spreadSheetAry[$i][2])) {
            $dato_03  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]); }
        $dato_04 = "";
        if (isset($spreadSheetAry[$i][3])) {
            $dato_04  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]); }
        $dato_05 = "";
        if (isset($spreadSheetAry[$i][4])) {
            $dato_05  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]); }
        $dato_06 = "";
        if (isset($spreadSheetAry[$i][5])) {
            $dato_06  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]); }
        $dato_07 = "";
        if (isset($spreadSheetAry[$i][6])) {
            $dato_07  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]); }
        $dato_08 = "";
        if (isset($spreadSheetAry[$i][7])) {
            $dato_08  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]); }
        $dato_09 = "";
        if (isset($spreadSheetAry[$i][8])) {
            $dato_09  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]); }
        $dato_10 = "";
        if (isset($spreadSheetAry[$i][9])) {
            $dato_10  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]); }
        $dato_11 = "";
        if (isset($spreadSheetAry[$i][10])) {
            $dato_11  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]); }
        $dato_12 = "";
        if (isset($spreadSheetAry[$i][11])) {
            $dato_12  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]); }
        $dato_13 = "";
        if (isset($spreadSheetAry[$i][12])) {
            $dato_13  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][12]); }
        $dato_14 = "";
        if (isset($spreadSheetAry[$i][13])) {
            $dato_14  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]); }
        $dato_15 = "";
        if (isset($spreadSheetAry[$i][14])) {
            $dato_15  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][14]); }
        $dato_16 = "";
        if (isset($spreadSheetAry[$i][15])) {
            $dato_16  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][15]); }
        $dato_17 = "";
        if (isset($spreadSheetAry[$i][16])) {
            $dato_17  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][16]); }

      if ( !empty($dato_01) || ! empty($dato_02) || ! empty($dato_03) || ! empty($dato_04) || ! empty($dato_05) || ! empty($dato_06) || ! empty($dato_07) || ! empty($dato_08) || ! empty($dato_09) || ! empty($dato_10) || ! empty($dato_11) || ! empty($dato_12) || ! empty($dato_13) || ! empty($dato_14) || ! empty($dato_15) || ! empty($dato_16) || ! empty($dato_17)  ) {
        $query = "insert into finanzas_stage_gastos( account_f, costc, project, drc_description, dea, dea_t, period, transaction_date, transaction_currency, amount_in_transaction_currency, amount_in_usd, donor_currency, donor_cur_amount, trans_no, analysis_type, analysis, transaction_desc
          ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssssssssssssssss";
        $paramArray = array($dato_01, $dato_02, $dato_03, $dato_04, $dato_05, $dato_06, $dato_07, $dato_08, $dato_09, $dato_10, $dato_11, $dato_12, $dato_13, $dato_14, $dato_15, $dato_16, $dato_17);
        $insertId = $db->insert($query, $paramType, $paramArray);
        $conta++;

        if (! empty($insertId)) {        
          $type = "success";
          $message = "Datos importados de Excel a la Base de Datos: ".$conta." registros.";
        } else {
          $type = "error";
          $message = "Problemas al importar los datos de Excel. Intente de nuevo";
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
      Cargar datos de los gastos realizados por proyectos
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
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Importar registros</button>
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


<?php include("../administrador/template/pie.php"); ?>