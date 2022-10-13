<?php include("../../administrador/template/cabecera.php"); ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script language="JavaScript">

  function validarFormulario() {
    var disca = document.getElementById('selectdiscapacidad').value;
    var x = document.getElementById('selectdiscapacidad');
    var opt1 = x.options[x.selectedIndex];

    var gesta = document.getElementById('selectgestante').value;
    var y = document.getElementById('selectgestante');    
    var opt2 = y.options[y.selectedIndex];

    var nacion = document.getElementById('selectnacionalidad').value;
    var z = document.getElementById('selectnacionalidad');
    var opt3 = z.options[z.selectedIndex];

    console.log('selectdiscapacidad :', opt1.text);
    console.log('selectgestante :', opt2.text);
    console.log('selectnacionalidad :', opt3.text);      

    if(disca == 0 && gesta == 0 && nacion == 0) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Debe seleccionar un elemento. Intente de nuevo.',
        //footer: '<a href="">Why do I have this issue?</a>'
      })      
      return false;
    }

    if((disca > 0 && gesta > 0) || (disca > 0 && nacion > 0) || (gesta > 0 && nacion > 0)){
      Swal.fire({
        icon:'error', title:'Oops...', text:'Solo debe seleccionar un elemento. Intente de nuevo.'
      })      
      return false;
    } else {
      //alert("Muchas gracias por enviar el formulario");
      //document.frmExcelImport.submit();      
    }
  }

  function cambiarText() {   
    document.getElementById('txtgestante').value = $('select[name="selectgestante"] option:selected').text();
  }
/*
  $(document).ready(function() {
    $("#selectgestante").change(function() {
      document.getElementById('txtgestante').value = $('#selectgestante option:selected').html();
    });
  });
*/
</script>

<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require_once '../../administrador/config/bdPDO.php';

$db_1 = new TransactionSCI();

?>

<div class="col-md-12">

  <div class="card text-dark bg-light">
    <div class="card-header">
      REPORTE TOTAL REACH DE ACTIVIDADES - FILTROS
    </div>
    <div class="card-body">
      <form action="repo_actividades_gestante.php" method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En este apartado podremos generar el reporte en formato Excel que nos permitirá conocer el número de beneficiarios que han participado en cada una de las diferentes actividades segmentada por las siguientes variables:</label>
          <br>
          <br>          
        </div>
        
        <br>
        <div class="row">
          <div class="col-md-3">
            <label>Discapacidad:</label>
            <br><br>
            <select name="selectdiscapacidad" id="selectdiscapacidad" class="form-control-lg" onchange="document.getElementById('txtdiscapacidad').value=this.options[this.selectedIndex].text">
              <option value="0" selected>Seleccione item</option>
              <?php 
              $datos = $db_1->poblar_combobox("SP_list_discapacidad");
              foreach($datos as $value) { ?>
                <option value="<?php echo $value['id_discapacidad']; ?>"><?php echo $value['nom_discapacidad'];?></option>
              <?php } ?>
            </select>
          </div>
          <br>
          <div class="col-md-3">
            <label>Gestantes:</label>
            <br><br>
            <select name="selectgestante" id="selectgestante" onchange="cambiarText()" class="form-control-lg">
              <option value="0" selected>Seleccione item</option>          
              <?php 
              $datos = $db_1->poblar_combobox("SP_list_gestante");
              foreach($datos as $value) { ?>
                <option value="<?php echo $value['id_gestante']; ?>"><?php echo $value['nom_gestante'];?></option>
              <?php } ?>
            </select>
          </div>        
          <div class="col-md-3">
            <label>Nacionalidad:</label>
            <br><br>
            <select name="selectnacionalidad" id="selectnacionalidad" onchange="document.getElementById('txtnacionalidad').value=this.options[this.selectedIndex].text" class="form-control-lg">
              <option value="0" selected>Seleccione item</option>          
              <?php 
              $datos = $db_1->poblar_combobox("SP_list_nacionalidad");
              foreach($datos as $value) { ?>
                <option value="<?php echo $value['id_nacionalidad']; ?>"><?php echo $value['nom_nacionalidad'];?></option>
              <?php } ?>
            </select>
          </div>   
        </div>        
        <br>
        <input type="hidden" id="txtdiscapacidad" name="txtdiscapacidad" value=""/>
        <input type="hidden" id="txtgestante" name="txtgestante" value=""/>
        <input type="hidden" id="txtnacionalidad" name="txtnacionalidad" value=""/>
        
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" onclick="return validarFormulario();" class="btn btn-success btn-lg">Generar Reporte Actividades</button>
        </div>
        
      </form>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class=card-text>
    <div class="<?php if(!empty($type)) { echo $type . " alert alert-success role=alert"; } ?>"><?php if(!empty($var)) { echo $message; } ?>
  </div>
</div>
</div>

<?php include("../../administrador/template/pie.php"); ?>