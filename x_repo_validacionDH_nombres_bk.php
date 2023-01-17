<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();
$conn = $db->Connect();

$usuarios = $db->incidencia_Nombres("SP_SelectDHNombresConDigitos",$nombreUsuario);

?>

<h1 class="display-8">Observaciones en Nombres y Apellidos</h1>
<!--p class="lead">Identificación de las principales incidencias presente en los datos y su corrección.</p-->    

<div class="col-lg-12">
  <table id="tablaUsers" class="table table-striped table-bordered table-condensed small nowrap" style="width:100%">
    <thead class="text-center">
      <tr>
        <th colspan="7">Beneficiario</th>
      </tr>

      <th>ID</th>
      <th>1er Nombre</th>
      <th>2do Nombre</th>
      <th>1er Apellido</th>
      <th>2do Apellido</th>
      <th>Tipo documento</th>
      <th>Proyecto</th>      
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
          $usuarios = $db->incidencia_Nombres("SP_SelectDHNombresConDigitos",$nombreUsuario);

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
                $writer->save("Usuarios data historica con incidencias en nombres.xlsx");
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