<?php include("template/cabecera.php"); ?>

<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

//require_once './administrador/config/bd.php';
require_once './administrador/config/bdPDO.php';

$db_1 = new TransactionSCI();

require_once ('./vendor/autoload.php');

if (isset($_POST["import"])) {
  $type = "OK";
  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  //$db_1->cotejo($timestamp1);

  $usuarios = $db_1->select_repo_all("SP_Select_Mera_Proteccion");

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Users");
  $sheet->setCellValue("A1", "Fecha Encuesta");
  $sheet->setCellValue("B1", "Región del Beneficiario");
  $sheet->setCellValue("C1", "¿En qué provincia?");
  $sheet->setCellValue("D1", "transit_settle");
  $sheet->setCellValue("E1", "¿En qué distrito?");
  $sheet->setCellValue("F1", "Primer Nombre");
  $sheet->setCellValue("G1", "Segundo Nombre");
  $sheet->setCellValue("H1", "Primer Apellido");
  $sheet->setCellValue("I1", "Segundo Apellido");
  $sheet->setCellValue("J1", "¿Usted con que género se identifica?");
  $sheet->setCellValue("K1", "¿Cuál es su fecha de nacimiento?");
  $sheet->setCellValue("L1", "Edad");
  $sheet->setCellValue("M1", "Tipo de identificación #1 (Cédula)");
  $sheet->setCellValue("N1", "Fecha de caducidad");
  $sheet->setCellValue("O1", "¿Usted cuenta con los siguientes medios de comunicación?");
  $sheet->setCellValue("P1", "¿Cuál es su número de WhatsApp?");
  $sheet->setCellValue("Q1", "¿Cuál es su número de celular para recibir mensajes de texto?");
  $sheet->setCellValue("R1", "En caso de comunicarnos con usted, ¿Cuál de estos números usa con mayor frecuencia?");
  $sheet->setCellValue("S1", "¿Es teléfono propio?");
  $sheet->setCellValue("T1", "¿Cómo accede a internet..?");
  $sheet->setCellValue("U1", "¿Esta viviendo o viajando con otros miembros de la familia?");
  $sheet->setCellValue("V1", "¿Cuántos miembros hay en su familia y viven o viajan con usted? Por favor inclúyase en este número.");
  $sheet->setCellValue("W1", "¿Está usted o alguien de su hogar con quien viaja o vive embarazada?");
  $sheet->setCellValue("X1", "¿Usted o alguien de su hogar con la que viaja o vive tiene alguna de las siguientes condiciones?");
  $sheet->setCellValue("Y1", "¿Usted viaja o vive con niños de 5 a 17 años?");
  $sheet->setCellValue("Z1", "¿Todos/as los/as NNA a su cargo se encuentran actualmente matriculados en la escuela?");
  $sheet->setCellValue("AA1", "¿Cuál es el dispositivo que utilizan para participar de las clases virtuales?");
  $sheet->setCellValue("AB1", "¿Qué dificultades ha tenido para matricular a los/as menores?");
  $sheet->setCellValue("AC1", "¿Usted o un miembro de su hogar con los que viaja o vive tiene alguna discapacidad, enfermedad crónica o una enfermedad que no le permite trabajar?");
  $sheet->setCellValue("AD1", "Primer Nombre Pariente 1");
  $sheet->setCellValue("AE1", "Segundo Nombre");
  $sheet->setCellValue("AF1", "Primer Apellido");
  $sheet->setCellValue("AG1", "Segundo Apellido");
  $sheet->setCellValue("AH1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("AI1", "Edad");
  $sheet->setCellValue("AJ1", "Relación");
  $sheet->setCellValue("AK1", "Primer Nombre Pariente 2");
  $sheet->setCellValue("AL1", "Segundo Nombre");
  $sheet->setCellValue("AM1", "Primer Apellido");
  $sheet->setCellValue("AN1", "Segundo Apellido");
  $sheet->setCellValue("AO1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("AP1", "Edad");
  $sheet->setCellValue("AQ1", "Relación");
  $sheet->setCellValue("AR1", "Primer Nombre Pariente 3");
  $sheet->setCellValue("AS1", "Segundo Nombre");
  $sheet->setCellValue("AT1", "Primer Apellido");
  $sheet->setCellValue("AU1", "Segundo Apellido");
  $sheet->setCellValue("AV1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("AW1", "Edad");
  $sheet->setCellValue("AX1", "Relación");
  $sheet->setCellValue("AY1", "Primer Nombre Pariente 4");
  $sheet->setCellValue("AZ1", "Segundo Nombre");
  $sheet->setCellValue("BA1", "Primer Apellido");
  $sheet->setCellValue("BB1", "Segundo Apellido");
  $sheet->setCellValue("BC1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("BD1", "Edad");
  $sheet->setCellValue("BE1", "Relación");
  $sheet->setCellValue("BF1", "Primer Nombre Pariente 5");
  $sheet->setCellValue("BG1", "Segundo Nombre");
  $sheet->setCellValue("BH1", "Primer Apellido");
  $sheet->setCellValue("BI1", "Segundo Apellido");
  $sheet->setCellValue("BJ1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("BK1", "Edad");
  $sheet->setCellValue("BL1", "Relación");
  $sheet->setCellValue("BM1", "Primer Nombre Pariente 6");
  $sheet->setCellValue("BN1", "Segundo Nombre");
  $sheet->setCellValue("BO1", "Primer Apellido");
  $sheet->setCellValue("BP1", "Segundo Apellido");
  $sheet->setCellValue("BQ1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("BR1", "Edad");
  $sheet->setCellValue("BS1", "Relación");
  $sheet->setCellValue("BT1", "Primer Nombre Pariente 7");
  $sheet->setCellValue("BU1", "Segundo Nombre");
  $sheet->setCellValue("BV1", "Primer Apellido");
  $sheet->setCellValue("BW1", "Segundo Apellido");
  $sheet->setCellValue("BX1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("BY1", "Edad");
  $sheet->setCellValue("BZ1", "Relación");
  $sheet->setCellValue("CA1", "Derivación Protección");

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
    $sheet->setCellValue("AI".$i, $usuario[34]);
    $sheet->setCellValue("AJ".$i, $usuario[35]);
    $sheet->setCellValue("AK".$i, $usuario[36]);
    $sheet->setCellValue("AL".$i, $usuario[37]);
    $sheet->setCellValue("AM".$i, $usuario[38]);
    $sheet->setCellValue("AN".$i, $usuario[39]);
    $sheet->setCellValue("AO".$i, $usuario[40]);
    $sheet->setCellValue("AP".$i, $usuario[41]);
    $sheet->setCellValue("AQ".$i, $usuario[42]);
    $sheet->setCellValue("AR".$i, $usuario[43]);
    $sheet->setCellValue("AS".$i, $usuario[44]);
    $sheet->setCellValue("AT".$i, $usuario[45]);
    $sheet->setCellValue("AU".$i, $usuario[46]);
    $sheet->setCellValue("AV".$i, $usuario[47]);
    $sheet->setCellValue("AW".$i, $usuario[48]);
    $sheet->setCellValue("AX".$i, $usuario[49]);
    $sheet->setCellValue("AY".$i, $usuario[50]);
    $sheet->setCellValue("AZ".$i, $usuario[51]);
    $sheet->setCellValue("BA".$i, $usuario[52]);
    $sheet->setCellValue("BB".$i, $usuario[53]);
    $sheet->setCellValue("BC".$i, $usuario[54]);
    $sheet->setCellValue("BD".$i, $usuario[55]);
    $sheet->setCellValue("BE".$i, $usuario[56]);
    $sheet->setCellValue("BF".$i, $usuario[57]);
    $sheet->setCellValue("BG".$i, $usuario[58]);
    $sheet->setCellValue("BH".$i, $usuario[59]);
    $sheet->setCellValue("BI".$i, $usuario[60]);
    $sheet->setCellValue("BJ".$i, $usuario[61]);
    $sheet->setCellValue("BK".$i, $usuario[62]);
    $sheet->setCellValue("BL".$i, $usuario[63]);
    $sheet->setCellValue("BM".$i, $usuario[64]);
    $sheet->setCellValue("BN".$i, $usuario[65]);
    $sheet->setCellValue("BO".$i, $usuario[66]);
    $sheet->setCellValue("BP".$i, $usuario[67]);
    $sheet->setCellValue("BQ".$i, $usuario[68]);
    $sheet->setCellValue("BR".$i, $usuario[69]);
    $sheet->setCellValue("BS".$i, $usuario[70]);
    $sheet->setCellValue("BT".$i, $usuario[71]);
    $sheet->setCellValue("BU".$i, $usuario[72]);
    $sheet->setCellValue("BV".$i, $usuario[73]);
    $sheet->setCellValue("BW".$i, $usuario[74]);
    $sheet->setCellValue("BX".$i, $usuario[75]);
    $sheet->setCellValue("BY".$i, $usuario[76]);
    $sheet->setCellValue("BZ".$i, $usuario[77]);
    $sheet->setCellValue("CA".$i, $usuario[78]);

    $i++;
  }
  $writer = new Xlsx($spreadsheet);
  $fileName = "Reporte_Mera_Proteccion_" . $timestamp1 . ".xlsx";
  
  $writer->save("Reporte_Mera_Proteccion_" . $timestamp1 . ".xlsx");
  $var=true;

  if (!empty($var)) {        
    $type = "success";
    $message = "Datos se importaron al archivo : Reporte_Mera_Proteccion_" . $timestamp1 . ".xlsx";
  } else {
    $type = "error";
    $message = "Problemas al importar los datos de Excel. Intente de nuevo";
  }

}

?>

<div class="col-md-12">

  <div class="card text-dark bg-light">
    <div class="card-header">
      SECTOR MERA PROTECCIÓN
    </div>
    <div class="card-body">
      <form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En este apartado podremos generar el reporte en formato excel con la información de todos los beneficiarios y su información complementaria para enviar al sector de Protección.</label>
          <br>
          <br>          
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Generar Reporte Protección</button>
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

<?php include("template/pie.php"); ?>