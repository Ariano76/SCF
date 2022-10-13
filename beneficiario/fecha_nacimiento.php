<?php include("../template/cabecera.php"); 

//require "vendor/autoload.php";
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("../administrador/config/connection.php");

?>

<!--div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row"-->
      <h1 class="display-8">INCONSISTENCIA EN LA FECHA DE NACIMIENTO</h1> 

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Codigo</th>
              <th>Cédula&nbsp;Beneficiario&nbsp;Principal</th>
              <th>Primer&nbsp;nombre</th>
              <th>Genero</th>
              <th>Fecha&nbsp;de&nbsp;nacimiento</th>
              <th>Edad</th>
              <th>Relación</th>
              <!--th>Acción</th-->
            </tr>
          </thead>
        </table>   
      </div>


      <script type="text/javascript">
        $(document).ready(function() {
          $('#tablaUsuarios').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
              $(nRow).attr('id', aData[0]);
            },
            //scrollX: true,
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
              'url': 'fetch_data_fecha_nacimiento.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [6]
            },
            ]
          });
        });
        $(document).on('submit', '#updateUser', function(e) {
          e.preventDefault();
      //var tr = $(this).closest('tr');
      var cedula_beneficiario_principal = $('#cedula_beneficiario_principalField').val();
      var nombre = $('#nombreField').val();
      var genero = $('#generoField').val();
      var fecha_nacimiento = $('#fecha_nacimientoField').val();
      var edad = $('#edadField').val();
      var relacion = $('#relacionField').val();

      var trid = $('#trid').val();
      var id = $('#id').val();           

/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
        //console.log("esta_de_acuerdo : " + esta_de_acuerdo);
        //console.log("Valor seleccionado en RadioButton : " + cod);
        
        $.ajax({
          url: "update_user_fecha_nacimiento.php",
          type: "post",
          data: {
            cedula_beneficiario_principal: cedula_beneficiario_principal,
            nombre: nombre,
            genero: genero,
            fecha_nacimiento: fecha_nacimiento,
            edad: edad,
            relacion: relacion,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#tablaUsuarios').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, cedula_beneficiario_principal, nombre, genero, fecha_nacimiento, edad, relacion, button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
/*      } else {
        alert('Fill all the required fields');
      }*/
    });
    $('#tablaUsuarios').on('click', '.editbtn ', function(event) {
    var table = $('#tablaUsuarios').DataTable();
    var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_single_fecha_nacimiento.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#cedula_beneficiario_principalField').val(json.cedula_beneficiario_principal);
          $('#nombreField').val(json.nombre);
          $('#generoField').val(json.genero);
          $('#fecha_nacimientoField').val(json.fecha_nacimiento);
          $('#edadField').val(json.edad);
          $('#relacionField').val(json.relacion);
          
          $('#id').val(id);
          $('#trid').val(trid);

          //console.log("cual_es_su_numero_whatsapp :" + json.cual_es_su_numero_whatsapp);
          //console.log("cual_es_su_numero_recibir_sms :" + json.cual_es_su_numero_recibir_sms);
        }        
      })
    });

  </script>
  <!-- Modal -->
  <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <!--div class="modal-dialog modal-lg" role="document"-->
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS GENERALES BENEFICIARIO</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            
            <div class="mb-3 row">
              <label for="nombre_beneficiarioField" class="col-md-4 form-label">Nombre del Beneficiario</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="nombre_beneficiarioField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="primer_nombreField" class="col-md-4 form-label">1er Nombre</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="primer_nombreField" name="name1" maxlength="50">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_nombreField" class="col-md-4 form-label">2do Nombre</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="segundo_nombreField" name="name2" maxlength="50">
              </div> 
            </div>
            <div class="mb-3 row">
              <label for="primer_apellidoField" class="col-md-4 form-label">1er Apelido</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="primer_apellidoField" name="ape1" maxlength="50">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_apellidoField" class="col-md-4 form-label">2do Apellido</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="segundo_apellidoField" name="ape2" maxlength="50">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_cedulaField" class="col-md-4 form-label">Numero cedula</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="numero_cedulaField" name="cedula" maxlength="25">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tipo_identificacionField" class="col-md-4 form-label">Tipo identificación</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="tipo_identificacionField" name="tipoident" maxlength="50">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_identificacionField" class="col-md-4 form-label">Numero identificación</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="numero_identificacionField" name="numiden" maxlength="25">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cual_es_su_numero_whatsappField" class="col-md-4 form-label">Cual es su numero de Whatsapp</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="cual_es_su_numero_whatsappField" name="whatsapp" maxlength="25" pattern="[0-9]+">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cual_es_su_numero_recibir_smsField" class="col-md-4 form-label">Cual es su numero de SMS</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="cual_es_su_numero_recibir_smsField" name="sms" maxlength="25" pattern="[0-9]+">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="fecha_nacimientoField" class="col-md-4 form-label">Fecha nacimiento</label>
              <div class="col-md-8">
                <!--input type="text" class="form-control" id="fecha_nacimientoField" name="fecha"-->
                <input id="fecha_nacimientoField" type="date" name="fecha" value="2017-06-01">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <?php include("../template/pie.php"); ?>