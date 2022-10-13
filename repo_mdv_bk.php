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

  $usuarios = $db_1->select_repo_all("SP_Select_MDV");

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setTitle("Users");
  $sheet->setCellValue("A1", "Fecha Encuesta");
  $sheet->setCellValue("B1", "Región del Beneficiario");
  $sheet->setCellValue("C1", "¿En qué provincia?");
  $sheet->setCellValue("D1", "¿En qué distrito?");
  $sheet->setCellValue("E1", "transit_settle");
  $sheet->setCellValue("F1", "Primer Nombre");
  $sheet->setCellValue("G1", "Segundo Nombre");
  $sheet->setCellValue("H1", "Primer Apellido");
  $sheet->setCellValue("I1", "Segundo Apellido");
  $sheet->setCellValue("J1", "¿Usted con que género se identifica?");
  $sheet->setCellValue("K1", "¿Cuál es su fecha de nacimiento?");
  $sheet->setCellValue("L1", "Edad");
  $sheet->setCellValue("M1", "Tipo de identificación #1 (Cédula)");
  $sheet->setCellValue("N1", "Fecha de caducidad");
  $sheet->setCellValue("O1", "Tipo de identificación #2");
  $sheet->setCellValue("P1", "No. Identificacion #2");
  $sheet->setCellValue("Q1", "Fecha de caducidad #2");
  $sheet->setCellValue("R1", "¿Cuál de los documentos se encuentra en físico y es original?");
  $sheet->setCellValue("S1", "¿Usted cuenta con los siguientes medios de comunicación?");
  $sheet->setCellValue("T1", "¿Usted cuenta con los siguientes medios de comunicación?/Celular básico (solo para llamadas/mensajes de texto)");
  $sheet->setCellValue("U1", "¿Usted cuenta con los siguientes medios de comunicación?/Smart Phone (teléfono inteligente)");
  $sheet->setCellValue("V1", "¿Usted cuenta con los siguientes medios de comunicación?/Lap top (computadora propia)");
  $sheet->setCellValue("W1", "¿Usted cuenta con los siguientes medios de comunicación?/No cuento con ninguno de los anteriores");
  $sheet->setCellValue("X1", "¿Cuál es su número de WhatsApp?");
  $sheet->setCellValue("Y1", "¿Cuál es su número de celular para recibir mensajes de texto?");
  $sheet->setCellValue("Z1", "En caso de comunicarnos con usted, ¿Cuál de estos números usa con mayor frecuencia?");
  $sheet->setCellValue("AA1", "¿Es teléfono propio?");
  $sheet->setCellValue("AB1", "¿Cómo accede a internet..?");
  $sheet->setCellValue("AC1", "¿Cuál es su dirección?");
  $sheet->setCellValue("AD1", "¿Cuántos miembros hay en su familia y viven o viajan con usted? Por favor inclúyase en este número.");
  $sheet->setCellValue("AE1", "¿Está usted o alguien de su hogar con quien viaja o vive embarazada?");
  $sheet->setCellValue("AF1", "¿Cuánto tiempo de gestación tiene?");
  $sheet->setCellValue("AG1", "¿Usted o alguien de su hogar con la que viaja o vive tiene alguna de las siguientes condiciones?");
  $sheet->setCellValue("AH1", "¿Usted o alguien de su hogar con la que viaja o vive tiene alguna de las siguientes condiciones?/Lactando con NN <2 años");
  $sheet->setCellValue("AI1", "¿Usted o alguien de su hogar con la que viaja o vive tiene alguna de las siguientes condiciones?/No lactando con NN <2 años");
  $sheet->setCellValue("AJ1", "¿Usted o alguien de su hogar con la que viaja o vive tiene alguna de las siguientes condiciones?/Madre de NN 2-5 años");
  $sheet->setCellValue("AK1", "¿Usted o alguien de su hogar con la que viaja o vive tiene alguna de las siguientes condiciones?/Ninguno");
  $sheet->setCellValue("AL1", "¿Usted viaja o vive con niños de 5 a 17 años?");
  $sheet->setCellValue("AM1", "¿Todos/as los/as NNA a su cargo se encuentran actualmente matriculados en la escuela?");
  $sheet->setCellValue("AN1", "¿Usted o un miembro de su hogar con los que viaja o vive tiene alguna discapacidad, enfermedad crónica o una enfermedad que no le permite trabajar?");  
  $sheet->setCellValue("AO1", "Primer Nombre Pariente 1");
  $sheet->setCellValue("AP1", "Segundo Nombre");
  $sheet->setCellValue("AQ1", "Primer Apellido");
  $sheet->setCellValue("AR1", "Segundo Apellido");
  $sheet->setCellValue("AS1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("AT1", "Fecha de nacimiento");
  $sheet->setCellValue("AU1", "Edad");
  $sheet->setCellValue("AV1", "Relación");
  $sheet->setCellValue("AW1", "Tipo de Identificacion");
  $sheet->setCellValue("AX1", "No. Identificacion");
  $sheet->setCellValue("AY1", "Primer Nombre Pariente 2");
  $sheet->setCellValue("AZ1", "Segundo Nombre");
  $sheet->setCellValue("BA1", "Primer Apellido");
  $sheet->setCellValue("BB1", "Segundo Apellido");
  $sheet->setCellValue("BC1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("BD1", "Fecha de nacimiento");
  $sheet->setCellValue("BE1", "Edad");
  $sheet->setCellValue("BF1", "Relación");
  $sheet->setCellValue("BG1", "Tipo de Identificacion");
  $sheet->setCellValue("BH1", "No. Identificacion");
  $sheet->setCellValue("BI1", "Primer Nombre Pariente 3");
  $sheet->setCellValue("BJ1", "Segundo Nombre");
  $sheet->setCellValue("BK1", "Primer Apellido");
  $sheet->setCellValue("BL1", "Segundo Apellido");
  $sheet->setCellValue("BM1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("BN1", "Fecha de nacimiento");
  $sheet->setCellValue("BO1", "Edad");
  $sheet->setCellValue("BP1", "Relación");
  $sheet->setCellValue("BQ1", "Tipo de Identificacion");
  $sheet->setCellValue("BR1", "No. Identificacion");
  $sheet->setCellValue("BS1", "Primer Nombre Pariente 4");
  $sheet->setCellValue("BT1", "Segundo Nombre");
  $sheet->setCellValue("BU1", "Primer Apellido");
  $sheet->setCellValue("BV1", "Segundo Apellido");
  $sheet->setCellValue("BW1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("BX1", "Fecha de nacimiento");
  $sheet->setCellValue("BY1", "Edad");
  $sheet->setCellValue("BZ1", "Relación");
  $sheet->setCellValue("CA1", "Tipo de Identificacion");
  $sheet->setCellValue("CB1", "No. Identificacion");
  $sheet->setCellValue("CC1", "Primer Nombre Pariente 5");
  $sheet->setCellValue("CD1", "Segundo Nombre");
  $sheet->setCellValue("CE1", "Primer Apellido");
  $sheet->setCellValue("CF1", "Segundo Apellido");
  $sheet->setCellValue("CG1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("CH1", "Fecha de nacimiento");
  $sheet->setCellValue("CI1", "Edad");
  $sheet->setCellValue("CJ1", "Relación");
  $sheet->setCellValue("CK1", "Tipo de Identificacion");
  $sheet->setCellValue("CL1", "No. Identificacion");
  $sheet->setCellValue("CM1", "Primer Nombre Pariente 6");
  $sheet->setCellValue("CN1", "Segundo Nombre");
  $sheet->setCellValue("CO1", "Primer Apellido");
  $sheet->setCellValue("CP1", "Segundo Apellido");
  $sheet->setCellValue("CQ1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("CR1", "Fecha de nacimiento");
  $sheet->setCellValue("CS1", "Edad");
  $sheet->setCellValue("CT1", "Relación");
  $sheet->setCellValue("CU1", "Tipo de Identificacion");
  $sheet->setCellValue("CV1", "No. Identificacion");
  $sheet->setCellValue("CW1", "Primer Nombre Pariente 7");
  $sheet->setCellValue("CX1", "Segundo Nombre");
  $sheet->setCellValue("CY1", "Primer Apellido");
  $sheet->setCellValue("CZ1", "Segundo Apellido");
  $sheet->setCellValue("DA1", "¿Cuál es la identidad de género?");
  $sheet->setCellValue("DB1", "Fecha de nacimiento");
  $sheet->setCellValue("DC1", "Edad");
  $sheet->setCellValue("DD1", "Relación");
  $sheet->setCellValue("DE1", "Tipo de Identificacion");
  $sheet->setCellValue("DF1", "No. Identificacion");
  $sheet->setCellValue("DG1", "Contamos con el programa Medios de vida que le brindará información o formación para la empleabilidad o para emprender. Participar de este programa requiere de su tiempo y compromiso para acceder a capacitaciones virtuales / presenciales y/o por teléfono. ¿Estaría usted o algún miembro de su familia interesado y disponible para participar en el programa de medios de vida de Save the Children y autoriza ser contactado para ser evaluado?");
  $sheet->setCellValue("DH1", "¿En cuál de las siguientes actividades estaría más interesado usted o los miembros de su hogar?");
  $sheet->setCellValue("DI1", "¿En cuál de las siguientes actividades estaría más interesado usted o los miembros de su hogar?/Capacitaciones en entrenamiento vocacional para la empleabilidad");
  $sheet->setCellValue("DJ1", "¿En cuál de las siguientes actividades estaría más interesado usted o los miembros de su hogar?/Capacitaciones para iniciar emprendimientos o mejorar un negocio propio");

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
    $sheet->setCellValue("CB".$i, $usuario[79]);
    $sheet->setCellValue("CC".$i, $usuario[80]);
    $sheet->setCellValue("CD".$i, $usuario[81]);
    $sheet->setCellValue("CE".$i, $usuario[82]);
    $sheet->setCellValue("CF".$i, $usuario[83]);
    $sheet->setCellValue("CG".$i, $usuario[84]);
    $sheet->setCellValue("CH".$i, $usuario[85]);
    $sheet->setCellValue("CI".$i, $usuario[86]);
    $sheet->setCellValue("CJ".$i, $usuario[87]);
    $sheet->setCellValue("CK".$i, $usuario[88]);
    $sheet->setCellValue("CL".$i, $usuario[89]);
    $sheet->setCellValue("CM".$i, $usuario[90]);
    $sheet->setCellValue("CN".$i, $usuario[91]);
    $sheet->setCellValue("CO".$i, $usuario[92]);
    $sheet->setCellValue("CP".$i, $usuario[93]);
    $sheet->setCellValue("CQ".$i, $usuario[94]);
    $sheet->setCellValue("CR".$i, $usuario[95]);
    $sheet->setCellValue("CS".$i, $usuario[96]);
    $sheet->setCellValue("CT".$i, $usuario[97]);
    $sheet->setCellValue("CU".$i, $usuario[98]);
    $sheet->setCellValue("CV".$i, $usuario[99]);
    $sheet->setCellValue("CW".$i, $usuario[100]);
    $sheet->setCellValue("CX".$i, $usuario[101]);
    $sheet->setCellValue("CY".$i, $usuario[102]);
    $sheet->setCellValue("CZ".$i, $usuario[103]);
    $sheet->setCellValue("DA".$i, $usuario[104]);
    $sheet->setCellValue("DB".$i, $usuario[105]);
    $sheet->setCellValue("DC".$i, $usuario[106]);
    $sheet->setCellValue("DD".$i, $usuario[107]);
    $sheet->setCellValue("DE".$i, $usuario[108]);
    $sheet->setCellValue("DF".$i, $usuario[109]);
    $sheet->setCellValue("DG".$i, $usuario[110]);
    $sheet->setCellValue("DH".$i, $usuario[111]);
    $sheet->setCellValue("DI".$i, $usuario[112]);
    $sheet->setCellValue("DJ".$i, $usuario[113]);

    $i++;
  }
  $writer = new Xlsx($spreadsheet);
  $writer->save("Reporte_MDV_" . $timestamp1 . ".xlsx");
  $var=true;

  if (!empty($var)) {        
    $type = "success";
    $message = "Datos se importaron al archivo : Reporte_MDV_" . $timestamp1 . ".xlsx";
  } else {
    $type = "error";
    $message = "Problemas al importar los datos de Excel. Intente de nuevo";
  }

}

?>

<div class="col-md-12">

  <div class="card text-dark bg-light">
    <div class="card-header">
      SECTOR MEDIOS DE VIDA
    </div>
    <div class="card-body">
      <form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En este apartado podremos generar el reporte en formato excel con la información de todos los beneficiarios y su información complementaria para enviar al sector de Medios de Vida.</label>
          <br>
          <br>          
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Generar Reporte Medios de Vida</button>
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