<?php include("../template/cabecera.php"); 

include("../administrador/config/connection.php");

?>

<h1 class="display-8">DATOS DE DERIVACION SECTORES</h1> 

<div class="col-lg-12">
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Nombres&nbsp;y&nbsp;apellidos&nbsp;del&nbsp;beneficiario</th>
        <th>Número&nbsp;de&nbsp;Cedula</th>                                
        <th>Programa&nbsp;de&nbsp;Nutrición&nbsp;¿&nbsp;participara&nbsp;?</th>  
        <th>Programa&nbsp;de&nbsp;Salud&nbsp;¿&nbsp;participara&nbsp;?</th>  
        <th>Programa&nbsp;Medio&nbsp;de&nbsp;Vida&nbsp;¿&nbsp;participara&nbsp;?</th> 
        <th>¿En&nbsp;cuál&nbsp;de&nbsp;las&nbsp;siguientes&nbsp;actividades&nbsp;estaria&nbsp;interesado&nbsp;en&nbsp;participar&nbsp;?</th> 
        <th>Capacitación&nbsp;de&nbsp;entrenamiento&nbsp;vocacional</th> 
        <th>Capacitación&nbsp;para&nbsp;iniciar&nbsp;emprendimiento</th> 
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
        'url': 'fetch_data_derivacion.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [9]
      },
      ]
    });
  });


  $(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();
      //var tr = $(this).closest('tr');
      var nombre = $('#nombreField').val();
      var numero_cedula = $('#numero_cedulaField').val();
      var interesado_participar_nutricion = $('#interesado_participar_nutricionField').val();
      var interesado_participar_salud = $('#interesado_participar_saludField').val();
      var interesado_participar_medios_vida = $('#interesado_participar_medios_vidaField').val();
      var actividades_interesado_participar = $('#actividades_interesado_participarField').val();
      var interesado_entrenamiento_vocacional = $('#interesado_entrenamiento_vocacionalField').val();
      var interesado_emprendimiento = $('#interesado_emprendimientoField').val();
      
      var codNutricion = $("input[name=nutricion]:checked").val();
      var codSalud = $("input[name=salud]:checked").val();
      var codVida = $("input[name=vida]:checked").val();
      var codVocacional = $("input[name=vocacional]:checked").val();
      var codEmprendimiento = $("input[name=emprendimiento]:checked").val();

      var trid = $('#trid').val();
      var id = $('#id').val();           
/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
  $.ajax({
    url: "update_user_derivacion.php",
    type: "post",
    data: {
      nombre: nombre,
      numero_cedula: numero_cedula,
      interesado_participar_nutricion: codNutricion,
      interesado_participar_salud: codSalud,
      interesado_participar_medios_vida: codVida,
      actividades_interesado_participar: actividades_interesado_participar,
      interesado_entrenamiento_vocacional: codVocacional,
      interesado_emprendimiento: codEmprendimiento,
      id: id
    },
    success: function(data) {
      var json = JSON.parse(data);
      var status = json.status;
      if (status == 'true') {
        table = $('#tablaUsuarios').DataTable();
        var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
        var row = table.row("[id='" + trid + "']");
        row.row("[id='" + trid + "']").data([id, nombre,  numero_cedula, codNutricion, codSalud, codVida, actividades_interesado_participar, codVocacional, codEmprendimiento, button]);
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
        url: "get_single_derivacion.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombreField').val(json.nombre);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#interesado_participar_nutricionField').val(json.interesado_participar_nutricion);
          $('#interesado_participar_saludField').val(json.interesado_participar_salud);
          $('#interesado_participar_medios_vidaField').val(json.interesado_participar_medios_vida);
          $('#actividades_interesado_participarField').val(json.actividades_interesado_participar);
          $('#interesado_entrenamiento_vocacionalField').val(json.interesado_entrenamiento_vocacional);
          $('#interesado_emprendimientoField').val(json.interesado_emprendimiento);
          $('#id').val(id);
          $('#trid').val(trid);

          //console.log("La Respuesta esta_de_acuerdoField es :" + json.esta_de_acuerdo);

          if (json.interesado_participar_nutricion == "1") {
            $('#exampleModal').find(':radio[name=nutricion][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=nutricion][value="0"]').prop('checked', true);
          }
          if (json.interesado_participar_salud == "1") {
            $('#exampleModal').find(':radio[name=salud][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=salud][value="0"]').prop('checked', true);
          }
          if (json.interesado_participar_medios_vida == "1") {
            $('#exampleModal').find(':radio[name=vida][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=vida][value="0"]').prop('checked', true);
          }
          if (json.interesado_entrenamiento_vocacional == "1") {
            $('#exampleModal').find(':radio[name=vocacional][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=vocacional][value="0"]').prop('checked', true);
          }
          if (json.interesado_emprendimiento == "1") {
            $('#exampleModal').find(':radio[name=emprendimiento][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=emprendimiento][value="0"]').prop('checked', true);
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
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS DERIVACION SECTORES</h5>
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
              <label for="interesado_participar_nutricionField" class="col-md-4 form-label">Programa Nutrición ¿participara?</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="nutricion" id="interesado_participar_nutricionField1" value="1"> Si 
                  <input type="radio" name="nutricion" id="interesado_participar_nutricionField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="interesado_participar_saludField" class="col-md-4 form-label">Programa Salud ¿participara?</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="salud" id="interesado_participar_saludField1" value="1"> Si 
                  <input type="radio" name="salud" id="interesado_participar_saludField2" value="0"> No 
                </label>
              </div>
            </div>            
            <div class="mb-3 row">
              <label for="interesado_participar_medios_vidaField" class="col-md-4 form-label">Programa Medios de Vida ¿participara?</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="vida" id="interesado_participar_medios_vidaField1" value="1"> Si 
                  <input type="radio" name="vida" id="interesado_participar_medios_vidaField2" value="0"> No 
                </label>
              </div>
            </div>            

            <div class="mb-3 row">
              <label for="actividades_interesado_participarField" class="col-md-4 form-label">¿En cuál de las actividades estaria interesado?</label>
              <div class="col-md-8">                
                <textarea name="text" id="actividades_interesado_participarField" maxlength="250" rows="3" cols="60"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="interesado_entrenamiento_vocacionalField" class="col-md-4 form-label">Entrenamiento Vocacional</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="vocacional" id="interesado_entrenamiento_vocacionalField1" value="1"> Si 
                  <input type="radio" name="vocacional" id="interesado_entrenamiento_vocacionalField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="interesado_emprendimientoField" class="col-md-4 form-label">Emprendimiento</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="emprendimiento" id="interesado_emprendimientoField1" value="1"> Si 
                  <input type="radio" name="emprendimiento" id="interesado_emprendimientoField2" value="0"> No 
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