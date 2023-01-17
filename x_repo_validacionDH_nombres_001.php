<?php 
require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();

if(isset($_POST['submit'])){

  $user = $_POST['txtUsuario'];

  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $usuarios = $db->incidencia_Nombres("SP_SelectDHNombresConDigitos",$user);

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Users");
  $sheet->setCellValue("A1", "ID");
  $sheet->setCellValue("B1", "1er Nombre");
  $sheet->setCellValue("C1", "2do Nombre");
  $sheet->setCellValue("D1", "1er Apellido");
  $sheet->setCellValue("E1", "2do Apellido");
  $sheet->setCellValue("F1", "Tipo documento");
  $sheet->setCellValue("G1", "Proyecto");
  $i = 2;
  foreach($usuarios as $usuario) {
    $sheet->setCellValue("A".$i, $usuario[0]);
    $sheet->setCellValue("B".$i, $usuario[1]);
    $sheet->setCellValue("C".$i, $usuario[2]);
    $sheet->setCellValue("D".$i, $usuario[3]);
    $sheet->setCellValue("E".$i, $usuario[4]);
    $sheet->setCellValue("F".$i, $usuario[5]);
    $sheet->setCellValue("G".$i, $usuario[6]);
    $i++;
  }
  $writer = new Xlsx($spreadsheet);
  $fileName = "Reporte_Usuarios_data_historica_con_incidencias_en_nombres_" . $timestamp1 . ".xlsx";
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
  header('Cache-Control: max-age=0');

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  $writer->save('php://output');  

}
?>