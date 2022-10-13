<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();

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

  <form action="repo_validacionDH_nombres_001.php" method="post" action="">
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