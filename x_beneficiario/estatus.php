<?php include("../template/cabecera.php"); 

include("../administrador/config/connection.php");

?>
<h1 class="display-8">ESTATUS DEL BENEFICIARIO</h1> 

<div class="col-lg-12">
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed small" style="width:100%">
    <!--table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%"-->
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Nombres&nbsp;y&nbsp;apellidos&nbsp;del&nbsp;beneficiario</th>
        <th>Número&nbsp;de&nbsp;Cedula</th>                                
        <th>Observaciones</th>  
        <th>Estatus</th>  
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
        'url': 'fetch_data_estatus.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [5]
      },
      ]
    });
  });
        /*$(document).ready(function(){
          $("#exampleModal").find("input[type=radio]").click(function() {
            alert($('input[type=radio]:checked').val());
          });
        });*/
        $(document).on('submit', '#updateUser', function(e) {
          e.preventDefault();
      //var tr = $(this).closest('tr');
      var nombre = $('#nombreField').val();
      var numero_cedula = $('#numero_cedulaField').val();
      var observaciones = $('#observacionesField').val();
      var id_estado = $('#id_estadoField').val();

      var codEstatus = $("input[name=estatus]:checked").val();

      var trid = $('#trid').val();
      var id = $('#id').val();           
/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
  $.ajax({
    url: "update_user_estatus.php",
    type: "post",
    data: {
      nombre: nombre,
      numero_cedula: numero_cedula,
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
          nomEst = 'VALIDO'
        } else if (codEstatus==2){
          nomEst = 'INVALIDO'
        } else if (codEstatus==4){
          nomEst = 'REGISTRO VALIDO POSIBLE FRAUDE'
        } else if (codEstatus==5){
          nomEst = 'REGISTRO EN ESPERA POSIBLE FRAUDE'
        } else if (codEstatus==6){
          nomEst = 'FRAUDE'
        } else if (codEstatus==7){
          nomEst = 'ABANDONO'
        } else{
          nomEst = 'EN ESPERA'
        }

        row.row("[id='" + trid + "']").data([id, nombre, numero_cedula, observaciones, nomEst, button]);
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
        url: "get_single_estatus.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombreField').val(json.nombre);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#observacionesField').val(json.observaciones);
          $('#id_estadoField').val(json.id_estado);

          $('#id').val(id);
          $('#trid').val(trid);
          //console.log("La Respuesta esta_de_acuerdoField es :" + json.esta_de_acuerdo);
          if (json.id_estado == "VALIDO") {
            $('#exampleModal').find(':radio[name=estatus][value="1"]').prop('checked', true);
          } else if (json.id_estado == "INVALIDO") {
            $('#exampleModal').find(':radio[name=estatus][value="2"]').prop('checked', true);
          } else if (json.id_estado == "REGISTRO VALIDO POSIBLE FRAUDE") {
            $('#exampleModal').find(':radio[name=estatus][value="4"]').prop('checked', true);
          } else if (json.id_estado == "REGISTRO EN ESPERA POSIBLE FRAUDE") {
            $('#exampleModal').find(':radio[name=estatus][value="5"]').prop('checked', true);
          } else if (json.id_estado == "FRAUDE") {
            $('#exampleModal').find(':radio[name=estatus][value="6"]').prop('checked', true);
          } else if (json.id_estado == "ABANDONO") {
            $('#exampleModal').find(':radio[name=estatus][value="7"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=estatus][value="3"]').prop('checked', true);
          }

        }
      })
    });

  </script>
  <!-- Modal -->
  <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <!--div class="modal-dialog" role="document"-->
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR ESTATUS BENEFICIARIO</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            
            <div class="mb-3 row">
              <label for="nombreField" class="col-md-3 form-label">Nombre Beneficiario</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nombreField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_cedulaField" class="col-md-3 form-label">Número Cedula</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="numero_cedulaField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="observacionesField" class="col-md-3 form-label">Observaciones</label>
              <div class="col-md-9">
                <!--input type="text" class="form-control" id="observacionesField" name="name"-->
                <textarea name="text" id="observacionesField" rows="3" cols="70" maxlength="250"></textarea>
              </div>
            </div>            
            <div class="mb-3 row">
              <label for="id_estadoField" class="col-md-3 form-label">Estatus</label>
              <div class="col-md-9">
                <!--label class="radio-inline">
                  <input type="radio" name="estatus" id="id_estadoField1" value="1"> REGISTRO VALIDO 
                  <input type="radio" name="estatus" id="id_estadoField2" value="2"> REGISTRO INVALIDO 
                  <input type="radio" name="estatus" id="id_estadoField3" value="3"> REGISTRO EN ESPERA 
                </label-->
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