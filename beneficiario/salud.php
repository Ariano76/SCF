<?php include("../template/cabecera.php"); 

//require "vendor/autoload.php";
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("../administrador/config/connection.php");

?>

<!--div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row"-->
      <h1 class="display-8">DATOS DE SALUD</h1> 

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Codigo</th>
              <th>Nombres&nbsp;y&nbsp;apellidos&nbsp;del&nbsp;beneficiario</th>
              <th>Número&nbsp;de&nbsp;Cedula</th>                                
              <th>¿Algun&nbsp;miembro&nbsp;de&nbsp;su&nbsp;hogar&nbsp;tiene&nbsp;discapacidad?</th>  
              <th>¿Algun&nbsp;miembro&nbsp;de&nbsp;problemas&nbsp;de&nbsp;salud?</th>  
              <th>Elegible&nbsp;para&nbsp;derivación&nbsp;Salud</th>
              <th>Elegible&nbsp;para&nbsp;derivación&nbsp;Protección</th>
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
              'url': 'fetch_data_salud.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [7]
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
      var algun_miembro_tiene_discapacidad = $('#algun_miembro_tiene_discapacidadField').val();
      var algun_miembro_tiene_problemas_salud = $('#algun_miembro_tiene_problemas_saludField').val();
      var derivacion_salud = $('#derivacion_saludField').val();
      var derivacion_proteccion = $('#derivacion_proteccionField').val();

      var trid = $('#trid').val();
      var id = $('#id').val();           

/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
        //console.log("esta_de_acuerdo : " + esta_de_acuerdo);
        
        $.ajax({
          url: "update_user_salud.php",
          type: "post",
          data: {
            nombre: nombre,
            numero_cedula: numero_cedula,
            algun_miembro_tiene_discapacidad: algun_miembro_tiene_discapacidad,
            algun_miembro_tiene_problemas_salud: algun_miembro_tiene_problemas_salud,
            derivacion_salud: derivacion_salud,
            derivacion_proteccion: derivacion_proteccion,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#tablaUsuarios').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, nombre,  numero_cedula, algun_miembro_tiene_discapacidad, algun_miembro_tiene_problemas_salud, derivacion_salud, derivacion_proteccion, button]);
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
        url: "get_single_salud.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombreField').val(json.nombre);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#algun_miembro_tiene_discapacidadField').val(json.algun_miembro_tiene_discapacidad);
          $('#algun_miembro_tiene_problemas_saludField').val(json.algun_miembro_tiene_problemas_salud);
          $('#derivacion_saludField').val(json.derivacion_salud);
          $('#derivacion_proteccionField').val(json.derivacion_proteccion);
          $('#id').val(id);
          $('#trid').val(trid);

          //console.log("La Respuesta esta_de_acuerdoField es :" + json.esta_de_acuerdo);

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
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS SALUD</h5>
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
              <label for="algun_miembro_tiene_discapacidadField" class="col-md-3 form-label">¿Algun miembro tiene discapacidad?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" maxlength="250" id="algun_miembro_tiene_discapacidadField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="algun_miembro_tiene_problemas_saludField" class="col-md-3 form-label">¿Algun miembro tiene problemas de salud?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" maxlength="250" id="algun_miembro_tiene_problemas_saludField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="derivacion_saludField" class="col-md-3 form-label">Derivación Salud</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="derivacion_saludField" maxlength="250" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="derivacion_proteccionField" class="col-md-3 form-label">Derivación Protección</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="derivacion_proteccionField" maxlength="250" name="name">
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