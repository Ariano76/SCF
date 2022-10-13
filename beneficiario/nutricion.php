<?php include("../template/cabecera.php"); 

//require "vendor/autoload.php";
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("../administrador/config/connection.php");

?>

<!--div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row"-->
      <h1 class="display-8">DATOS DE NUTRICION</h1> 

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Codigo</th>
              <th>Nombres&nbsp;y&nbsp;apellidos&nbsp;del&nbsp;beneficiario</th>
              <th>Número&nbsp;de&nbsp;Cedula</th>                                
              <th>¿Alguien&nbsp;de&nbsp;su&nbsp;hogar&nbsp;esta&nbsp;embarazada?</th>  
              <th>¿Cuál&nbsp;es&nbsp;el&nbsp;tiempo&nbsp;de&nbsp;gestación?</th>
              <th>¿Lleva&nbsp;su&nbsp;control&nbsp;en&nbsp;centro&nbsp;de&nbsp;salud?</th>
              <th>¿Alguien&nbsp;de&nbsp;su&nbsp;hogar&nbsp;tiene&nbsp;las&nbsp;siguientes&nbsp;condiciones?</th>
              <th>Lactando&nbsp;con&nbsp;NN&nbsp;<2años</th>
              <th>No&nbsp;lactando&nbsp;con&nbsp;NN&nbsp;<2&nbsp;años</th>
              <th>Madre&nbsp;de&nbsp;NN&nbsp;2&nbsp;-&nbsp;5&nbsp;años</th>
              <th>Ninguno</th>
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
              'url': 'fetch_data_nutricion.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [11]
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
      var alguien_de_su_hogar_esta_embarazada = $('#alguien_de_su_hogar_esta_embarazadaField').val();
      var tiempo_de_gestacion = $('#tiempo_de_gestacionField').val();
      var lleva_su_control_en_centro_de_salud = $('#lleva_su_control_en_centro_de_saludField').val();
      var alguien_de_su_hogar_tiene_siguientes_condiciones = $('#alguien_de_su_hogar_tiene_siguientes_condicionesField').val();
      var lactando_con_nn_menor_2_anios = $('#lactando_con_nn_menor_2_aniosField').val();
      var no_lactando_con_nn_menor_2_anios = $('#no_lactando_con_nn_menor_2_aniosField').val();
      var madre_nn_2_a_5_anios = $('#madre_nn_2_a_5_aniosField').val();
      var ninguno = $('#ningunoField').val();
      
      var codEmbarazada = $("input[name=embarazada]:checked").val();
      var codSalud = $("input[name=salud]:checked").val();
      var codLactando = $("input[name=lactando]:checked").val();
      var codNoLactando = $("input[name=nolactando]:checked").val();
      var codMadre = $("input[name=madre]:checked").val();
      var codNinguno = $("input[name=ninguno]:checked").val();

      var trid = $('#trid').val();
      var id = $('#id').val();           

/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
        //console.log("esta_de_acuerdo : " + esta_de_acuerdo);
        
        $.ajax({
          url: "update_user_nutricion.php",
          type: "post",
          data: {
            nombre: nombre,
            numero_cedula: numero_cedula,
            alguien_de_su_hogar_esta_embarazada: codEmbarazada,
            tiempo_de_gestacion: tiempo_de_gestacion,
            lleva_su_control_en_centro_de_salud: codSalud,
            alguien_de_su_hogar_tiene_siguientes_condiciones: alguien_de_su_hogar_tiene_siguientes_condiciones,
            lactando_con_nn_menor_2_anios: codLactando,
            no_lactando_con_nn_menor_2_anios: codNoLactando,
            madre_nn_2_a_5_anios: codMadre,
            ninguno: codNinguno,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#tablaUsuarios').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, nombre,  numero_cedula, codEmbarazada, tiempo_de_gestacion, codSalud, alguien_de_su_hogar_tiene_siguientes_condiciones, codLactando, codNoLactando, codMadre, codNinguno, button]);
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
        url: "get_single_nutricion.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombreField').val(json.nombre);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#alguien_de_su_hogar_esta_embarazadaField').val(json.alguien_de_su_hogar_esta_embarazada);
          $('#tiempo_de_gestacionField').val(json.tiempo_de_gestacion);
          $('#lleva_su_control_en_centro_de_saludField').val(json.lleva_su_control_en_centro_de_salud);
          $('#alguien_de_su_hogar_tiene_siguientes_condicionesField').val(json.alguien_de_su_hogar_tiene_siguientes_condiciones);
          $('#lactando_con_nn_menor_2_aniosField').val(json.lactando_con_nn_menor_2_anios);
          $('#no_lactando_con_nn_menor_2_aniosField').val(json.no_lactando_con_nn_menor_2_anios);
          $('#madre_nn_2_a_5_aniosField').val(json.madre_nn_2_a_5_anios);
          $('#ningunoField').val(json.ninguno);
          $('#id').val(id);
          $('#trid').val(trid);

          //console.log("La Respuesta esta_de_acuerdoField es :" + json.esta_de_acuerdo);

          if (json.alguien_de_su_hogar_esta_embarazada == "1") {
            $('#exampleModal').find(':radio[name=embarazada][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=embarazada][value="0"]').prop('checked', true);
          }

          if (json.lleva_su_control_en_centro_de_salud == "1") {
            $('#exampleModal').find(':radio[name=salud][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=salud][value="0"]').prop('checked', true);
          }

          if (json.lactando_con_nn_menor_2_anios == "1") {
            $('#exampleModal').find(':radio[name=lactando][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=lactando][value="0"]').prop('checked', true);
          }
          if (json.no_lactando_con_nn_menor_2_anios == "1") {
            $('#exampleModal').find(':radio[name=nolactando][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=nolactando][value="0"]').prop('checked', true);
          }
          if (json.madre_nn_2_a_5_anios == "1") {
            $('#exampleModal').find(':radio[name=madre][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=madre][value="0"]').prop('checked', true);
          }
          if (json.ninguno == "1") {
            $('#exampleModal').find(':radio[name=ninguno][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=ninguno][value="0"]').prop('checked', true);
          }

        }        
      })
    });

  </script>
  <!-- Modal -->
  <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <!--div class="modal-dialog modal-lg" role="document"-->
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS NUTRICION</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            
            <div class="mb-3 row">
              <label for="nombreField" class="col-md-5 form-label">Nombre Beneficiario</label>
              <div class="col-md-7">
                <input type="text" class="form-control" id="nombreField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_cedulaField" class="col-md-5 form-label">Número Cedula</label>
              <div class="col-md-7">
                <input type="text" class="form-control" id="numero_cedulaField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alguien_de_su_hogar_esta_embarazadaField" class="col-md-5 form-label">¿Alguien de su hogar esta embarazada?</label>
              <div class="col-md-7">
                <label class="radio-inline">
                  <input type="radio" name="embarazada" id="alguien_de_su_hogar_esta_embarazadaField1" value="1"> Si 
                  <input type="radio" name="embarazada" id="alguien_de_su_hogar_esta_embarazadaField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tiempo_de_gestacionField" class="col-md-5 form-label">Tiempo de gestación</label>
              <div class="col-md-7">
                <input type="text" class="form-control" id="tiempo_de_gestacionField" maxlength="250" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="lleva_su_control_en_centro_de_saludField" class="col-md-5 form-label">¿Lleva su control en centro de salud?</label>
              <div class="col-md-7">
                <label class="radio-inline">
                  <input type="radio" name="salud" id="lleva_su_control_en_centro_de_saludField1" value="1"> Si 
                  <input type="radio" name="salud" id="lleva_su_control_en_centro_de_saludField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alguien_de_su_hogar_tiene_siguientes_condicionesField" class="col-md-5 form-label">¿Alguien de su hogar tiene siguientes condiciones?</label>
              <div class="col-md-7">
                <input type="text" class="form-control" maxlength="250" id="alguien_de_su_hogar_tiene_siguientes_condicionesField" name="name">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="lactando_con_nn_menor_2_aniosField" class="col-md-5 form-label">Lactando con NN menor 2 años</label>
              <div class="col-md-7">
                <label class="radio-inline">
                  <input type="radio" name="lactando" id="lactando_con_nn_menor_2_aniosField1" value="1"> Si 
                  <input type="radio" name="lactando" id="lactando_con_nn_menor_2_aniosField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="no_lactando_con_nn_menor_2_aniosField" class="col-md-5 form-label">No lactando con NN menor 2 años</label>
              <div class="col-md-7">
                <label class="radio-inline">
                  <input type="radio" name="nolactando" id="no_lactando_con_nn_menor_2_aniosField1" value="1"> Si 
                  <input type="radio" name="nolactando" id="no_lactando_con_nn_menor_2_aniosField2" value="0"> No 
                </label>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="madre_nn_2_a_5_aniosField" class="col-md-5 form-label">Madre NN de 2 a 5 años</label>
              <div class="col-md-7">
                <label class="radio-inline">
                  <input type="radio" name="madre" id="madre_nn_2_a_5_aniosField1" value="1"> Si 
                  <input type="radio" name="madre" id="madre_nn_2_a_5_aniosField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="ningunoField" class="col-md-5 form-label">Ninguno</label>
              <div class="col-md-7">
                <label class="radio-inline">
                  <input type="radio" name="ninguno" id="ningunoField1" value="1"> Si 
                  <input type="radio" name="ninguno" id="ningunoField2" value="0"> No 
                </label>
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