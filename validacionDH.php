<?php include("administrador/template/cabecera.php"); 

//use TransactionSCI;
require_once './administrador/config/bdPDO.php';

$db = new TransactionSCI();
$conn = $db->Connect();

?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-8">Limpieza de datos Data Historica</h1>
    <p class="lead">Identificación de las principales incidencias presente en los datos y su corrección.</p>    
    <p class="lead">Habilite los procesos a ejecutarse.</p>    
    
    <form method="post" action="">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name='opciones[]' value="Opcion_01" checked>
        <label class="form-check-label" for="flexSwitchCheckDefault">Limpiar espacios en blanco</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked_1" name='opciones[]' value="Opcion_02" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked_1">Limpiar caracteres especiales</label>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked_2" name='opciones[]' value="Opcion_03" checked>
        <label class="form-check-label" for="flexSwitchCheckChecked_2">Recodificar respuestas</label>
      </div>
      <br>
      <!--input type="submit" value="Procesar registros" name="submit" -->
      <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-success btn-lg">Procesar registros</button>
    </form>

  </div>
  
  <?php
  if(isset($_POST['submit'])){
    $cod_01 = $db->limpiar_DH("SP_UpdateDHAscii",$nombreUsuario);
    $cod_02 = $db->limpiar_DH("SP_UpdateDHDobleEspacioBlanco",$nombreUsuario);
    //$cod_03 = $db->limpiar_DH("SP_UpdateDHTab",$nombreUsuario);
    $cod_04 = $db->limpiar_DH("SP_UpdateDHSaltoLinea",$nombreUsuario);
    $cod_05 = $db->limpiar_DH("SP_UpdateDHLetrasPuntoGuion",$nombreUsuario);
    $cod_06 = $db->limpiar_DH("SP_UpdateDHBackSlash",$nombreUsuario);
    $cod_07 = $db->limpiar_DH("SP_UpdateDHNewLineReturnLine",$nombreUsuario);
    $cod_08 = $db->limpiar_DH("SP_UpdateDHTrim",$nombreUsuario);
    $cod_09 = $db->limpiar_DH("SP_UpdateDHTipoDocumento",$nombreUsuario);
    $cod_10 = $db->limpiar_DH("SP_UpdateDHSoloTextoTipoDocumento",$nombreUsuario);
    /*$cod_02 = $db->limpiar_DH("SP_UpdateChar",$nombreUsuario);
    $cod_03 = $db->limpiar_DH("SP_UpdateDHSoloAlfanumericos",$nombreUsuario);
    $cod_04 = $db->limpiar_DH("SP_UpdateDHLimpiarCaracteres_acentos",$nombreUsuario);
    $cod_07 = $db->limpiar_DH("SP_UpdateDHLimpiarDobleEspacioBlanco",$nombreUsuario);
    */

    /*if (    ) {*/
    if ($cod_01 == 1  && $cod_02 == 1 && $cod_04 == 1 && $cod_05 == 1 && $cod_06 == 1 && $cod_07 == 1 && $cod_08 == 1 && $cod_09 == 1 && $cod_10 == 1) {
      $type = "success";
      $message = "Todos los procesos finalizarón satisfactoriamente.";
    }else{
      $type = "error";
      $message = "Problemas al ejecutar los procesos de validacón. Intente de nuevo.". $cod_01 ."-". $cod_02 ."-". $cod_03 ."-". $cod_04 ."-". $cod_05 ."-". $cod_06 ."-". $cod_07 ."-". $cod_08 ."-". $cod_09;
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

<?php include("administrador/template/pie.php"); ?>

