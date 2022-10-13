<?php 
require "../../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once ('../../administrador/config/bdPDO.php');

$db = new TransactionSCI();

  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $usuarios = $db->select_repo_gerencia("SP_repo_gerencia_powerbi");

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Planilla_Power_BI");
  $sheet->setCellValue("A1", "Tema");
  $sheet->setCellValue("B1", "Subtema");
  $sheet->setCellValue("C1", "Actividad");
  $sheet->setCellValue("D1", "Fecha_de_la_actividad");
  $sheet->setCellValue("E1", "Nombre");
  $sheet->setCellValue("F1", "Apellido");
  $sheet->setCellValue("G1", "Tipo_documento");
  $sheet->setCellValue("H1", "Documento");
  $sheet->setCellValue("I1", "Edad");
  $sheet->setCellValue("J1", "Sexo");
  $sheet->setCellValue("K1", "Telefono");
  $sheet->setCellValue("L1", "Correo");
  $sheet->setCellValue("M1", "Región");
  $sheet->setCellValue("N1", "Proyecto");
  $sheet->setCellValue("O1", "Conteo");
  $sheet->setCellValue("P1", "Grupo Edad");
  $i = 2;
  foreach($usuarios as $usuario) {
    $sheet->setCellValue("A".$i, $usuario[3]);
    $sheet->setCellValue("B".$i, $usuario[4]);
    $sheet->setCellValue("C".$i, $usuario[5]);
    $sheet->setCellValue("D".$i, $usuario[6]);
    $sheet->setCellValue("E".$i, "");
    $sheet->setCellValue("F".$i, "");
    $sheet->setCellValue("G".$i, "");
    $sheet->setCellValue("H".$i, "");
    $sheet->setCellValue("I".$i, "");
    $sheet->setCellValue("J".$i, $usuario[7]);
    $sheet->setCellValue("K".$i, "");
    $sheet->setCellValue("L".$i, "");
    $sheet->setCellValue("M".$i, $usuario[8]);
    $sheet->setCellValue("N".$i, $usuario[9]);
    $sheet->setCellValue("O".$i, $usuario[11]);
    $sheet->setCellValue("P".$i, $usuario[10]);
    $i++;
  }

  $writer = new Xlsx($spreadsheet);
  $fileName = "Reporte_total_reach_powerbi_" . $timestamp1 . ".xlsx";
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
  header('Cache-Control: max-age=0');

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  $writer->save('php://output');  


?>