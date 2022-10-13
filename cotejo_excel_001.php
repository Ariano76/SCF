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
  $db_1->cotejoIncial($timestamp1,$user);

  $usuarios = $db_1->resultado_cotejoInicial($user);

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Users");
  $sheet->setCellValue("A1", "ID");
  $sheet->setCellValue("B1", "nombre_1");
  $sheet->setCellValue("C1", "nombre_2");
  $sheet->setCellValue("D1", "apellido_1");
  $sheet->setCellValue("E1", "apellido_2");
  $sheet->setCellValue("F1", "Numero_Documento");
  $sheet->setCellValue("G1", "Relación");
  $sheet->setCellValue("H1", "Otro");
  $sheet->setCellValue("I1", "Usuario");
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
    $i++;
  }

  $db_1->delete_resultado_cotejoInicial($user);

  $writer = new Xlsx($spreadsheet);
  $fileName = "Resultado_Cotejar_Usuarios_mismo_documento_" . $timestamp1 . ".xlsx";
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
  header('Cache-Control: max-age=0');

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  $writer->save('php://output');  
}

?>
