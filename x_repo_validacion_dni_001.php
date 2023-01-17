<?php 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();
//$conn = $db->Connect();
//require "vendor/autoload.php";
require_once ('./vendor/autoload.php');

if(isset($_POST['import'])){
  //False unless proven otherwise.
  $user = $_POST['txtUsuario'];

  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $usuarios = $db->select_repo("SP_SelectDocIdentConIncidencias",$user);

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Users");
  $sheet->setCellValue("A1", "ID");
  $sheet->setCellValue("B1", "ID_Encuestador");
  $sheet->setCellValue("C1", "Documento 1 - Beneficiario");
  $sheet->setCellValue("D1", "Documento 2 - Beneficiario");
  $sheet->setCellValue("E1", "N° Whastapp");
  $sheet->setCellValue("F1", "N° SMS");
  $sheet->setCellValue("G1", "Documento Integ.1");
  $sheet->setCellValue("H1", "Documento Integ.2");
  $sheet->setCellValue("I1", "Documento Integ.3");
  $sheet->setCellValue("J1", "Documento Integ.4");
  $sheet->setCellValue("K1", "Documento Integ.5");
  $sheet->setCellValue("L1", "Documento Integ.6");
  $sheet->setCellValue("M1", "Documento Integ.7");

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

  $writer = new Xlsx($spreadsheet);
  $fileName = "Reporte_incidencias_en_documento_" . $timestamp1 . ".xlsx";
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
  header('Cache-Control: max-age=0');

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  $writer->save('php://output');  
}

?>