<?php include("../administrador/template/cabecera.php"); 

include("../administrador/config/connection.php");

?>
<h1 class="display-8">CONSULTA PAQUETES APROBADOS</h1> 
<br>
<div class="container">

</div>
<div class="col-lg-12">
  <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto nowrap small" style="width:100%">
    <thead class="text-center">
      <tr>
        <th>Codigo</th>
        <th>Fecha&nbsp;de&nbsp;envio</th>
        <th>Estado</th>
        <th>Fecha&nbsp;de&nbsp;aprobación</th>
        <th>N°&nbsp;de&nbsp;beneficiarios</th>
        <th>Tarjeta 1</th>
        <th>Tarjeta 2</th>
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
        'url': 'fetch_data_finanza_paquete.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [6]
      },
      ]
    });
  });
  // codigo para descargar el formato TPP
  $('#tablaUsuarios').on('click', '.downloadbtn', function(e) {
    e.preventDefault();
    var trid = $('#trid').val();
    //var id = $('#id').val();
    var id = $(this).data('id');    
    //$('#downloadModal').modal('show');
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
  });  

</script>

<?php include("../administrador/template/pie.php"); ?>