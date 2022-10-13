<?php include("template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDObenef.php';

$db = new TransactionSCI();
$conn = $db->Connect();

$usuarios = $db->select_beneficiarios("SP_Select_encuesta");

?>

<!--div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row"-->
      <h1 class="display-4">DATOS DE ENCUESTA</h1>
      <!--p class="lead">Identificación de las principales incidencias presente en los datos y su corrección.</p-->    

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table-striped table-bordered" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Beneficiario</th>
              <th>Fecha Encuesta</th>
              <!--th>Id Encuestador</th>
              <th>Encuestador</th>
              <th>Region Encuestador</th>
              <th>Como realizo encuesta</th>
              <th>Esta de acuerdo</th-->
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($usuarios as $usuario){
              ?>
              <tr>
                <td><?php echo $usuario[0]?></td>
                <td><?php echo $usuario[1]?></td>
               <!-- <td><!?php echo $usuario[2]?></td>
                <td><!?php echo $usuario[3]?></td>
                <td><!?php echo $usuario[4]?></td>
                <td><!?php echo $usuario[5]?></td>
                <td><!?php echo $usuario[6]?></td> -->
                <td align=center>
                  <form method="POST"> 
                    <input type="hidden" name="txtID" value="<?php echo $usuario[2];?>" />
                    <!--input type="submit" name="accion" value="seleccionar" class="btn btn-primary btn-sm" /-->
                    <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                      <a class="update_pass" data-emp-id="<?php echo $usuario[2];?>" href=#>
                      <i class="fas fa-recycle"></i>
                    </a>
                  </form>
                </td>
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
      </br>
    </br>


    <?php
    if(isset($_POST['submit'])){
        //False unless proven otherwise.
      $usuarios = $db->select_beneficiarios("SP_Select_encuesta");

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
            $sheet->setCellValue("B1", "ID_Encuestador");
            $sheet->setCellValue("C1", "Documento 1 - Beneficiario");
            $sheet->setCellValue("D1", "Documento 2 - Beneficiario");
            $sheet->setCellValue("E1", "N° Whastapp");
            $sheet->setCellValue("F1", "N° SMS");
            $sheet->setCellValue("G1", "Documento Integ.1");           
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
            $writer->save("Reporte datos de Encuesta.xlsx");
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

    <?php include("template/pie.php"); ?>