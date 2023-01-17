<?php include("administrador/template/cabecera.php"); 

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();

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

  <form action="repo_validacion_nombres_001.php" method="post" action="">
    <div class="float-right">  
      <input type="radio" checked="checked" name="export_type" value="Excel"> Excel
      <input type="hidden" name="txtUsuario" value="<?php echo $nombreUsuario;?>" />
            <!--input type="radio" name="export_type" value="csv"> CSV
              <button type="submit" name="import" class="btn btn-primary">Export</button-->
            </div> 

            <br>
            <!--input type="submit" value="Procesar registros" name="submit" -->
            <button type="submit" id="submit" name="import" value="Submit" class="btn btn-success btn-lg">Exportar archivo</button>
          </form>


        </div>
        <br>


        <?php include("administrador/template/pie.php"); ?>