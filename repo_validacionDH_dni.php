<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();

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

        <form action="repo_validacionDH_dni_001.php" method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
          <div class="float-right">  
            <input type="radio" checked="checked" name="export_type" value="Excel"> Excel
            <input type="hidden" name="txtUsuario" value="<?php echo $nombreUsuario;?>" />
            <!--input type="radio" name="export_type" value="csv"> CSV
              <button type="submit" name="import" class="btn btn-primary">Export</button-->
            </div> 

            <br>
            <!--input type="submit" value="Procesar registros" name="submit" -->
            <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-success btn-lg">Exportar archivo</button>
          </form>

        </div>
        <br>

        <?php include("administrador/template/pie.php"); ?>