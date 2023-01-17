<?php include("../administrador/template/cabecera.php"); ?>

<?php

//require_once './administrador/config/bd.php';
require_once ('../administrador/config/bdPDO.php');

$db_1 = new TransactionSCI();
//$conn_1 = $db_1->Connect();
//echo $insertId;

//require_once ('../vendor/autoload.php');

?>

<div class="col-md-12">
  <div class="card text-dark bg-light">
    <div class="card-header">
      Reportes de Control - Número de NNA matriculados en la escuela por regiones
    </div>
    <div class="card-body">
      <br>
      <div class="row">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6">
          <canvas id="myCharBarParam" width="100" height="75"></canvas>
        </div>
        <div class="col-md-3">&nbsp;</div>
      </div>
      <div class="row">
        <div class="col-md-12">&nbsp;</div>
      </div>
      <div class="row">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6" id="myDataTable"></div>
        <div class="col-md-3">&nbsp;</div>
      </div>                  
      <!--/form-->
    </div>
    <br>
  </div>

</div>
</div>
<div class="col-md-12">
  <div class=card-text>
    <div class="<?php if(!empty($type)) { echo $type . " alert alert-success role=alert"; } ?>"><?php if(!empty($var)) { echo $message; } ?>
  </div>
</div>
</div>

<script>

  let myChart;
  let numSpan = 0;
  
  CargarDatosGraficoBarParametro('SP_reporte_04_matriculados')
  CargarDatosTabla('SP_reporte_04_matriculados')


  function CargarDatosGraficoBarParametro(storedprocedure){    
    $.ajax({
      url:'controlador_grafico_sin_parametro.php',
      type:'POST',
      data:{
        dato_sp:storedprocedure
      }
    }).done(function(resp){
      var titulo = [];
      var cantidad_1 = [];
      var colores = [];
      var data = JSON.parse(resp);
      for (var i = 0; i < data.length; i++) {
        titulo.push(data[i]['region']);
        cantidad_1.push(data[i]['total']);
        colores.push(colorRGB());
      }
      pintarGrafico('bar',titulo,cantidad_1,colores,'x','# de beneficiarios por regiones','myCharBarParam')
    })
  }

  function CargarDatosTabla(storedprocedure){    
    //var region = $("#departamento").val();
    $.ajax({
      url:'controlador_grafico_sin_parametro.php',
      type:'POST',
      data:{
        //dato_region:region,
        dato_sp:storedprocedure
      }
    }).done(function(resp){

      var col = [];
      var data = JSON.parse(resp);
      var tableBody = document.getElementById("myDataTable");
      for (var i = 0; i < data.length; i++) {
        for (var key in data[i]) {
          if (col.indexOf(key) === -1) {
            col.push(key);
          }
        }
      }
       // CREATE DYNAMIC TABLE.
       var table = document.createElement("table");
       table.className = 'table table-striped table-bordered table-condensed';

      // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.
      var tr = table.insertRow(-1);                   // TABLE ROW.
      for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
          }
        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {
          tr = table.insertRow(-1);
          for (var j = 0; j < col.length; j++) {
            var tabCell = tr.insertCell(-1);
            tabCell.innerHTML = data[i][col[j]];
          }
        }
        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        var divContainer = document.getElementById("myDataTable");
        //ctx = divContainer.getContext('2d');

        //divContainer.innerHTML = "";
        //divContainer.appendChild(table);
        if( numSpan == 0 ){
          divContainer.append(table);
          numSpan += 1;
        }
        console.log(numSpan)
      })
  }

  function pintarGrafico(tipo,titulo,c1,colores,tipoAxis,encabezado,id){
    const ctx = document.getElementById(id);
    /* El bloque if solo se utilizara si queremos pintar varios graficos en la misma pagina. antes de dibujar un nuevo grafico, se valida si existe previamente, si es asi se elimina y se dibija el nuevo grafico.*/

    if (myChart) {
      myChart.destroy();
    }
    myChart = new Chart(ctx, {
      type: tipo,      
      data: {
        labels: titulo,
        datasets: [
        {
          axis: tipoAxis,
          label: 'Total',
          data: c1,
          backgroundColor: ['rgba(54, 162, 235, 0.2)'],
          borderColor: ['rgba(54, 162, 235, 1)'],
          borderWidth: 1,
          stack: 'Stack 0',
        }
        ]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
          title: {
            display: true,
            text: 'NNA matriculados en la escuela por regiones'
          },
        },

        indexAxis: tipoAxis,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  function generarNumero(numero){
    return (Math.random()*numero).toFixed(0);
  }

  function colorRGB(){
    var coolor = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) +")";
    return "rgb" + coolor;
  }   
</script>

<?php include("../administrador/template/pie.php"); ?>