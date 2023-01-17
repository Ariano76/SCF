<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();
$conn = $db->Connect();

$usuarios = $db->select_repo("SP_SelectDocIdentConIncidencias",$nombreUsuario);

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
              <th colspan="2">Encuesta</th>
              <th colspan="4">Beneficiario</th>
              <th colspan="7">N° identificación: Integrante</th>
            </tr>

            <th>ID</th>
            <th>Id Encuestador</th>
            <th>Documento #1</th>
            <th>Documento #2</th>
            <th>N° WhatsApp</th>
            <th>N° SMS</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
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
          $usuarios = $db->select_repo("SP_SelectDocIdentConIncidencias",$nombreUsuario);

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
                $sheet->setCellValue("H1", "Documento Integ.2");
                $sheet->setCellValue("I1", "Documento Integ.3");
                $sheet->setCellValue("J1", "Documento Integ.4");
                $sheet->setCellValue("K1", "Documento Integ.5");
                $sheet->setCellValue("L1", "Documento Integ.6");
                $sheet->setCellValue("M1", "Documento Integ.7");
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
                  $i++;
                }
                $writer = new Xlsx($spreadsheet);
                $writer->save("Usuarios con incidencias en documento.xlsx");
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