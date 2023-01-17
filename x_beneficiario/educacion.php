<?php include("../template/cabecera.php"); 

include("../administrador/config/connection.php");

?>

<h1 class="display-8">DATOS DE EDUCACIÓN</h1> 

<div class="col-lg-12">
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Nombres&nbsp;y&nbsp;apellidos&nbsp;del&nbsp;beneficiario</th>
        <th>Número&nbsp;de&nbsp;Cedula</th>                                
        <th>¿Viaja&nbsp;con&nbsp;menores&nbsp;de&nbsp;17&nbsp;años?</th>  
        <th>¿Todos&nbsp;los&nbsp;NNA&nbsp;estan&nbsp;matriculados?</th>
        <th>&nbsp;¿&nbsp;Cuál&nbsp;es&nbsp;el&nbsp;dispositivo&nbsp;que&nbsp;utilizan&nbsp;los&nbsp;menores&nbsp;para&nbsp;participar&nbsp;de&nbsp;las&nbsp;clases&nbsp;virtuales&nbsp;?&nbsp;</th>
        <th>Celular&nbsp;basico</th>
        <th>Smartphone</th>
        <th>Laptop</th>
        <th>Ninguno</th>
        <th>&nbsp;&nbsp;¿&nbsp;Comentenos&nbsp;que&nbsp;dificultades&nbsp;ha&nbsp;tenido&nbsp;para&nbsp;matricular&nbsp;a&nbsp;los&nbsp;menores&nbsp;en&nbsp;la&nbsp;escuela&nbsp;?&nbsp;&nbsp;</th>
        <th>No&nbsp;conocia&nbsp;el&nbsp;procedimiento&nbsp;de&nbsp;matricula</th>
        <th>No&nbsp;cuento&nbsp;con&nbsp;los&nbsp;documentos&nbsp;necesarios</th>
        <th>No&nbsp;tenian&nbsp;vacante&nbsp;en&nbsp;la&nbsp;escuela</th>
        <th>Otro</th>
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
        'url': 'fetch_data_educacion.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [15]
      },
      ]
    });
  });
  $(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();
      //var tr = $(this).closest('tr');
      var nombre = $('#nombreField').val();
      var numero_cedula = $('#numero_cedulaField').val();
      var viaja_con_menores_de_17_anios = $('#viaja_con_menores_de_17_aniosField').val();
      var todos_los_nna_estan_matriculados = $('#todos_los_nna_estan_matriculadosField').val();
      var que_dispositvo_utilizan_en_clases_virtuales = $('#que_dispositvo_utilizan_en_clases_virtualesField').val();
      var celular_basico = $('#celular_basicoField').val();
      var smartphone = $('#smartphoneField').val();
      var laptop = $('#laptopField').val();
      var ninguno = $('#ningunoField').val();
      var que_dificultades_tuvo_al_matricular_nna = $('#que_dificultades_tuvo_al_matricular_nnaField').val();
      var no_conocia_procedimiento_matricula = $('#no_conocia_procedimiento_matriculaField').val();
      var no_cuento_con_los_documentos = $('#no_cuento_con_los_documentosField').val();
      var no_habia_vacantes = $('#no_habia_vacantesField').val();
      var otro = $('#otroField').val();
      
      var codMenores = $("input[name=menores]:checked").val();
      var codMatriculados = $("input[name=matriculados]:checked").val();
      var codCelular = $("input[name=celular]:checked").val();
      var codSmartphone = $("input[name=smartphone]:checked").val();
      var codLaptop = $("input[name=laptop]:checked").val();
      var codNinguno = $("input[name=ninguno]:checked").val();
      var codMatricula = $("input[name=matricula]:checked").val();
      var codDocumentos = $("input[name=documentos]:checked").val();
      var codVacantes = $("input[name=vacantes]:checked").val();
      var codOtro = $("input[name=otro]:checked").val();

      var trid = $('#trid').val();
      var id = $('#id').val();           

      $.ajax({
        url: "update_user_educacion.php",
        type: "post",
        data: {
          nombre: nombre,
          numero_cedula: numero_cedula,
          viaja_con_menores_de_17_anios: codMenores,
          todos_los_nna_estan_matriculados: codMatriculados,
          que_dispositvo_utilizan_en_clases_virtuales: que_dispositvo_utilizan_en_clases_virtuales,
          celular_basico: codCelular,
          smartphone: codSmartphone,
          laptop: codLaptop,
          ninguno: codNinguno,
          que_dificultades_tuvo_al_matricular_nna: que_dificultades_tuvo_al_matricular_nna,
          no_conocia_procedimiento_matricula: codMatricula,
          no_cuento_con_los_documentos: codDocumentos,
          no_habia_vacantes: codVacantes,
          otro: codOtro,
          id: id
        },
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'true') {
            table = $('#tablaUsuarios').DataTable();
            var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
            var row = table.row("[id='" + trid + "']");
            row.row("[id='" + trid + "']").data([id, nombre,  numero_cedula, codMenores, codMatriculados, que_dispositvo_utilizan_en_clases_virtuales, codCelular, codSmartphone, codLaptop, codNinguno, que_dificultades_tuvo_al_matricular_nna, codMatricula, codDocumentos, codVacantes, codOtro, button]);
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
        url: "get_single_educacion.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombreField').val(json.nombre);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#viaja_con_menores_de_17_aniosField').val(json.viaja_con_menores_de_17_anios);
          $('#todos_los_nna_estan_matriculadosField').val(json.todos_los_nna_estan_matriculados);
          $('#que_dispositvo_utilizan_en_clases_virtualesField').val(json.que_dispositvo_utilizan_en_clases_virtuales);
          $('#celular_basicoField').val(json.celular_basico);
          $('#smartphoneField').val(json.smartphone);
          $('#laptopField').val(json.laptop);
          $('#ningunoField').val(json.ninguno);
          $('#que_dificultades_tuvo_al_matricular_nnaField').val(json.que_dificultades_tuvo_al_matricular_nna);
          $('#no_conocia_procedimiento_matriculaField').val(json.no_conocia_procedimiento_matricula);
          $('#no_cuento_con_los_documentosField').val(json.no_cuento_con_los_documentos);
          $('#no_habia_vacantesField').val(json.no_habia_vacantes);
          $('#otroField').val(json.otro);
          $('#id').val(id);
          $('#trid').val(trid);

          //console.log("La Respuesta esta_de_acuerdoField es :" + json.esta_de_acuerdo);

          if (json.viaja_con_menores_de_17_anios == "1") {
            $('#exampleModal').find(':radio[name=menores][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=menores][value="0"]').prop('checked', true);
          }

          if (json.todos_los_nna_estan_matriculados == "1") {
            $('#exampleModal').find(':radio[name=matriculados][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=matriculados][value="0"]').prop('checked', true);
          }

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
          if (json.no_conocia_procedimiento_matricula == "1") {
            $('#exampleModal').find(':radio[name=matricula][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=matricula][value="0"]').prop('checked', true);
          }          
          if (json.no_cuento_con_los_documentos == "1") {
            $('#exampleModal').find(':radio[name=documentos][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=documentos][value="0"]').prop('checked', true);
          }          
          if (json.no_habia_vacantes == "1") {
            $('#exampleModal').find(':radio[name=vacantes][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=vacantes][value="0"]').prop('checked', true);
          }          
          if (json.otro == "1") {
            $('#exampleModal').find(':radio[name=otro][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=otro][value="0"]').prop('checked', true);
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
        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS EDUCACION</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateUser">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="trid" id="trid" value="">
          
          <div class="mb-3 row">
            <label for="nombreField" class="col-md-4 form-label">Nombre Beneficiario</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="nombreField" name="name" disabled>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="numero_cedulaField" class="col-md-4 form-label">Número Cedula</label>
            <div class="col-md-8">
              <input type="text" class="form-control" id="numero_cedulaField" name="name" disabled>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="viaja_con_menores_de_17_aniosField" class="col-md-4 form-label">¿Viaja con menores de 17 años?</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="menores" id="viaja_con_menores_de_17_aniosField1" value="1"> Si 
                <input type="radio" name="menores" id="viaja_con_menores_de_17_aniosField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="todos_los_nna_estan_matriculadosField" class="col-md-4 form-label">¿Todos los NNa estan matriculados?</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="matriculados" id="todos_los_nna_estan_matriculadosField1" value="1"> Si 
                <input type="radio" name="matriculados" id="todos_los_nna_estan_matriculadosField2" value="0"> No 
              </label>
            </div>
          </div>            
          <div class="mb-3 row">
            <label for="que_dispositvo_utilizan_en_clases_virtualesField" class="col-md-4 form-label">¿Que dispositivo utilizan en sus clases virtuales?</label>
            <div class="col-md-8">
              <!--input type="text" class="form-control" id="que_dispositvo_utilizan_en_clases_virtualesField" name="name"-->
              <textarea name="text" id="que_dispositvo_utilizan_en_clases_virtualesField" maxlength="250" rows="3" cols="60"></textarea>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="celular_basicoField" class="col-md-4 form-label">Celular basico?</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="celular" id="celular_basicoField1" value="1"> Si 
                <input type="radio" name="celular" id="celular_basicoField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="smartphoneField" class="col-md-4 form-label">Smartphone</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="smartphone" id="smartphoneField1" value="1"> Si 
                <input type="radio" name="smartphone" id="smartphoneField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="laptopField" class="col-md-4 form-label">Laptop</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="laptop" id="laptopField1" value="1"> Si 
                <input type="radio" name="laptop" id="laptopField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="ningunoField" class="col-md-4 form-label">Ninguno</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="ninguno" id="ningunoField1" value="1"> Si 
                <input type="radio" name="ninguno" id="ningunoField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="que_dificultades_tuvo_al_matricular_nnaField" class="col-md-4 form-label">¿Que dificultades tuvo al matricular a los menores?</label>
            <div class="col-md-8">
              <!--input type="text" class="form-control" id="que_dificultades_tuvo_al_matricular_nnaField" name="name"-->
              <textarea name="text" id="que_dificultades_tuvo_al_matricular_nnaField" maxlength="250" rows="3" cols="60"></textarea>
            </div>
          </div>            
          <div class="mb-3 row">
            <label for="no_conocia_procedimiento_matriculaField" class="col-md-4 form-label">No conocia los procedimiento de matricula</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="matricula" id="no_conocia_procedimiento_matriculaField1" value="1"> Si 
                <input type="radio" name="matricula" id="no_conocia_procedimiento_matriculaField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="no_cuento_con_los_documentosField" class="col-md-4 form-label">No cuento con los documentos</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="documentos" id="no_cuento_con_los_documentosField1" value="1"> Si 
                <input type="radio" name="documentos" id="no_cuento_con_los_documentosField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="no_habia_vacantesField" class="col-md-4 form-label">No habia vacantes</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="vacantes" id="no_habia_vacantesField1" value="1"> Si 
                <input type="radio" name="vacantes" id="no_habia_vacantesField2" value="0"> No 
              </label>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="otroField" class="col-md-4 form-label">Otro</label>
            <div class="col-md-8">
              <label class="radio-inline">
                <input type="radio" name="otro" id="otroField1" value="1"> Si 
                <input type="radio" name="otro" id="otroField2" value="0"> No 
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