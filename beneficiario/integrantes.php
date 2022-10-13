<?php include("../template/cabecera.php"); 

//require "vendor/autoload.php";
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include("../administrador/config/connection.php");

?>

<h1 class="display-8">DATOS DE LOS INTEGRANTES</h1> 

<div class="col-lg-12">
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Nombre&nbsp;del&nbsp;Beneficiario</th>
        <th>Numero&nbsp;de&nbsp;cedula</th>
        <th>Primer&nbsp;nombre</th>
        <th>Segundo&nbsp;nombre</th>
        <th>Primer&nbsp;apellido</th>
        <th>Segundo&nbsp;apellido</th>
        <th>Genero</th>
        <th>Fecha&nbsp;de&nbsp;nacimiento</th>
        <th>Parentesco</th>
        <th>Otro</th>
        <th>Tipo&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Numero&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Primer&nbsp;nombre</th>
        <th>Segundo&nbsp;nombre</th>
        <th>Primer&nbsp;apellido</th>
        <th>Segundo&nbsp;apellido</th>
        <th>Genero</th>
        <th>Fecha&nbsp;de&nbsp;nacimiento</th>
        <th>Parentesco</th>
        <th>Otro</th>
        <th>Tipo&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Numero&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Primer&nbsp;nombre</th>
        <th>Segundo&nbsp;nombre</th>
        <th>Primer&nbsp;apellido</th>
        <th>Segundo&nbsp;apellido</th>
        <th>Genero</th>
        <th>Fecha&nbsp;de&nbsp;nacimiento</th>
        <th>Parentesco</th>
        <th>Otro</th>
        <th>Tipo&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Numero&nbsp;de&nbsp;identificación&nbsp;</th>              
        <th>Primer&nbsp;nombre</th>
        <th>Segundo&nbsp;nombre</th>
        <th>Primer&nbsp;apellido</th>
        <th>Segundo&nbsp;apellido</th>
        <th>Genero</th>
        <th>Fecha&nbsp;de&nbsp;nacimiento</th>
        <th>Parentesco</th>
        <th>Otro</th>
        <th>Tipo&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Numero&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Primer&nbsp;nombre</th>
        <th>Segundo&nbsp;nombre</th>
        <th>Primer&nbsp;apellido</th>
        <th>Segundo&nbsp;apellido</th>
        <th>Genero</th>
        <th>Fecha&nbsp;de&nbsp;nacimiento</th>
        <th>Parentesco</th>
        <th>Otro</th>
        <th>Tipo&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Numero&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Primer&nbsp;nombre</th>
        <th>Segundo&nbsp;nombre</th>
        <th>Primer&nbsp;apellido</th>
        <th>Segundo&nbsp;apellido</th>
        <th>Genero</th>
        <th>Fecha&nbsp;de&nbsp;nacimiento</th>
        <th>Parentesco</th>
        <th>Otro</th>
        <th>Tipo&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Numero&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Primer&nbsp;nombre</th>
        <th>Segundo&nbsp;nombre</th>
        <th>Primer&nbsp;apellido</th>
        <th>Segundo&nbsp;apellido</th>
        <th>Genero</th>
        <th>Fecha&nbsp;de&nbsp;nacimiento</th>
        <th>Parentesco</th>
        <th>Otro</th>
        <th>Tipo&nbsp;de&nbsp;identificación&nbsp;</th>
        <th>Numero&nbsp;de&nbsp;identificación&nbsp;</th>
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
        'url': 'fetch_data_integrantes.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [73]
      },
      ]
    });
  }); 
  $(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();
      //var tr = $(this).closest('tr');
      var nombre_beneficiario = $('#nombre_beneficiarioField').val();
      var numero_cedula = $('#numero_cedulaField').val();
      var nombre_1a = $('#nombre_1aField').val();
      var nombre_1b = $('#nombre_1bField').val();
      var apellido_1a = $('#apellido_1aField').val();
      var apellido_1b = $('#apellido_1bField').val();
      var genero_1 = $('#genero_1Field').val();
      var fecha_nacimiento_1 = $('#fecha_nacimiento_1Field').val();
      var relacion_1 = $('#relacion_1Field').val();
      var otro_1 = $('#otro_1Field').val();      
      var tipo_identificacion_1 = $('#tipo_identificacion_1Field').val();
      var numero_identificacion_1 = $('#numero_identificacion_1Field').val();
      var nombre_2a = $('#nombre_2aField').val();
      var nombre_2b = $('#nombre_2bField').val();
      var apellido_2a = $('#apellido_2aField').val();
      var apellido_2b = $('#apellido_2bField').val();
      var genero_2 = $('#genero_2Field').val();
      var fecha_nacimiento_2 = $('#fecha_nacimiento_2Field').val();
      var relacion_2 = $('#relacion_2Field').val();
      var otro_2 = $('#otro_2Field').val();      
      var tipo_identificacion_2 = $('#tipo_identificacion_2Field').val();
      var numero_identificacion_2 = $('#numero_identificacion_2Field').val();
      var nombre_3a = $('#nombre_3aField').val();
      var nombre_3b = $('#nombre_3bField').val();
      var apellido_3a = $('#apellido_3aField').val();
      var apellido_3b = $('#apellido_3bField').val();
      var genero_3 = $('#genero_3Field').val();
      var fecha_nacimiento_3 = $('#fecha_nacimiento_3Field').val();
      var relacion_3 = $('#relacion_3Field').val();
      var otro_3 = $('#otro_3Field').val();      
      var tipo_identificacion_3 = $('#tipo_identificacion_3Field').val();
      var numero_identificacion_3 = $('#numero_identificacion_3Field').val();      
      var nombre_4a = $('#nombre_4aField').val();
      var nombre_4b = $('#nombre_4bField').val();
      var apellido_4a = $('#apellido_4aField').val();
      var apellido_4b = $('#apellido_4bField').val();
      var genero_4 = $('#genero_4Field').val();
      var fecha_nacimiento_4 = $('#fecha_nacimiento_4Field').val();
      var relacion_4 = $('#relacion_4Field').val();
      var otro_4 = $('#otro_4Field').val();      
      var tipo_identificacion_4 = $('#tipo_identificacion_4Field').val();
      var numero_identificacion_4 = $('#numero_identificacion_4Field').val();            
      var nombre_5a = $('#nombre_5aField').val();
      var nombre_5b = $('#nombre_5bField').val();
      var apellido_5a = $('#apellido_5aField').val();
      var apellido_5b = $('#apellido_5bField').val();
      var genero_5 = $('#genero_5Field').val();
      var fecha_nacimiento_5 = $('#fecha_nacimiento_5Field').val();
      var relacion_5 = $('#relacion_5Field').val();
      var otro_5 = $('#otro_5Field').val();      
      var tipo_identificacion_5 = $('#tipo_identificacion_5Field').val();
      var numero_identificacion_5 = $('#numero_identificacion_5Field').val();            
      var nombre_6a = $('#nombre_6aField').val();
      var nombre_6b = $('#nombre_6bField').val();
      var apellido_6a = $('#apellido_6aField').val();
      var apellido_6b = $('#apellido_6bField').val();
      var genero_6 = $('#genero_6Field').val();
      var fecha_nacimiento_6 = $('#fecha_nacimiento_6Field').val();
      var relacion_6 = $('#relacion_6Field').val();
      var otro_6 = $('#otro_6Field').val();      
      var tipo_identificacion_6 = $('#tipo_identificacion_6Field').val();
      var numero_identificacion_6 = $('#numero_identificacion_6Field').val();            
      var nombre_7a = $('#nombre_7aField').val();
      var nombre_7b = $('#nombre_7bField').val();
      var apellido_7a = $('#apellido_7aField').val();
      var apellido_7b = $('#apellido_7bField').val();
      var genero_7 = $('#genero_7Field').val();
      var fecha_nacimiento_7 = $('#fecha_nacimiento_7Field').val();
      var relacion_7 = $('#relacion_7Field').val();
      var otro_7 = $('#otro_7Field').val();      
      var tipo_identificacion_7 = $('#tipo_identificacion_7Field').val();
      var numero_identificacion_7 = $('#numero_identificacion_7Field').val();

      var trid = $('#trid').val();
      var id = $('#id').val();           

/*      if (region_beneficiario != '' && otra_region != '' && se_instalara_en_esta_region != '' && en_que_provincia != '' && transit_settle != '' && en_que_otro_caso_1 != '' && en_que_distrito != ''  && en_que_otro_caso_2 != '' && en_que_otro_caso_3 != '' && primer_nombre != '' && segundo_nombre != '' && primer_apellido != '' && segundo_apellido != '' && genero != '' && fecha_nacimiento != '' && tiene_carne_extranjeria != '' && numero_cedula != '' && fecha_caducidad_cedula != '' && tipo_identificacion != '' && numero_identificacion != '' && fecha_caducidad_identificacion != '' && documentos_fisico_original ) {
  */
        //console.log("esta_de_acuerdo : " + esta_de_acuerdo);
        //console.log("Valor seleccionado en RadioButton : " + cod);
        
        $.ajax({
          url: "update_user_integrantes.php",
          type: "post",
          data: {
            nombre_beneficiario: nombre_beneficiario,
            numero_cedula: numero_cedula,
            nombre_1a: nombre_1a,
            nombre_1b: nombre_1b,
            apellido_1a: apellido_1a,
            apellido_1b: apellido_1b,
            genero_1: genero_1,
            fecha_nacimiento_1: fecha_nacimiento_1,
            relacion_1: relacion_1,
            otro_1: otro_1,
            tipo_identificacion_1: tipo_identificacion_1,
            numero_identificacion_1: numero_identificacion_1,
            nombre_2a: nombre_2a,
            nombre_2b: nombre_2b,
            apellido_2a: apellido_2a,
            apellido_2b: apellido_2b,
            genero_2: genero_2,
            fecha_nacimiento_2: fecha_nacimiento_2,
            relacion_2: relacion_2,
            otro_2: otro_2,
            tipo_identificacion_2: tipo_identificacion_2,
            numero_identificacion_2: numero_identificacion_2,
            nombre_3a: nombre_3a,
            nombre_3b: nombre_3b,
            apellido_3a: apellido_3a,
            apellido_3b: apellido_3b,
            genero_3: genero_3,
            fecha_nacimiento_3: fecha_nacimiento_3,
            relacion_3: relacion_3,
            otro_3: otro_3,
            tipo_identificacion_3: tipo_identificacion_3,
            numero_identificacion_3: numero_identificacion_3,            
            nombre_4a: nombre_4a,
            nombre_4b: nombre_4b,
            apellido_4a: apellido_4a,
            apellido_4b: apellido_4b,
            genero_4: genero_4,
            fecha_nacimiento_4: fecha_nacimiento_4,
            relacion_4: relacion_4,
            otro_4: otro_4,
            tipo_identificacion_4: tipo_identificacion_4,
            numero_identificacion_4: numero_identificacion_4,
            nombre_5a: nombre_5a,
            nombre_5b: nombre_5b,
            apellido_5a: apellido_5a,
            apellido_5b: apellido_5b,
            genero_5: genero_5,
            fecha_nacimiento_5: fecha_nacimiento_5,
            relacion_5: relacion_5,
            otro_5: otro_5,
            tipo_identificacion_5: tipo_identificacion_5,
            numero_identificacion_5: numero_identificacion_5,
            nombre_6a: nombre_6a,
            nombre_6b: nombre_6b,
            apellido_6a: apellido_6a,
            apellido_6b: apellido_6b,
            genero_6: genero_6,
            fecha_nacimiento_6: fecha_nacimiento_6,
            relacion_6: relacion_6,
            otro_6: otro_6,
            tipo_identificacion_6: tipo_identificacion_6,
            numero_identificacion_6: numero_identificacion_6,
            nombre_7a: nombre_7a,
            nombre_7b: nombre_7b,
            apellido_7a: apellido_7a,
            apellido_7b: apellido_7b,
            genero_7: genero_7,
            fecha_nacimiento_7: fecha_nacimiento_7,
            relacion_7: relacion_7,
            otro_7: otro_7,
            tipo_identificacion_7: tipo_identificacion_7,
            numero_identificacion_7: numero_identificacion_7,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#tablaUsuarios').DataTable();
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, nombre_beneficiario, numero_cedula, nombre_1a, nombre_1b, apellido_1a, apellido_1b, genero_1, fecha_nacimiento_1, relacion_1, otro_1, tipo_identificacion_1, numero_identificacion_1, 
                nombre_2a, nombre_2b, apellido_2a, apellido_2b, genero_2, fecha_nacimiento_2, relacion_2, otro_2, tipo_identificacion_2, numero_identificacion_2, 
                nombre_3a, nombre_3b, apellido_3a, apellido_3b, genero_3, fecha_nacimiento_3, relacion_3, otro_3, tipo_identificacion_3, numero_identificacion_3, 
                nombre_4a, nombre_4b, apellido_4a, apellido_4b, genero_4, fecha_nacimiento_4, relacion_4, otro_4, tipo_identificacion_4, numero_identificacion_4, 
                nombre_5a, nombre_5b, apellido_5a, apellido_5b, genero_5, fecha_nacimiento_5, relacion_5, otro_5, tipo_identificacion_5, numero_identificacion_5, 
                nombre_6a, nombre_6b, apellido_6a, apellido_6b, genero_6, fecha_nacimiento_6, relacion_6, otro_6, tipo_identificacion_6, numero_identificacion_6,
                nombre_7a, nombre_7b, apellido_7a, apellido_7b, genero_7, fecha_nacimiento_7, relacion_7, otro_7, tipo_identificacion_7, numero_identificacion_7,
                button]);
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
        url: "get_single_integrantes.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nombre_beneficiarioField').val(json.nombre_beneficiario);
          $('#numero_cedulaField').val(json.numero_cedula);
          $('#nombre_1aField').val(json.nombre_1a);
          $('#nombre_1bField').val(json.nombre_1b);
          $('#apellido_1aField').val(json.apellido_1a);
          $('#apellido_1bField').val(json.apellido_1b);
          $('#genero_1Field').val(json.genero_1);
          $('#fecha_nacimiento_1Field').val(json.fecha_nacimiento_1);
          $('#relacion_1Field').val(json.relacion_1);
          $('#otro_1Field').val(json.otro_1);
          $('#tipo_identificacion_1Field').val(json.tipo_identificacion_1);
          $('#numero_identificacion_1Field').val(json.numero_identificacion_1);
          $('#nombre_2aField').val(json.nombre_2a);
          $('#nombre_2bField').val(json.nombre_2b);
          $('#apellido_2aField').val(json.apellido_2a);
          $('#apellido_2bField').val(json.apellido_2b);
          $('#genero_2Field').val(json.genero_2);
          $('#fecha_nacimiento_2Field').val(json.fecha_nacimiento_2);
          $('#relacion_2Field').val(json.relacion_2);
          $('#otro_2Field').val(json.otro_2);
          $('#tipo_identificacion_2Field').val(json.tipo_identificacion_2);
          $('#numero_identificacion_2Field').val(json.numero_identificacion_2);
          $('#nombre_3aField').val(json.nombre_3a);
          $('#nombre_3bField').val(json.nombre_3b);
          $('#apellido_3aField').val(json.apellido_3a);
          $('#apellido_3bField').val(json.apellido_3b);
          $('#genero_3Field').val(json.genero_3);
          $('#fecha_nacimiento_3Field').val(json.fecha_nacimiento_3);
          $('#relacion_3Field').val(json.relacion_3);
          $('#otro_3Field').val(json.otro_3);
          $('#tipo_identificacion_3Field').val(json.tipo_identificacion_3);
          $('#numero_identificacion_3Field').val(json.numero_identificacion_3);          
          $('#nombre_4aField').val(json.nombre_4a);
          $('#nombre_4bField').val(json.nombre_4b);
          $('#apellido_4aField').val(json.apellido_4a);
          $('#apellido_4bField').val(json.apellido_4b);
          $('#genero_4Field').val(json.genero_4);
          $('#fecha_nacimiento_4Field').val(json.fecha_nacimiento_4);
          $('#relacion_4Field').val(json.relacion_4);
          $('#otro_4Field').val(json.otro_4);
          $('#tipo_identificacion_4Field').val(json.tipo_identificacion_4);
          $('#numero_identificacion_4Field').val(json.numero_identificacion_4);
          $('#nombre_5aField').val(json.nombre_5a);
          $('#nombre_5bField').val(json.nombre_5b);
          $('#apellido_5aField').val(json.apellido_5a);
          $('#apellido_5bField').val(json.apellido_5b);
          $('#genero_5Field').val(json.genero_5);
          $('#fecha_nacimiento_5Field').val(json.fecha_nacimiento_5);
          $('#relacion_5Field').val(json.relacion_5);
          $('#otro_5Field').val(json.otro_5);
          $('#tipo_identificacion_5Field').val(json.tipo_identificacion_5);
          $('#numero_identificacion_5Field').val(json.numero_identificacion_5);
          $('#nombre_6aField').val(json.nombre_6a);
          $('#nombre_6bField').val(json.nombre_6b);
          $('#apellido_6aField').val(json.apellido_6a);
          $('#apellido_6bField').val(json.apellido_6b);
          $('#genero_6Field').val(json.genero_6);
          $('#fecha_nacimiento_6Field').val(json.fecha_nacimiento_6);
          $('#relacion_6Field').val(json.relacion_6);
          $('#otro_6Field').val(json.otro_6);
          $('#tipo_identificacion_6Field').val(json.tipo_identificacion_6);
          $('#numero_identificacion_6Field').val(json.numero_identificacion_6);
          $('#nombre_7aField').val(json.nombre_7a);
          $('#nombre_7bField').val(json.nombre_7b);
          $('#apellido_7aField').val(json.apellido_7a);
          $('#apellido_7bField').val(json.apellido_7b);
          $('#genero_7Field').val(json.genero_7);
          $('#fecha_nacimiento_7Field').val(json.fecha_nacimiento_7);
          $('#relacion_7Field').val(json.relacion_7);
          $('#otro_7Field').val(json.otro_7);
          $('#tipo_identificacion_7Field').val(json.tipo_identificacion_7);
          $('#numero_identificacion_7Field').val(json.numero_identificacion_7);
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
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS INTEGRANTES</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">

            <div class="row">
              <div class="col-4">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="integ1-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Familiar 1</a>
                  <a class="nav-link" id="integ2-tab" data-toggle="pill" href="#v-pills-integ2" role="tab" aria-controls="v-pills-integ2" aria-selected="false">Familiar 2</a>
                  <a class="nav-link" id="integ3-tab" data-toggle="pill" href="#v-pills-integ3" role="tab" aria-controls="v-pills-integ3" aria-selected="false">Familiar 3</a>
                  <a class="nav-link" id="integ4-tab" data-toggle="pill" href="#v-pills-integ4" role="tab" aria-controls="v-pills-integ4" aria-selected="false">Familiar 4</a>
                  <a class="nav-link" id="integ5-tab" data-toggle="pill" href="#v-pills-integ5" role="tab" aria-controls="v-pills-integ5" aria-selected="false">Familiar 5</a>
                  <a class="nav-link" id="integ6-tab" data-toggle="pill" href="#v-pills-integ6" role="tab" aria-controls="v-pills-integ6" aria-selected="false">Familiar 6</a>
                  <a class="nav-link" id="integ7-tab" data-toggle="pill" href="#v-pills-integ7" role="tab" aria-controls="v-pills-integ7" aria-selected="false">Familiar 7</a>
                </div>
              </div>
              <div class="col-8">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <label for="nombre_beneficiarioField" class="col-md-12 form-label">Nombre del Beneficiario</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_beneficiarioField" name="name" disabled>
                    </div>
                    <label for="numero_cedulaField" class="col-md-12 form-label">Numero cedula</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_cedulaField" name="cedula" maxlength="25" disabled>
                    </div>
                    <label for="nombre_1aField" class="col-md-12 form-label">1er Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_1aField" name="nombre_1a" maxlength="50">
                    </div>
                    <label for="nombre_1bField" class="col-md-12 form-label">2do Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_1bField" name="nombre_1b" maxlength="50">
                    </div> 
                    <label for="apellido_1aField" class="col-md-12 form-label">1er Apelido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_1aField" name="ape1a" maxlength="50">
                    </div>
                    <label for="apellido_1bField" class="col-md-12 form-label">2do Apellido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_1bField" name="ape1b" maxlength="50">
                    </div>
                    <label for="genero_1Field" class="col-md-12 form-label">Genero</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="genero_1Field" name="genero1" maxlength="50">
                    </div>
                    <label for="fecha_nacimiento_1Field" class="col-md-9 form-label">Fecha de  nacimiento</label>
                    <div class="col-md-9">
                      <input id="fecha_nacimiento_1Field" type="date" name="fecha1" value="2017-06-01">
                    </div>
                    <label for="relacion_1Field" class="col-md-12 form-label">Parentesco</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="relacion_1Field" name="relacion_1" maxlength="50">
                    </div>
                    <label for="otro_1Field" class="col-md-12 form-label">Otro</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="otro_1Field" name="otro_1" maxlength="50">
                    </div>
                    <label for="tipo_identificacion_1Field" class="col-md-12 form-label">Tipo de identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="tipo_identificacion_1Field" name="numiden1" maxlength="25">
                    </div>
                    <label for="numero_identificacion_1Field" class="col-md-12 form-label">Numero identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_identificacion_1Field" name="cedula1" maxlength="25">
                    </div>                    
                  </div>

                  <div class="tab-pane fade" id="v-pills-integ2" role="tabpanel" aria-labelledby="v-pills-integ2-tab">
                    <label for="nombre_2aField" class="col-md-12 form-label">1er Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_2aField" name="nombre_2a" maxlength="50">
                    </div>
                    <label for="nombre_2bField" class="col-md-12 form-label">2do Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_2bField" name="nombre_2b" maxlength="50">
                    </div> 
                    <label for="apellido_2aField" class="col-md-12 form-label">1er Apelido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_2aField" name="ape2a" maxlength="50">
                    </div>
                    <label for="apellido_2bField" class="col-md-12 form-label">2do Apellido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_2bField" name="ape2b" maxlength="50">
                    </div>
                    <label for="genero_2Field" class="col-md-3 form-label">Genero</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="genero_2Field" name="genero2" maxlength="50">
                    </div>
                    <label for="fecha_nacimiento_2Field" class="col-md-12 form-label">Fecha de  nacimiento</label>
                    <div class="col-md-12">
                      <input id="fecha_nacimiento_2Field" type="date" name="fecha2" value="2017-06-01">
                    </div>
                    <label for="relacion_2Field" class="col-md-12 form-label">Parentesco</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="relacion_2Field" name="relacion_2" maxlength="50">
                    </div>
                    <label for="otro_2Field" class="col-md-12 form-label">Otro</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="otro_2Field" name="otro_2" maxlength="50">
                    </div>
                    <label for="tipo_identificacion_2Field" class="col-md-12 form-label">Tipo de identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="tipo_identificacion_2Field" name="numiden2" maxlength="25">
                    </div>
                    <label for="numero_identificacion_2Field" class="col-md-12 form-label">Numero identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_identificacion_2Field" name="cedula2" maxlength="25">
                    </div>          
                  </div>

                  <div class="tab-pane fade" id="v-pills-integ3" role="tabpanel" aria-labelledby="v-pills-integ3-tab">
                    <label for="nombre_3aField" class="col-md-12 form-label">1er Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_3aField" name="nombre_3a" maxlength="50">
                    </div>
                    <label for="nombre_3bField" class="col-md-12 form-label">2do Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_3bField" name="nombre_3b" maxlength="50">
                    </div> 
                    <label for="apellido_3aField" class="col-md-12 form-label">1er Apelido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_3aField" name="ape3a" maxlength="50">
                    </div>
                    <label for="apellido_3bField" class="col-md-12 form-label">2do Apellido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_3bField" name="ape3b" maxlength="50">
                    </div>
                    <label for="genero_3Field" class="col-md-12 form-label">Genero</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="genero_3Field" name="genero3" maxlength="50">
                    </div>
                    <label for="fecha_nacimiento_3Field" class="col-md-12 form-label">Fecha de  nacimiento</label>
                    <div class="col-md-12">
                      <input id="fecha_nacimiento_3Field" type="date" name="fecha3" value="2017-06-01">
                    </div>
                    <label for="relacion_3Field" class="col-md-12 form-label">Parentesco</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="relacion_3Field" name="relacion_3" maxlength="50">
                    </div>
                    <label for="otro_3Field" class="col-md-12 form-label">Otro</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="otro_3Field" name="otro_3" maxlength="50">
                    </div>
                    <label for="tipo_identificacion_3Field" class="col-md-12 form-label">Tipo de identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="tipo_identificacion_3Field" name="numiden3" maxlength="25">
                    </div>
                    <label for="numero_identificacion_3Field" class="col-md-12 form-label">Numero identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_identificacion_3Field" name="cedula3" maxlength="25">
                    </div>     
                  </div>

                  <div class="tab-pane fade" id="v-pills-integ4" role="tabpanel" aria-labelledby="v-pills-integ4-tab">
                    <label for="nombre_4aField" class="col-md-12 form-label">1er Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_4aField" name="nombre_4a" maxlength="50">
                    </div>
                    <label for="nombre_4bField" class="col-md-12 form-label">2do Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_4bField" name="nombre_4b" maxlength="50">
                    </div> 
                    <label for="apellido_4aField" class="col-md-12 form-label">1er Apelido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_4aField" name="ape4a" maxlength="50">
                    </div>
                    <label for="apellido_4bField" class="col-md-12 form-label">2do Apellido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_4bField" name="ape4b" maxlength="50">
                    </div>
                    <label for="genero_4Field" class="col-md-12 form-label">Genero</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="genero_4Field" name="genero4" maxlength="50">
                    </div>
                    <label for="fecha_nacimiento_4Field" class="col-md-12 form-label">Fecha de  nacimiento</label>
                    <div class="col-md-12">
                      <input id="fecha_nacimiento_4Field" type="date" name="fecha4" value="2017-06-01">
                    </div>
                    <label for="relacion_4Field" class="col-md-12 form-label">Parentesco</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="relacion_4Field" name="relacion_4" maxlength="50">
                    </div>
                    <label for="otro_4Field" class="col-md-12 form-label">Otro</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="otro_4Field" name="otro_4" maxlength="50">
                    </div>
                    <label for="tipo_identificacion_4Field" class="col-md-12 form-label">Tipo de identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="tipo_identificacion_4Field" name="numiden4" maxlength="25">
                    </div>
                    <label for="numero_identificacion_4Field" class="col-md-12 form-label">Numero identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_identificacion_4Field" name="cedula4" maxlength="25">
                    </div>                         
                  </div>

                  <div class="tab-pane fade" id="v-pills-integ5" role="tabpanel" aria-labelledby="v-pills-integ5-tab">
                    <label for="nombre_5aField" class="col-md-12 form-label">1er Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_5aField" name="nombre_5a" maxlength="50">
                    </div>
                    <label for="nombre_5bField" class="col-md-12 form-label">2do Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_5bField" name="nombre_5b" maxlength="50">
                    </div> 
                    <label for="apellido_5aField" class="col-md-12 form-label">1er Apelido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_5aField" name="ape5a" maxlength="50">
                    </div>
                    <label for="apellido_5bField" class="col-md-12 form-label">2do Apellido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_5bField" name="ape5b" maxlength="50">
                    </div>
                    <label for="genero_5Field" class="col-md-12 form-label">Genero</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="genero_5Field" name="genero5" maxlength="50">
                    </div>
                    <label for="fecha_nacimiento_5Field" class="col-md-12 form-label">Fecha de  nacimiento</label>
                    <div class="col-md-12">
                      <input id="fecha_nacimiento_5Field" type="date" name="fecha5" value="2017-06-01">
                    </div>
                    <label for="relacion_5Field" class="col-md-12 form-label">Parentesco</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="relacion_5Field" name="relacion_5" maxlength="50">
                    </div>
                    <label for="otro_5Field" class="col-md-12 form-label">Otro</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="otro_5Field" name="otro_5" maxlength="50">
                    </div>
                    <label for="tipo_identificacion_5Field" class="col-md-12 form-label">Tipo de identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="tipo_identificacion_5Field" name="numiden5" maxlength="25">
                    </div>
                    <label for="numero_identificacion_5Field" class="col-md-12 form-label">Numero identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_identificacion_5Field" name="cedula5" maxlength="25">
                    </div>
                  </div>

                  <div class="tab-pane fade" id="v-pills-integ6" role="tabpanel" aria-labelledby="v-pills-integ6-tab">
                    <label for="nombre_6aField" class="col-md-12 form-label">1er Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_6aField" name="nombre_6a" maxlength="50">
                    </div>
                    <label for="nombre_6bField" class="col-md-12 form-label">2do Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_6bField" name="nombre_6b" maxlength="50">
                    </div> 
                    <label for="apellido_6aField" class="col-md-12 form-label">1er Apelido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_6aField" name="ape6a" maxlength="50">
                    </div>
                    <label for="apellido_6bField" class="col-md-12 form-label">2do Apellido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_6bField" name="ape6b" maxlength="50">
                    </div>
                    <label for="genero_6Field" class="col-md-12 form-label">Genero</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="genero_6Field" name="genero6" maxlength="50">
                    </div>
                    <label for="fecha_nacimiento_6Field" class="col-md-12 form-label">Fecha de  nacimiento</label>
                    <div class="col-md-12">
                      <input id="fecha_nacimiento_6Field" type="date" name="fecha6" value="2017-06-01">
                    </div>
                    <label for="relacion_6Field" class="col-md-12 form-label">Parentesco</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="relacion_6Field" name="relacion_6" maxlength="50">
                    </div>
                    <label for="otro_6Field" class="col-md-12 form-label">Otro</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="otro_6Field" name="otro_6" maxlength="50">
                    </div>
                    <label for="tipo_identificacion_6Field" class="col-md-12 form-label">Tipo de identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="tipo_identificacion_6Field" name="numiden6" maxlength="25">
                    </div>
                    <label for="numero_identificacion_6Field" class="col-md-12 form-label">Numero identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_identificacion_6Field" name="cedula6" maxlength="25">
                    </div>
                  </div>

                  <div class="tab-pane fade" id="v-pills-integ7" role="tabpanel" aria-labelledby="v-pills-integ7-tab">
                    <label for="nombre_7aField" class="col-md-12 form-label">1er Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_7aField" name="nombre_7a" maxlength="50">
                    </div>
                    <label for="nombre_7bField" class="col-md-12 form-label">2do Nombre</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="nombre_7bField" name="nombre_7b" maxlength="50">
                    </div> 
                    <label for="apellido_7aField" class="col-md-12 form-label">1er Apelido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_7aField" name="ape7a" maxlength="50">
                    </div>
                    <label for="apellido_7bField" class="col-md-12 form-label">2do Apellido</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="apellido_7bField" name="ape7b" maxlength="50">
                    </div>
                    <label for="genero_7Field" class="col-md-12 form-label">Genero</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="genero_7Field" name="genero7" maxlength="50">
                    </div>
                    <label for="fecha_nacimiento_7Field" class="col-md-12 form-label">Fecha de  nacimiento</label>
                    <div class="col-md-12">
                      <input id="fecha_nacimiento_7Field" type="date" name="fecha7" value="2017-06-01">
                    </div>
                    <label for="relacion_7Field" class="col-md-12 form-label">Parentesco</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="relacion_7Field" name="relacion_7" maxlength="50">
                    </div>
                    <label for="otro_7Field" class="col-md-12 form-label">Otro</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="otro_7Field" name="otro_7" maxlength="50">
                    </div>
                    <label for="tipo_identificacion_7Field" class="col-md-12 form-label">Tipo de identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="tipo_identificacion_7Field" name="numiden7" maxlength="25">
                    </div>
                    <label for="numero_identificacion_7Field" class="col-md-12 form-label">Numero identificación</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control" id="numero_identificacion_7Field" name="cedula7" maxlength="25">
                    </div>
                  </div>

                </div>
              </div>
            </div>            
            <div class="mb-3 row">
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