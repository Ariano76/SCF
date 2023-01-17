<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();

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

        <form action="repo_validacion_dni_001.php" method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
          <div class="float-right">  
            <input type="radio" checked="checked" name="export_type" value="Excel"> Excel
            <input type="hidden" name="txtUsuario" value="<?php echo $nombreUsuario;?>" />
            <!--input type="radio" name="export_type" value="csv"> CSV
              <button type="submit" name="import" class="btn btn-primary">Export</button-->
            </div> 

            <br>
            <!--input type="submit" value="Procesar registros" name="submit" -->
            <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Exportar archivo</button>
          </form>
        </div>
        <br>

        <?php include("administrador/template/pie.php"); ?>