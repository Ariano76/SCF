<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();
$conn = $db->Connect();

$usuarios = $db->incidencia_Nombres("SP_SelectNombresConDigitos",$nombreUsuario);

?>

<h1 class="display-8">Observaciones en Nombres y Apellidos</h1>
<!--p class="lead">Identificación de las principales incidencias presente en los datos y su corrección.</p-->    

<div class="col-lg-12">
  <table id="tablaUsers" class="table table-striped table-bordered table-condensed small nowrap" style="width:100%">
    <thead class="text-center">
      <tr>
        <th colspan="2">Encuesta</th>
        <th colspan="4">Beneficiario</th>
        <th colspan="4">Integrante 1</th>
        <th colspan="4">Integrante 2</th>
        <th colspan="4">Integrante 3</th>
        <th colspan="4">Integrante 4</th>
        <th colspan="4">Integrante 5</th>
        <th colspan="4">Integrante 6</th>
        <th colspan="4">Integrante 7</th>
      </tr>

      <th>ID</th>
      <th>Encuestador</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>      
    </thead>
    <tbody>
      <?php
      foreach($usuarios as $usuario){
        ?>
        <tr>
          <td><?php echo $usuario[0]?></td>
          <td><?php echo $usuario[1]?></td>
          <td><?php echo $usuario[2]?></td>
          <td><?php echo $usuario[3]?></td>
          <td><?php echo $usuario[4]?></td>
          <td><?php echo $usuario[5]?></td>
          <td><?php echo $usuario[6]?></td>
          <td><?php echo $usuario[7]?></td>
          <td><?php echo $usuario[8]?></td>
          <td><?php echo $usuario[9]?></td>
          <td><?php echo $usuario[10]?></td>
          <td><?php echo $usuario[11]?></td>
          <td><?php echo $usuario[12]?></td>
          <td><?php echo $usuario[13]?></td>
          <td><?php echo $usuario[14]?></td>
          <td><?php echo $usuario[15]?></td>
          <td><?php echo $usuario[16]?></td>
          <td><?php echo $usuario[17]?></td>
          <td><?php echo $usuario[18]?></td>
          <td><?php echo $usuario[19]?></td>
          <td><?php echo $usuario[20]?></td>
          <td><?php echo $usuario[21]?></td>
          <td><?php echo $usuario[22]?></td>
          <td><?php echo $usuario[23]?></td>
          <td><?php echo $usuario[24]?></td>
          <td><?php echo $usuario[25]?></td>
          <td><?php echo $usuario[26]?></td>
          <td><?php echo $usuario[27]?></td>
          <td><?php echo $usuario[28]?></td>
          <td><?php echo $usuario[29]?></td>
          <td><?php echo $usuario[30]?></td>
          <td><?php echo $usuario[31]?></td>
          <td><?php echo $usuario[32]?></td>
          <td><?php echo $usuario[33]?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
  
  <script>
  // Initialize the DataTable
    $(document).ready(function () {
      $('#tablaUsers').DataTable({
        // Enable the horizontal scrolling of data in DataTable
        scrollX: true
      });
      }); 
  </script>

</div>

<div class="text-right">        
  <div class="card-body">
    <h4 class="card-title">Exportar datos</h4>
  </div>

  <form method="post" action="">
    <div class="float-right">  
      <input type="radio" checked="checked" name="export_type" value="Excel"> Excel            
            <!--input type="radio" name="export_type" value="csv"> CSV
              <button type="submit" name="import" class="btn btn-primary">Export</button-->
            </div> 

            <br>
            <!--input type="submit" value="Procesar registros" name="submit" -->
            <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-success btn-lg">Exportar archivo</button>
          </form>


        </div>
        <br>


        <?php
        if(isset($_POST['submit'])){
        //False unless proven otherwise.
          $usuarios = $db->incidencia_Nombres("SP_SelectNombresConDigitos",$nombreUsuario);

          $agreedToTerms = false;
        //Make sure that a radio button input was actually submitted.
          if(isset($_POST['export_type'])){
        //An array containing the radio input values that are allowed
            $allowedAnswers = array('Excel', 'csv');
        //The radio button value that the user sent us.
            $chosenAnswer = $_POST['export_type'];
        //Make sure that the value is in our array of allowed values.
            if(in_array($chosenAnswer, $allowedAnswers)){
            //Check to see if the user ticked yes.
              if(strcasecmp($chosenAnswer, 'Excel') == 0){
                //Set our variable to TRUE because they agreed.
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
                $writer->save("Usuarios con incidencias en nombres.xlsx");
                $agreedToTerms = true;
              }
            }
          }

        //If the user agreed
          if($agreedToTerms){
        //Process the form, etc.          
            echo '<div class="card-body">
            <h4 class="card-title">Los datos se exportarón en formato Excel satisfactoriamente</h4>
            </div>';
          }else{
            echo '<div class="card-body">
            <h4 class="card-title">Los datos se exportarón en formato CSV satisfactoriamente</h4>
            </div>';
          }
        }
        ?>

        <?php include("administrador/template/pie.php"); ?>