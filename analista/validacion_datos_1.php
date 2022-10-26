<?php include("../administrador/template/cabecera.php"); 

//use TransactionSCI;
require_once '../administrador/config/bdPDO.php';

$db = new TransactionSCI();
$conn = $db->Connect();

?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-8">Validación de datos de los Proyectos</h1>
    <p class="lead">Identificación de las principales incidencias presente en los datos.</p>    
    
    <form method="post" action="">
      <br>
      <!--input type="submit" value="Procesar registros" name="submit" -->
      <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-success btn-lg">Procesar registros</button>
    </form>

  </div>

  <?php
  if(isset($_POST['submit'])){
    
    $cod_00 = $db->ejecutarstoredprocedure("SP_finanzas_clean_trim");
    //$cod_16 = $db->validarDataGerencia("SP_Gerencia_validar_campos_date", 'dato_34');
    //$cod_17 = $db->validarDataGerencia("SP_Gerencia_validar_campos_numericos", 'dato_35');

    if ($cod_00 == 0) {
      $type = "success";
      $message = "Todos los procesos finalizarón satisfactoriamente.";
      $_SESSION['validaciongerencia'] = 1;
    }else{
      $type = "error";
      $message = "Se encontrarón incidencias en las siguientes variables. Revise e intente de nuevo.<br>
      <table><tr>
        <th>Variable</th>
        <th>&emsp;</th>
        <th>Estado</th>
      </tr>";
      $d01 = "<tr><td>Tipo de documento</td><td>:</td><td>". ($cod_00 == 0 ? 'Ok':'Revisar. Faltan datos o son inconsistentes.')."</td></tr>";
      $message .= $d01 . $d02 . $d03 . $d04 .$d05 . $d06 . $d07 . $d08 . $d09 . $d10;
      $message .= $d11 . $d12 . $d13 . $d14 .$d15 . $d16 . $d17 . $d18;
    }
  }
  ?>

  <div class="col-md-12">
    <div class=card-text>&nbsp;</div>
  </div>
  <div class="col-md-12">
    <div class=card-text>
      <div class="<?php if(!empty($type)) { echo $type . " alert alert-success role=alert"; } ?>"><?php if(!empty($message)) { echo $message; } ?>
    </div>
  </div>
</div>


<?php include("../administrador/template/pie.php"); ?>