<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();
$conn = $db->Connect();

$usuarios = $db->select_repo("SP_SelectDHDocIdentConIncidencias",$nombreUsuario);

?>

<!--div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row"-->
      <h1 class="display-8">Observaciones en campos númericos</h1>
      <!--p class="lead">Identificación de las principales incidencias presente en los datos y su corrección.</p-->    

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed small nowrap" style="width:100%">
          <thead class="text-center">
            <tr>
              <th colspan="4">Beneficiario</th>
            </tr>
            <th>ID</th>
            <th>Nombres y Apellidos</th>
            <th>Tipo documento</th>
            <th>Numero documento</th>
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
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>

  <script>
    $(document).ready(function(){
      $('#tablaUsuarios').DataTable({
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
          $usuarios = $db->select_repo("SP_SelectDHDocIdentConIncidencias",$nombreUsuario);

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
                $sheet->setCellValue("B1", "Nombres y Apellidos");
                $sheet->setCellValue("C1", "Tipo documento");
                $sheet->setCellValue("D1", "Numero documento");
                $i = 2;
                foreach($usuarios as $usuario) {
                  $sheet->setCellValue("A".$i, $usuario[0]);
                  $sheet->setCellValue("B".$i, $usuario[1]);
                  $sheet->setCellValue("C".$i, $usuario[2]);
                  $sheet->setCellValue("D".$i, $usuario[3]);
                  $i++;
                }
                $writer = new Xlsx($spreadsheet);
                $writer->save("Usuarios data historica con incidencias en documento.xlsx");
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