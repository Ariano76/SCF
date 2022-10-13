<?php include("../administrador/template/cabecera.php"); 

//include("../administrador/config/connection.php");
require_once '../administrador/config/bdPDO.php';
$db_1 = new TransactionSCI();

?>
<style type="text/css">
  .btnAdd {
    text-align: right;
    width: 100%;
    margin-bottom: 20px;
  }
</style>

<h1 class="display-8">MAESTRO DE SUBTEMAS</h1> 
<div class="container">

</div>

<div class="col-lg-12">
  <div class="btnAdd">
    <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-lg">Agregar Nuevo Item</a>
  </div>
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed small" style="width:100%">
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Nombre&nbsp;de&nbsp;Item</th>
        <th>Nombre&nbsp;de&nbsp;Tema</th>
        <th>Id&nbsp;Tema</th>
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
        'url': 'subtema_fetch_data.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [4]
      },
      ]
    });
  });
  $(document).on('submit', '#addUser', function(e) {
    e.preventDefault();
    var nom_subtema = $('#addnom_subtemaField').val();
    var id_tema = $('#addnom_temaField').val();

    if (nom_subtema != '') {
      $.ajax({
        url: "subtema_add.php",
        type: "post",
        data: {
          nom_subtema: nom_subtema,
          id_tema: id_tema
        },
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'true') {
            mytable = $('#tablaUsuarios').DataTable();
            mytable.draw();
            $('#addUserModal').modal('hide');
          } else {
            alert('failed');
          }
        }
      });
    } else {
      alert('Complete todos los campos requeridos');
    }
  });  

  $(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();
    var nom_subtema = $('#nom_subtemaField').val();
    // recuperando el text del item seleccionado en un control SELECT
    var nom_tema = $("#nom_temaField option:selected").text(); 
    // recuperando el value del item seleccionado en un control SELECT
    var id_tema = $('#nom_temaField').val();

    var trid = $('#trid').val();
    var id = $('#id').val();    

    if (nom_subtema != '') {
      $.ajax({
        url: "subtema_update.php",
        type: "post",
        data: {
          nom_subtema: nom_subtema,
          nom_tema: nom_tema,
          id_tema: id_tema,
          
          id: id
        },
        success: function(data) {
          var json = JSON.parse(data);
          var status = json.status;
          if (status == 'true') {
            table = $('#tablaUsuarios').DataTable();
            var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a> </td>';
            var row = table.row("[id='" + trid + "']");

            row.row("[id='" + trid + "']").data([id, nom_subtema, nom_tema, id_tema, button]);
            $('#exampleModal').modal('hide');
          } else {
            alert('failed');
          }
          /*console.log("subtema :" + nom_subtema);
          console.log("tema :" + nom_tema);
          console.log("codigo de tema :" + id_tema);*/
        }
      });
    } else {
      alert('Complete todos los campos requeridos');
    }
  });
  $('#tablaUsuarios').on('click', '.editbtn ', function(event) {
    var table = $('#tablaUsuarios').DataTable();
    var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "subtema_get_single.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nom_subtemaField').val(json.nom_subtema);
          $('#nom_temaField').val(json.nom_tema);
          //$('#id_temaField').val(json.id_tema);
          $('#id').val(id);
          $('#trid').val(trid);
          
          // RECORRIENDO LOS ELEMENTOS DEL SELECT Y ;
          var selectObj = document.getElementById("nom_temaField");
          var codigotema = 0;
          for (var i = 0; i < selectObj.options.length; i++) {
            if (selectObj.options[i].text== json.nom_tema) {
              selectObj.options[i].selected = true;
              codigotema = selectObj.options[i];
              return;
            }
          }

          console.log("tema :" + json.nom_tema);
          console.log("codigo de tema :" + codigotema);
        }
      })
    });


  </script>
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR ITEM</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">

            <div class="mb-3 row">
              <label for="nom_subtemaField" class="col-md-3 form-label">Nombre Item</label>
              <div class="md-form amber-textarea active-amber-textarea col-md-8">
                <input type="text" class="form-control" id="nom_subtemaField" name="tipoident" maxlength="50">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nom_temaField" class="col-md-3 form-label">Tema</label>
              <div class="col-md-8">
                <!--input type="text" class="form-control" id="addnom_subtemaField" name="tipoident" maxlength="50"-->
                <select class="form-select" id="nom_temaField" aria-label="Default select example" name="estatus">
                  <?php 
                  $datos = $db_1->traer_tema();
                  foreach($datos as $value) { ?>
                    <option value="<?php echo $value['id_tema']; ?>"><?php echo $value['nom_tema'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add user Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">AGREGAR NUEVO ITEM</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addnom_subtemaField" class="col-md-3 form-label">Item</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addnom_subtemaField" name="tipoident" maxlength="50">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addnom_subtemaField" class="col-md-3 form-label">Tema</label>
              <div class="col-md-9">
                <!--input type="text" class="form-control" id="addnom_subtemaField" name="tipoident" maxlength="50"-->
                <select class="form-select" id="addnom_temaField" aria-label="Default select example" name="estatus">
                  <?php 
                  $datos = $db_1->traer_tema();
                  foreach($datos as $value) { ?>
                    <option value="<?php echo $value['id_tema']; ?>"><?php echo $value['nom_tema'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Grabar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <?php include("../administrador/template/pie.php"); ?>