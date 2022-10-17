<?php include("../administrador/template/cabecera.php"); 

include("../administrador/config/connection.php");

?>
<h1 class="display-8">CONSULTA DE PAQUETES RECIBIDOS</h1> 

<div class="col-lg-12">
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed small" style="width:100%">
    <!--table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%"-->
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Estado&nbsp;de&nbsp;envío</th>
        <th>Fecha&nbsp;de&nbsp;envío</th>
        <th>Usuario&nbsp;de&nbsp;envío</th>
        <th>Estado&nbsp;de&nbsp;aprobación</th>
        <th>N°&nbsp;de&nbsp;beneficiarios</th>
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
        'url': 'fetch_data_paquetes_aprobacion.php',
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
      var estado = $('#estadoField').val();
      var fecha_envio = $('#fecha_envioField').val();
      var nombre_usuario = $('#nombre_usuarioField').val();
      var estado_aprobacion = $('#estado_aprobacionField').val();
      var numero_beneficiarios = $('#numero_beneficiariosField').val();
      
      var trid = $('#trid').val();
      var id = $('#id').val();
      
      $.ajax({
        url: "update_user_paquetes_aprobacion.php",
        type: "post",
        data: {
          estado: estado,
          fecha_envio: fecha_envio,
          nombre_usuario: nombre_usuario,
          estado_aprobacion: estado_aprobacion,
          numero_beneficiarios: numero_beneficiarios,
          id: id
        },
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'true') {
            table = $('#tablaUsuarios').DataTable();
            var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
            var row = table.row("[id='" + trid + "']");

            row.row("[id='" + trid + "']").data([id, estado, fecha_envio, nombre_usuario, estado_aprobacion, numero_beneficiarios, button]);
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
        url: "get_single_paquetes_aprobacion.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#estadoField').val(json.estado);
          $('#fecha_envioField').val(json.fecha_envio);
          $('#nombre_usuarioField').val(json.nombre_usuario);
          $('#estado_aprobacionField').val(json.estado_aprobacion);
          $('#numero_beneficiariosField').val(json.numero_beneficiarios);

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
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR ESTADO DE SOLICITUDES</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            
            <div class="mb-3 row">
              <label for="estadoField" class="col-md-3 form-label">Estado de envío</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="estadoField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="fecha_envioField" class="col-md-3 form-label">Fecha de envío</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="fecha_envioField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nombre_usuarioField" class="col-md-3 form-label">Usuario de envío</label>
              <div class="col-md-9">
                <textarea name="text" id="nombre_usuarioField" rows="3" cols="70" maxlength="250"></textarea>
              </div>
            </div>            
            <div class="mb-3 row">
              <label for="estado_aprobacionField" class="col-md-3 form-label">Estado Aprobación</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="estado_aprobacionField" name="name" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="numero_beneficiariosField" class="col-md-3 form-label">N° Beneficiarios</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="numero_beneficiariosField" name="name" disabled>
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


  <?php include("../administrador/template/pie.php"); ?>