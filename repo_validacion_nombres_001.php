<?php 
require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();

if(isset($_POST['import'])){
  
  $user = $_POST['txtUsuario'];

  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $usuarios = $db->incidencia_Nombres("SP_SelectNombresConDigitos",$user);

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Users");
  $sheet->setCellValue("A1", "ID");
  $sheet->setCellValue("B1", "Encuestador");
  $sheet->setCellValue("C1", "Nombre Beneficiario");
  $sheet->setCellValue("D1", "2do Nombre");
  $sheet->setCellValue("E1", "1er Apellido");
  $sheet->setCellValue("F1", "2do Apellido");
  $sheet->setCellValue("G1", "Nombre Integrante 1");
  $sheet->setCellValue("H1", "2do Nombre");
  $sheet->setCellValue("I1", "1er Apellido");
  $sheet->setCellValue("J1", "2do Apellido");
  $sheet->setCellValue("K1", "Nombre Integrante 2");
  $sheet->setCellValue("L1", "2do Nombre");
  $sheet->setCellValue("M1", "1er Apellido");
  $sheet->setCellValue("N1", "2do Apellido");                
  $sheet->setCellValue("O1", "Nombre Integrante 3");
  $sheet->setCellValue("P1", "2do Nombre");
  $sheet->setCellValue("Q1", "1er Apellido");
  $sheet->setCellValue("R1", "2do Apellido");    
  $sheet->setCellValue("S1", "Nombre Integrante 4");
  $sheet->setCellValue("T1", "2do Nombre");
  $sheet->setCellValue("U1", "1er Apellido");
  $sheet->setCellValue("V1", "2do Apellido");
  $sheet->setCellValue("W1", "Nombre Integrante 5");
  $sheet->setCellValue("X1", "2do Nombre");
  $sheet->setCellValue("Y1", "1er Apellido");
  $sheet->setCellValue("Z1", "2do Apellido");
  $sheet->setCellValue("AA1", "Nombre Integrante 6");
  $sheet->setCellValue("AB1", "2do Nombre");
  $sheet->setCellValue("AC1", "1er Apellido");
  $sheet->setCellValue("AD1", "2do Apellido");                
  $sheet->setCellValue("AE1", "Nombre Integrante 7");
  $sheet->setCellValue("AF1", "2do Nombre");
  $sheet->setCellValue("AG1", "1er Apellido");
  $sheet->setCellValue("AH1", "2do Apellido");                
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
    $sheet->setCellValue("O".$i, $usuario[14]);
    $sheet->setCellValue("P".$i, $usuario[15]);
    $sheet->setCellValue("Q".$i, $usuario[16]);
    $sheet->setCellValue("R".$i, $usuario[17]);
    $sheet->setCellValue("S".$i, $usuario[18]);
    $sheet->setCellValue("T".$i, $usuario[19]);
    $sheet->setCellValue("U".$i, $usuario[20]);
    $sheet->setCellValue("V".$i, $usuario[21]);
    $sheet->setCellValue("W".$i, $usuario[22]);
    $sheet->setCellValue("X".$i, $usuario[23]);
    $sheet->setCellValue("Y".$i, $usuario[24]);
    $sheet->setCellValue("Z".$i, $usuario[25]);
    $sheet->setCellValue("AA".$i, $usuario[26]);
    $sheet->setCellValue("AB".$i, $usuario[27]);
    $sheet->setCellValue("AC".$i, $usuario[28]);
    $sheet->setCellValue("AD".$i, $usuario[29]);
    $sheet->setCellValue("AE".$i, $usuario[30]);
    $sheet->setCellValue("AF".$i, $usuario[31]);
    $sheet->setCellValue("AG".$i, $usuario[32]);
    $sheet->setCellValue("AH".$i, $usuario[33]);
    $i++;
  }
  $writer = new Xlsx($spreadsheet);
  $fileName = "Reporte_Usuarios_con_incidencias_en_nombres_" . $timestamp1 . ".xlsx";
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
  header('Cache-Control: max-age=0');

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  $writer->save('php://output');  

}
?>