<?php include("../administrador/template/cabecera.php"); 

include("../administrador/config/connection.php");

?>

<script type="text/javascript" src="script/bootbox.min.js"></script>
<!--script type="text/javascript" src="script/deleteRecords.js"></script-->

<h1 class="display-8">CONSULTA PERIODOS CARGADOS JETPERÚ</h1> 
<br>
<div class="container">

</div>
<div class="col-lg-12">
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto nowrap small" style="width:100%">
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Mes</th>
        <th>Año</th>
        <th>Total&nbsp;registros</th>
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
      'serverSide': 'true',
      'processing': 'true',
      'paging': 'true',
      'order': [],
      'ajax': {
        'url': 'delete_reporte_jetperu_fetch_data.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [4]
      },
      ]
    });
  });
  // codigo para descargar el formato JETPERU
  $('#tablaUsuarios').on('click', '.deletebtn', function(e) {
    e.preventDefault();
    var trid = $('#trid').val();
    //var id = $('#id').val();
    var id = $(this).data('id');    
    bootbox.confirm("¿ Está seguro de que desea eliminar el periodo ? ", function(result) {
      if(result){
        $.ajax({
          url: "repo_finanza_jetperu.php",
          type: "get",
          data: {
            id: id
          },
          success: function(data) {
            window.open('repo_finanza_jetperu.php?id='+id,'_blank' ); 
          }
        });
      }
    }); 
  }); 

</script>

<?php include("../administrador/template/pie.php"); ?>