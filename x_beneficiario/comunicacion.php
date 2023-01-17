<?php include("../template/cabecera.php"); 

include("../administrador/config/connection.php");

?>

      <h1 class="display-8">DATOS DE COMUNICACION</h1> 

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Codigo</th>
              <th>Nombres&nbsp;y&nbsp;apellidos&nbsp;del&nbsp;beneficiario</th>
              <th>Número&nbsp;de&nbsp;Cedula</th>
              <th>¿&nbsp;Podria&nbsp;decirnos&nbsp;cuales&nbsp;son&nbsp;los&nbsp;medios&nbsp;de&nbsp;comunicación&nbsp;con&nbsp;los&nbsp;que&nbsp;cuenta&nbsp;?</th>
              <th>¿Tiene&nbsp;celular&nbsp;basico?</th>                                
              <th>¿Tiene&nbsp;smartphone?</th>  
              <th>¿Tiene&nbsp;laptop?</th>
              <th>Ninguno</th>
              <th>¿Cuál&nbsp;es&nbsp;su&nbsp;número&nbsp;whatsapp?</th>
              <th>¿Cuál&nbsp;es&nbsp;su&nbsp;número&nbsp;para&nbsp;recibir&nbsp;sms?</th>
              <th>¿Cuál&nbsp;número&nbsp;usa&nbsp;con&nbsp;mayor&nbsp;frecuencia?</th>
              <th>¿Es&nbsp;telefono&nbsp;propio?</th>
              <th>¿Como&nbsp;es&nbsp;su&nbsp;acceso&nbsp;a&nbsp;internet&nbsp;con&nbsp;mayor&nbsp;frecuencia&nbsp;,&nbsp;Plan&nbsp;de&nbsp;datos&nbsp;o&nbsp;Prepago? </th>
              <th>&nbsp;&nbsp;¿&nbsp;Podria&nbsp;decirnos&nbsp;cuál&nbsp;es&nbsp;la&nbsp;dirección&nbsp;de&nbsp;su&nbsp;actual&nbsp;residencia&nbsp;?&nbsp;&nbsp;</th>
              <th>¿Vive&nbsp;o&nbsp;viaja&nbsp;con&nbsp;otros&nbsp;familiares?</th>
              <th>¿Cuantos&nbsp;viven&nbsp;o&nbsp;viajan&nbsp;con&nbsp;usted?</th>
              <th>¿Cuantos&nbsp;tienen&nbsp;ingreso&nbsp;económico&nbsp;por&nbsp;trabajo?</th>
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
              'url': 'fetch_data_comunicacion.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [17]
            },
            ]
          });
        });
        $(document).on('submit', '#updateUser', function(e) {
          e.preventDefault();
      //var tr = $(this).closest('tr');
      var nombre = $('#nombreField').val();
      var numero_cedula = $('#numero_cedulaField').val();
      var tiene_los_siguientes_medios_comunicacion = $('#tiene_los_siguientes_medios_comunicacionField').val();
      var celular_basico = $('#celular_basicoField').val();
      var smartphone = $('#smartphoneField').val();
      var laptop = $('#laptopField').val();
      var ninguno = $('#ningunoField').val();
      var cual_es_su_numero_whatsapp = $('#cual_es_su_numero_whatsappField').val();
      var cual_es_su_numero_recibir_sms = $('#cual_es_su_numero_recibir_smsField').val();
      var cual_numero_usa_con_frecuencia = $('#cual_numero_usa_con_frecuenciaField').val();
      var es_telefono_propio = $('#es_telefono_propioField').val();
      var como_accede_a_internet = $('#como_accede_a_internetField').val();
      var cual_es_su_direccion = $('#cual_es_su_direccionField').val();
      var vive_o_viaja_con_otros_familiares = $('#vive_o_viaja_con_otros_familiaresField').val();
      var cuantos_viven_o_viajan_con_usted = $('#cuantos_viven_o_viajan_con_ustedField').val();
      var cuantos_tienen_ingreso_por_trabajo = $('#cuantos_tienen_ingreso_por_trabajoField').val();
      
      var codCelular = $("input[name=celular]:checked").val();
      var codSmartPhone = $("input[name=smartphone]:checked").val();
      var codLaptop = $("input[name=laptop]:checked").val();
      var codNinguno = $("input[name=ninguno]:checked").val();
      var codPropio = $("input[name=propio]:checked").val();
      var codFamilia = $("input[name=familia]:checked").val();

      var trid = $('#trid').val();
      var id = $('#id').val();           
        //console.log("esta_de_acuerdo : " + esta_de_acuerdo);
        //console.log("Valor seleccionado en RadioButton : " + cod);
        
        $.ajax({
          url: "update_user_comunicacion.php",
          type: "post",
          data: {
            nombre: nombre,
            numero_cedula: numero_cedula,
            tiene_los_siguientes_medios_comunicacion: tiene_los_siguientes_medios_comunicacion,
            celular_basico: codCelular,
            smartphone: codSmartPhone,
            laptop: codLaptop,
            ninguno: codNinguno,
            cual_es_su_numero_whatsapp: cual_es_su_numero_whatsapp,
            cual_es_su_numero_recibir_sms: cual_es_su_numero_recibir_sms,
            cual_numero_usa_con_frecuencia: cual_numero_usa_con_frecuencia,
            es_telefono_propio: codPropio,
            como_accede_a_internet: como_accede_a_internet,
            cual_es_su_direccion: cual_es_su_direccion,
            vive_o_viaja_con_otros_familiares: codFamilia,
            cuantos_viven_o_viajan_con_usted: cuantos_viven_o_viajan_con_usted,
            cuantos_tienen_ingreso_por_trabajo: cuantos_tienen_ingreso_por_trabajo,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#tablaUsuarios').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, nombre, numero_cedula, tiene_los_siguientes_medios_comunicacion, codCelular, codSmartPhone, codLaptop, codNinguno, cual_es_su_numero_whatsapp, cual_es_su_numero_recibir_sms, cual_numero_usa_con_frecuencia, codPropio, como_accede_a_internet, cual_es_su_direccion, codFamilia, cuantos_viven_o_viajan_con_usted,  cuantos_tienen_ingreso_por_trabajo, button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
    });
$('#tablaUsuarios').on('click', '.editbtn ', function(event) {
  var table = $('#tablaUsuarios').DataTable();
  var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_single_comunicacion.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombreField').val(json.nombre);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#tiene_los_siguientes_medios_comunicacionField').val(json.tiene_los_siguientes_medios_comunicacion);
          $('#celular_basicoField').val(json.celular_basico);
          $('#smartphoneField').val(json.smartphone);
          $('#laptopField').val(json.laptop);
          $('#ningunoField').val(json.ninguno);
          $('#cual_es_su_numero_whatsappField').val(json.cual_es_su_numero_whatsapp);
          $('#cual_es_su_numero_recibir_smsField').val(json.cual_es_su_numero_recibir_sms);
          $('#cual_numero_usa_con_frecuenciaField').val(json.cual_numero_usa_con_frecuencia);
          $('#es_telefono_propioField').val(json.es_telefono_propio);
          $('#como_accede_a_internetField').val(json.como_accede_a_internet);
          $('#cual_es_su_direccionField').val(json.cual_es_su_direccion);
          $('#vive_o_viaja_con_otros_familiaresField').val(json.vive_o_viaja_con_otros_familiares);
          $('#cuantos_viven_o_viajan_con_ustedField').val(json.cuantos_viven_o_viajan_con_usted);
          $('#cuantos_tienen_ingreso_por_trabajoField').val(json.cuantos_tienen_ingreso_por_trabajo);

          $('#id').val(id);
          $('#trid').val(trid);

          //console.log("La Respuesta esta_de_acuerdoField es :" + json.esta_de_acuerdo);

          if (json.celular_basico == "1") {
            $('#exampleModal').find(':radio[name=celular][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=celular][value="0"]').prop('checked', true);
          }

          if (json.smartphone == "1") {
            $('#exampleModal').find(':radio[name=smartphone][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=smartphone][value="0"]').prop('checked', true);
          }

          if (json.laptop == "1") {
            $('#exampleModal').find(':radio[name=laptop][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=laptop][value="0"]').prop('checked', true);
          }
          if (json.ninguno == "1") {
            $('#exampleModal').find(':radio[name=ninguno][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=ninguno][value="0"]').prop('checked', true);
          }
          if (json.es_telefono_propio == "1") {
            $('#exampleModal').find(':radio[name=propio][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=propio][value="0"]').prop('checked', true);
          }
          if (json.vive_o_viaja_con_otros_familiares == "1") {
            $('#exampleModal').find(':radio[name=familia][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=familia][value="0"]').prop('checked', true);
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
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS COMUNICACION</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            
            <div class="mb-3 row">
              <label for="nombreField" class="col-md-3 form-label">Nombre&nbsp;Beneficiario</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nombreField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_cedulaField" class="col-md-3 form-label">Número&nbsp;de&nbsp;cedula</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="numero_cedulaField" name="name" disabled>
              </div>
            </div>            
            <div class="mb-3 row">
              <label for="tiene_los_siguientes_medios_comunicacionField" class="col-md-3 form-label">¿Tiene los siguientes medios de comunicación?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tiene_los_siguientes_medios_comunicacionField" name="email" maxlength="250" >
              </div>
            </div>
            <div class="mb-3 row">
              <label for="celular_basicoField" class="col-md-3 form-label">Celular basico</label>
              <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="celular" id="celular_basicoField1" value="1"> Si 
                  <input type="radio" name="celular" id="celular_basicoField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="smartphoneField" class="col-md-3 form-label">Smartphone</label>
              <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="smartphone" id="smartphoneField1" value="1"> Si 
                  <input type="radio" name="smartphone" id="smartphoneField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="laptopField" class="col-md-3 form-label">Laptop</label>
              <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="laptop" id="laptopField1" value="1"> Si 
                  <input type="radio" name="laptop" id="laptopField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="ningunoField" class="col-md-3 form-label">Ninguno</label>
              <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="ninguno" id="ningunoField1" value="1"> Si 
                  <input type="radio" name="ninguno" id="ningunoField2" value="0"> No 
                </label>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="cual_es_su_numero_whatsappField" class="col-md-3 form-label">¿Cuál es su número de Whatsapp?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cual_es_su_numero_whatsappField" name="mobile" maxlength="50" pattern="[0-9]+">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cual_es_su_numero_recibir_smsField" class="col-md-3 form-label">¿Cuál es su número para recibir SMS?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cual_es_su_numero_recibir_smsField" name="City" maxlength="50" pattern="[0-9]+">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cual_numero_usa_con_frecuenciaField" class="col-md-3 form-label">¿Cuál número usa con mayor frecuencia?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cual_numero_usa_con_frecuenciaField" name="City" maxlength="250">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="es_telefono_propioField" class="col-md-3 form-label">¿Es telefono propio?</label>
              <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="propio" id="es_telefono_propioField1" value="1"> Si 
                  <input type="radio" name="propio" id="es_telefono_propioField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="como_accede_a_internetField" class="col-md-3 form-label">¿Como accede a internet?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="como_accede_a_internetField" name="City" maxlength="250">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cual_es_su_direccionField" class="col-md-3 form-label">¿Cuál es su dirección?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cual_es_su_direccionField" maxlength="250" name="City">
              </div>
            </div>

            <div class="mb-3 row">
              <label for="vive_o_viaja_con_otros_familiaresField" class="col-md-3 form-label">¿Vive o viaja con otros familiares?</label>
              <div class="col-md-9">
                <label class="radio-inline">
                  <input type="radio" name="familia" id="vive_o_viaja_con_otros_familiaresField1" value="1"> Si 
                  <input type="radio" name="familia" id="vive_o_viaja_con_otros_familiaresField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cuantos_viven_o_viajan_con_ustedField" class="col-md-3 form-label">¿Cuantos viven o viajan con usted?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cuantos_viven_o_viajan_con_ustedField" name="City" maxlength="250">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cuantos_tienen_ingreso_por_trabajoField" class="col-md-3 form-label">¿Cuantos tienen ingreso por trabajo?</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cuantos_tienen_ingreso_por_trabajoField" name="City" maxlength="250">
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