<?php include("../template/cabecera.php"); 

//require "vendor/autoload.php";
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("../administrador/config/connection.php");

?>

<!--div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row"-->
      <h1 class="display-8">DATOS DE BENEFICIARIO</h1> 

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Codigo</th>
              <th>Primer&nbsp;nombre</th>
              <th>Segundo&nbsp;nombre</th>
              <th>Primer&nbsp;apellido</th>                                
              <th>Segundo&nbsp;apellido</th>  
              <th>Region&nbsp;beneficiario</th>
              <th>¿En&nbsp;que&nbsp;otra&nbsp;región?</th>
              <th>¿Se&nbsp;instalara&nbsp;en&nbsp;esta&nbsp;región?</th>
              <th>&nbsp;¿En&nbsp;que&nbsp;provincia&nbsp;se&nbsp;instalara?</th>
              <th>Transito&nbsp;o&nbsp;Estadia</th>
              <th>¿En&nbsp;que&nbsp;otra&nbsp;provincia&nbsp;se&nbsp;instalara?</th>
              <th>&nbsp;¿En&nbsp;que&nbsp;distrito&nbsp;se&nbsp;instalara?</th>
              <th>Otro&nbsp;caso</th>
              <th>¿En&nbsp;que&nbsp;otro&nbsp;distrito&nbsp;se&nbsp;instalara?</th>
              <th>Genero</th>
              <th>Fecha&nbsp;de&nbsp;nacimiento</th>
              <th>¿Tiene&nbsp;carne&nbsp;extranjeria?</th>
              <th>Numero&nbsp;de&nbsp;cedula</th>
              <th>Fecha&nbsp;caducidad&nbsp;cedula</th>
              <th>Tipo&nbsp;de&nbsp;identificación</th>
              <th>Numero&nbsp;de&nbsp;identificación</th>
              <th>Fecha&nbsp;de&nbsp;caducidad&nbsp;identificación</th>
              <th>¿Cual&nbsp;documento&nbsp;es&nbsp;fisico&nbsp;y&nbsp;original?</th>
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
              'url': 'fetch_data_beneficiario.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [23]
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
      var primer_nombre = $('#primer_nombreField').val();
      var segundo_nombre = $('#segundo_nombreField').val();
      var primer_apellido = $('#primer_apellidoField').val();
      var segundo_apellido = $('#segundo_apellidoField').val();
      var region_beneficiario = $('#region_beneficiarioField').val();
      var otra_region = $('#otra_regionField').val();
      var se_instalara_en_esta_region = $('#se_instalara_en_esta_regionField').val();
      var en_que_provincia = $('#en_que_provinciaField').val();
      var transit_settle = $('#transit_settleField').val();
      var en_que_otro_caso_1 = $('#en_que_otro_caso_1Field').val();
      var en_que_distrito = $('#en_que_distritoField').val();
      var en_que_otro_caso_2 = $('#en_que_otro_caso_2Field').val();
      var en_que_otro_caso_3 = $('#en_que_otro_caso_3Field').val();
      var genero = $('#generoField').val();
      var fecha_nacimiento = $('#fecha_nacimientoField').val();
      var tiene_carne_extranjeria = $('#tiene_carne_extranjeriaField').val();
      var numero_cedula = $('#numero_cedulaField').val();
      var fecha_caducidad_cedula = $('#fecha_caducidad_cedulaField').val();
      var tipo_identificacion = $('#tipo_identificacionField').val();
      var numero_identificacion = $('#numero_identificacionField').val();
      var fecha_caducidad_identificacion = $('#fecha_caducidad_identificacionField').val();
      var documentos_fisico_original = $('#documentos_fisico_originalField').val();
      
      var codRegion = $("input[name=region]:checked").val();
      var codCarnet = $("input[name=carne]:checked").val();

      var trid = $('#trid').val();
      var id = $('#id').val();           

/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
        //console.log("esta_de_acuerdo : " + esta_de_acuerdo);
        //console.log("Valor seleccionado en RadioButton : " + cod);
        
        $.ajax({
          url: "update_user_beneficiario.php",
          type: "post",
          data: {
            primer_nombre: primer_nombre,
            segundo_nombre: segundo_nombre,
            primer_apellido: primer_apellido,
            segundo_apellido: segundo_apellido,
            region_beneficiario: region_beneficiario,
            otra_region: otra_region,
            se_instalara_en_esta_region: codRegion,
            en_que_provincia: en_que_provincia,
            transit_settle: transit_settle,
            en_que_otro_caso_1: en_que_otro_caso_1,
            en_que_distrito: en_que_distrito,
            en_que_otro_caso_2: en_que_otro_caso_2,
            en_que_otro_caso_3: en_que_otro_caso_3,
            genero: genero,
            fecha_nacimiento: fecha_nacimiento,
            tiene_carne_extranjeria: codCarnet,
            numero_cedula: numero_cedula,
            fecha_caducidad_cedula: fecha_caducidad_cedula,
            tipo_identificacion: tipo_identificacion,
            numero_identificacion: numero_identificacion,
            fecha_caducidad_identificacion: fecha_caducidad_identificacion,
            documentos_fisico_original: documentos_fisico_original,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#tablaUsuarios').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, region_beneficiario, otra_region, codRegion, en_que_provincia, transit_settle, en_que_otro_caso_1, en_que_distrito, en_que_otro_caso_2, en_que_otro_caso_3,  genero, fecha_nacimiento, codCarnet, numero_cedula, fecha_caducidad_cedula, tipo_identificacion, numero_identificacion, fecha_caducidad_identificacion, documentos_fisico_original,  
                button]);
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
        url: "get_single_beneficiario.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#region_beneficiarioField').val(json.region_beneficiario);
          $('#otra_regionField').val(json.otra_region);
          $('#se_instalara_en_esta_regionField').val(json.se_instalara_en_esta_region);
          $('#en_que_provinciaField').val(json.en_que_provincia);
          $('#transit_settleField').val(json.transit_settle);
          $('#en_que_otro_caso_1Field').val(json.en_que_otro_caso_1);
          $('#en_que_distritoField').val(json.en_que_distrito);
          $('#en_que_otro_caso_2Field').val(json.en_que_otro_caso_2);
          $('#en_que_otro_caso_3Field').val(json.en_que_otro_caso_3);
          $('#primer_nombreField').val(json.primer_nombre);
          $('#segundo_nombreField').val(json.segundo_nombre);
          $('#primer_apellidoField').val(json.primer_apellido);
          $('#segundo_apellidoField').val(json.segundo_apellido);
          $('#generoField').val(json.genero);
          $('#fecha_nacimientoField').val(json.fecha_nacimiento);
          $('#tiene_carne_extranjeriaField').val(json.tiene_carne_extranjeria);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#fecha_caducidad_cedulaField').val(json.fecha_caducidad_cedula);
          $('#tipo_identificacionField').val(json.tipo_identificacion);
          $('#numero_identificacionField').val(json.numero_identificacion);
          $('#fecha_caducidad_identificacionField').val(json.fecha_caducidad_identificacion);
          $('#documentos_fisico_originalField').val(json.documentos_fisico_original);

          $('#id').val(id);
          $('#trid').val(trid);

          //console.log("La Respuesta esta_de_acuerdoField es :" + json.esta_de_acuerdo);

          if (json.se_instalara_en_esta_region == "1") {
            $('#exampleModal').find(':radio[name=region][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=region][value="0"]').prop('checked', true);
          }

          if (json.tiene_carne_extranjeria == "1") {
            $('#exampleModal').find(':radio[name=carne][value="1"]').prop('checked', true);
          } else {
            $('#exampleModal').find(':radio[name=carne][value="0"]').prop('checked', true);
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
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS BENEFICIARIO</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            
            <div class="mb-3 row">
              <label for="primer_nombreField" class="col-md-4 form-label">1er Nombre</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="primer_nombreField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_nombreField" class="col-md-4 form-label">2do Nombre</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="segundo_nombreField" name="email">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="primer_apellidoField" class="col-md-4 form-label">1er Apelido</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="primer_apellidoField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="segundo_apellidoField" class="col-md-4 form-label">2do Apellido</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="segundo_apellidoField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="region_beneficiarioField" class="col-md-4 form-label">Region Beneficiario</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="region_beneficiarioField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="otra_regionField" class="col-md-4 form-label">Otra region</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="otra_regionField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="se_instalara_en_esta_regionField" class="col-md-4 form-label">Se instalara en esta region?</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="region" id="se_instalara_en_esta_regionField1" value="1"> Si 
                  <input type="radio" name="region" id="se_instalara_en_esta_regionField2" value="0"> No 
                </label>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="en_que_provinciaField" class="col-md-4 form-label">En que provincia</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="en_que_provinciaField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="transit_settleField" class="col-md-4 form-label">En transito</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="transit_settleField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="en_que_otro_caso_1Field" class="col-md-4 form-label">Otro caso</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="en_que_otro_caso_1Field" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="en_que_distritoField" class="col-md-4 form-label">En que distrito</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="en_que_distritoField" name="City">
              </div>
            </div>            
            <div class="mb-3 row">
              <label for="en_que_otro_caso_2Field" class="col-md-4 form-label">Otro caso</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="en_que_otro_caso_2Field" name="City">
              </div>
            </div>            
            <div class="mb-3 row">
              <label for="en_que_otro_caso_3Field" class="col-md-4 form-label">Que otro distrito</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="en_que_otro_caso_3Field" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="generoField" class="col-md-4 form-label">Genero</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="generoField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="fecha_nacimientoField" class="col-md-4 form-label">Fecha nacimiento</label>
              <div class="col-md-8">
                <!--input type="text" class="form-control" id="fecha_nacimientoField" name="City"-->
                <input id="fecha_nacimientoField" type="date" name="fecha">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tiene_carne_extranjeriaField" class="col-md-4 form-label">Tiene carnet extranjeria</label>
              <div class="col-md-8">
                <label class="radio-inline">
                  <input type="radio" name="carne" id="tiene_carne_extranjeriaField1" value="1"> Si 
                  <input type="radio" name="carne" id="tiene_carne_extranjeriaField2" value="0"> No 
                </label>
                <!--input type="text" class="form-control" id="tiene_carne_extranjeriaField" name="City"-->
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_cedulaField" class="col-md-4 form-label">Numero cedula</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="numero_cedulaField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="fecha_caducidad_cedulaField" class="col-md-4 form-label">Fecha caducidad cedula</label>
              <div class="col-md-8">
                <!--input type="text" class="form-control" id="fecha_caducidad_cedulaField" name="City"-->
                <input id="fecha_caducidad_cedulaField" type="date" name="fecha">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tipo_identificacionField" class="col-md-4 form-label">Tipo identificación</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="tipo_identificacionField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_identificacionField" class="col-md-4 form-label">Numero identificación</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="numero_identificacionField" name="City">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="fecha_caducidad_identificacionField" class="col-md-4 form-label">Fecha Caducidad</label>
              <div class="col-md-8">
                <!--input type="text" class="form-control" id="fecha_caducidad_identificacionField" name="City"-->
                <input id="fecha_caducidad_identificacionField" type="date" name="fecha">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="documentos_fisico_originalField" class="col-md-4 form-label">Cual de los documentos es físico y original</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="documentos_fisico_originalField" name="City">
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