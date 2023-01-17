<?php include("../template/cabecera.php"); 

//require "vendor/autoload.php";
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("../administrador/config/connection.php");

?>

<!--div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row"-->
      <h1 class="display-8">DATOS PRINCIPALES DEL BENEFICIARIO </h1> 

      <div class="col-lg-12">
        <!--table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%"-->
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed small" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Codigo</th>
              <th>Nombre&nbsp;del&nbsp;Beneficiario</th>
              <th>Primer&nbsp;nombre</th>
              <th>Segundo&nbsp;nombre</th>
              <th>Primer&nbsp;apellido</th>
              <th>Segundo&nbsp;apellido</th>
              <th>Numero&nbsp;de&nbsp;cedula</th>
              <th>Tipo&nbsp;de&nbsp;identificación&nbsp;alternativo</th>
              <th>Numero&nbsp;de&nbsp;identificación&nbsp;alternativo</th>
              <th>Cuál&nbsp;es&nbsp;su&nbsp;número&nbsp;de&nbsp;whatsapp</th>
              <th>Cuál&nbsp;es&nbsp;su&nbsp;número&nbsp;de&nbsp;celular</th>
              <th>Fecha&nbsp;de&nbsp;nacimiento</th>
              <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;Observaciones&nbsp;Beneficiario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estatus&nbsp;Beneficiario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>  
              <th>Acción</th>
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
            scrollX: true,
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
              'url': 'fetch_data_general.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [14]
            },
            ]
          });
        });
        $(document).on('submit', '#updateUser', function(e) {
          e.preventDefault();
      //var tr = $(this).closest('tr');
      var nombre_beneficiario = $('#nombre_beneficiarioField').val();
      var primer_nombre = $('#primer_nombreField').val();
      var segundo_nombre = $('#segundo_nombreField').val();
      var primer_apellido = $('#primer_apellidoField').val();
      var segundo_apellido = $('#segundo_apellidoField').val();
      var numero_cedula = $('#numero_cedulaField').val();
      var tipo_identificacion = $('#tipo_identificacionField').val();
      var numero_identificacion = $('#numero_identificacionField').val();
      var cual_es_su_numero_whatsapp = $('#cual_es_su_numero_whatsappField').val();      
      var cual_es_su_numero_recibir_sms = $('#cual_es_su_numero_recibir_smsField').val();
      var fecha_nacimiento = $('#fecha_nacimientoField').val();
      var observaciones = $('#observacionesField').val();
      var id_estado = $('#id_estadoField').val();

      var codEstatus = $("input[name=estatus]:checked").val();

      var trid = $('#trid').val();
      var id = $('#id').val();           

/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
        //console.log("esta_de_acuerdo : " + esta_de_acuerdo);
        //console.log("Valor seleccionado en RadioButton : " + cod);
        
        $.ajax({
          url: "update_user_general.php",
          type: "post",
          data: {
            nombre_beneficiario: nombre_beneficiario,
            primer_nombre: primer_nombre,
            segundo_nombre: segundo_nombre,
            primer_apellido: primer_apellido,
            segundo_apellido: segundo_apellido,
            numero_cedula: numero_cedula,
            tipo_identificacion: tipo_identificacion,
            numero_identificacion: numero_identificacion,
            cual_es_su_numero_whatsapp: cual_es_su_numero_whatsapp,
            cual_es_su_numero_recibir_sms: cual_es_su_numero_recibir_sms,
            fecha_nacimiento: fecha_nacimiento,
            observaciones: observaciones,
            id_estado: codEstatus,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#tablaUsuarios').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
              var row = table.row("[id='" + trid + "']");
              var nomEst;
              if (codEstatus==1) {
                nomEst = 'Valido'
              } else if (codEstatus==2){
                nomEst = 'Invalido'
              } else if (codEstatus==4){
                nomEst = 'Registro valido posible fraude'
              } else if (codEstatus==5){
                nomEst = 'Registro en espera posible fraude'
              } else if (codEstatus==6){
                nomEst = 'Fraude'
              } else if (codEstatus==7){
                nomEst = 'Abandono'
              } else{
                nomEst = 'En espera'
              }

              row.row("[id='" + trid + "']").data([id, nombre_beneficiario, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, numero_cedula, tipo_identificacion, numero_identificacion, cual_es_su_numero_whatsapp, cual_es_su_numero_recibir_sms,fecha_nacimiento, observaciones, nomEst, button]);
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
        url: "get_single_general.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombre_beneficiarioField').val(json.nombre_beneficiario);
          $('#primer_nombreField').val(json.primer_nombre);
          $('#segundo_nombreField').val(json.segundo_nombre);
          $('#primer_apellidoField').val(json.primer_apellido);
          $('#segundo_apellidoField').val(json.segundo_apellido);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#tipo_identificacionField').val(json.tipo_identificacion);
          $('#numero_identificacionField').val(json.numero_identificacion);
          $('#cual_es_su_numero_whatsappField').val(json.cual_es_su_numero_whatsapp);
          $('#cual_es_su_numero_recibir_smsField').val(json.cual_es_su_numero_recibir_sms);
          $('#fecha_nacimientoField').val(json.fecha_nacimiento);
          $('#observacionesField').val(json.observaciones);
          $('#id_estadoField').val(json.id_estado);
          
          $('#id').val(id);
          $('#trid').val(trid);

          if (json.id_estado == "Valido") {
            $('#exampleModal').find(':radio[name=estatus][value="1"]').prop('checked', true);
          } else if (json.id_estado == "Invalido") {
            $('#exampleModal').find(':radio[name=estatus][value="2"]').prop('checked', true);
          } else if (json.id_estado == "Registro valido posible fraude") {
            $('#exampleModal').find(':radio[name=estatus][value="4"]').prop('checked', true);
          } else if (json.id_estado == "Registro en espera posible fraude") {
            $('#exampleModal').find(':radio[name=estatus][value="5"]').prop('checked', true);
          } else if (json.id_estado == "Fraude") {
            $('#exampleModal').find(':radio[name=estatus][value="6"]').prop('checked', true);
          } else if (json.id_estado == "Abandono") {
            $('#exampleModal').find(':radio[name=estatus][value="7"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=estatus][value="3"]').prop('checked', true);
          }
          //console.log("cual_es_su_numero_whatsapp :" + json.cual_es_su_numero_whatsapp);
          //console.log("cual_es_su_numero_recibir_sms :" + json.cual_es_su_numero_recibir_sms);
        }        
      });
    });

  </script>
  <!-- Modal -->
  <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <!--div class="modal-dialog modal-lg" role="document"-->
    <div class="modal-dialog modal-lg" role="document">
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
                <input id="fecha_nacimientoField" type="date" name="fecha" value="2017-06-01">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="observacionesField" class="col-md-4 form-label">Observaciones</label>
              <div class="col-md-8">
                <textarea name="text" id="observacionesField" rows="3" cols="65" maxlength="250"></textarea>
              </div>
            </div>    
            <div class="mb-3 row">
              <label for="id_estadoField" class="col-md-3 form-label">Estatus</label>
              <div class="col-md-9">
                <div class="custom-control custom-radio">
                  <input type="radio" id="id_estadoField1" name="estatus" class="custom-control-input" value="1">
                  <label class="custom-control-label" for="customRadio1">REGISTRO VALIDO</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="id_estadoField2" name="estatus" class="custom-control-input" value="2">
                  <label class="custom-control-label" for="customRadio2">REGISTRO INVALIDO</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="id_estadoField3" name="estatus" class="custom-control-input" value="3">
                  <label class="custom-control-label" for="customRadio3">REGISTRO EN ESPERA</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="id_estadoField4" name="estatus" class="custom-control-input" value="4">
                  <label class="custom-control-label" for="customRadio4">REGISTRO VALIDO POSIBLE FRAUDE</label>
                </div>                                
                <div class="custom-control custom-radio">
                  <input type="radio" id="id_estadoField5" name="estatus" class="custom-control-input" value="5">
                  <label class="custom-control-label" for="customRadio5">REGISTRO EN ESPERA POSIBLE FRAUDE</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="id_estadoField6" name="estatus" class="custom-control-input" value="6">
                  <label class="custom-control-label" for="customRadio6">FRAUDE</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="id_estadoField7" name="estatus" class="custom-control-input" value="7">
                  <label class="custom-control-label" for="customRadio7">ABANDONO</label>
                </div>                
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