<?php include("../template/cabecera.php"); 

include("../administrador/config/connection.php");

?>
      <h1 class="display-8">REPORTE DE CAMBIOS EN ENTIDADES</h1> 

      <div class="col-lg-12">
        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed w-auto small nowrap" style="width:100%">
          <thead class="text-center">
            <tr>
              <th>Fecha&nbsp;de&nbsp;actualización</th>
              <th>Nombre&nbsp;Beneficiario</th>
              <th>Numero&nbsp;de&nbsp;cedula</th>
              <th>Entidad</th>
              <th>Codigo</th>
              <!--th>Acción</th-->
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
              'url': 'fetch_data_bitacora.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [4]
            },
            ]
          });
        });
  </script>


  <?php include("../template/pie.php"); ?>