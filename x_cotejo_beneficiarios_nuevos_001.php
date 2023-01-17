<?php 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//require_once './administrador/config/bd.php';
require_once './administrador/config/bdPDO.php';

$db_1 = new TransactionSCI();

require_once ('./vendor/autoload.php');

if (isset($_POST["import"])) {
  $user = $_POST['txtUsuario'];
  $type = "OK";
  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);
  //echo "<script>console.log('Console: " . $timestamp1 . "' );</script>"; 
  $db_1->cotejoNuevoBeneficiario($timestamp1,$user);

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
  $sheet->setCellValue("N1", "ID_Beneficiario - no eliminar");
  $sheet->setCellValue("O1", "Observaciones");
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
    $sheet->setCellValue("N".$i, $usuario[13]);
    $i++;
  }

  $db_1->delete_resultado_cotejo($timestamp1);

  $writer = new Xlsx($spreadsheet);
  $fileName = "Resultado_Cotejar_Nuevos_Beneficiarios_Data_Historica_" . $timestamp1 . ".xlsx";
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
  header('Cache-Control: max-age=0');

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  $writer->save('php://output');  
}

?>
