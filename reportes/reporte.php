<?php include("../administrador/template/cabecera.php"); ?>

<?php

//require_once './administrador/config/bd.php';
require_once ('../administrador/config/bdPDO.php');

$db_1 = new TransactionSCI();
//$conn_1 = $db_1->Connect();
//echo $insertId;

require_once ('../vendor/autoload.php');

if (isset($_POST["import"])) {
  $type = "OK";
  $dt = date('Y-m-d H:i:s');
  $timestamp1 = strtotime($dt);

  $db_1->migrar_data_historica();

  $var=true;
  if (!empty($var)) {        
    $type = "success";
    $message = "La migración se ha realizado con exito.";
  } else {
    $type = "error";
    $message = "Hubierón problemas al momento de la migración. Intente de nuevo";
  }

}

?>

<div class="col-md-12">
  <div class="card text-dark bg-light">
    <div class="card-header">
      Reportes de Control
    </div>
    <div class="card-body">
      <form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">En esta seccion podremos consultar los reportes de benficiarios por regiones.</label>
          <br>
          
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Consultar</button>
        </div>

      </form>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <!--button class="btn btn-primary" onclick="CargarDatosGraficoBar()">Grafico Bar</button-->  
          <canvas id="myChartV" width="100" height="100"></canvas>
        </div>        
        <div class="col-md-6">
          <!--button class="btn btn-primary" onclick="CargarDatosGraficoBarHorizontal()">Grafico Bar Horizontal</button--> 
          <canvas id="myChartH" width="100" height="100"></canvas>
        </div>   
      </div>
      <div class="col-md-6">
        <!--button class="btn btn-primary" onclick="CargarDatosGraficoBarHorizontal()">Grafico Bar Horizontal</button--> 
        <canvas id="myChartPie" width="100" height="100"></canvas>
      </div>   

    </div>

    <div class="card text-center">      
      <div class="card-body">
        <h4 class="card-title">Card title</h4>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
      <br>
          <label for="txtImagen">Seleccione una región.</label>
          <br>
          <br>
          <select name="selecttam" id="departamento" class="form-control-lg">
            <option value="" disabled selected>Seleccione una región</option>
            <?php 
            $datos = $db_1->traer_regiones();
            foreach($datos as $value) { ?>
              <option value="<?php echo $value['region']; ?>"><?php echo $value['region'];?></option>
            <?php } ?>
          </select>          
          <br>     
       <div class="btn-group" role="group" aria-label="Basic example">
          <button 
          class="btn btn-success btn-lg" onclick="CargarDatosGraficoBarParametro()">Consultar</button>
        </div>
      <div class="col-md-6">
        <canvas id="myCharBarParam" width="100" height="100"></canvas>
      </div>   
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


  CargarDatosGraficoBar();
  CargarDatosGraficoBarHorizontal();
  CargarDatosGraficoPie();    

  function CargarDatosGraficoBar(){
    $.ajax({
      url:'controlador_grafico.php',
      type:'POST'
    }).done(function(resp){
      var titulo = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(resp);
      for (var i = 0; i < data.length; i++) {
        titulo.push(data[i]['region']);
        cantidad.push(data[i]['total']);
        colores.push(colorRGB());
      }
      pintarGrafico('bar',titulo,cantidad,colores,'x','# de beneficiarios por regiones','myChartV')
    })
  }

  function CargarDatosGraficoBarHorizontal(){
    $.ajax({
      url:'controlador_grafico.php',
      type:'POST'
    }).done(function(resp){
      var titulo = [];
      var cantidad = [];
      var data = JSON.parse(resp);
      for (var i = 0; i < data.length; i++) {
        titulo.push(data[i]['region']);
        cantidad.push(data[i]['total']);
      }
      pintarGrafico('bar',titulo,cantidad,0,'y','# de beneficiarios por regiones Horizontal','myChartH')
    })
  }   

  function CargarDatosGraficoBarParametro(){
    var region = $("#departamento").val();
    $.ajax({
      url:'controlador_grafico_parametro.php',
      type:'POST',
      data:{
        dato_region:region
      }
    }).done(function(resp){
      var titulo = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(resp);
      for (var i = 0; i < data.length; i++) {
        titulo.push(data[i]['region']);
        cantidad.push(data[i]['total']);
        colores.push(colorRGB());
      }
      pintarGrafico('bar',titulo,cantidad,colores,'x','# de beneficiarios por regiones','myCharBarParam')
    })
  }

  function CargarDatosGraficoPie(){
    $.ajax({
      url:'controlador_grafico.php',
      type:'POST'
    }).done(function(resp){
      var titulo = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(resp);
      for (var i = 0; i < data.length; i++) {
        titulo.push(data[i]['region']);
        cantidad.push(data[i]['total']);
        colores.push(colorRGB());
      }
        //pintarGrafico('pie',titulo,cantidad,colores,'x','# de beneficiarios por regiones','myChartPie')
        const ctx = document.getElementById('myChartPie');
        myChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: titulo,
            datasets: [{
              label: 'Grafico Pie',
              data: cantidad,
              backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
              ]
            }]
          },
          plugins: [ChartDataLabels]
          /*ticks: {
            callback: function(value, index, values) {
              return '$' + value.toLocaleString();
            }
          }*/
        });
      })
  }

  function pintarGrafico(tipo,titulo,cantidad,colores,tipoAxis,encabezado,id){
    const ctx = document.getElementById(id);
    /* El bloque if solo se utilizara si queremos pintar varios graficos en la misma pagina. antes de dibujar un nuevo grafico, se valida si existe previamente, si es asi se elimina y se dibija el nuevo grafico.*/

      /*if (myChart) {
            myChart.destroy();
          }*/
          myChart = new Chart(ctx, {
            type: tipo,
            data: {
              labels: titulo,
              datasets: [
              {
                axis: tipoAxis,
                label: 'Hombre',
                data: cantidad,
                backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                borderColor: ['rgba(54, 162, 235, 1)'],
                borderWidth: 1,
                stack: 'Stack 0',
              },
              {
                axis: tipoAxis,
                label: 'Mujer',
                data: cantidad,
                backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)'],
                borderWidth: 1,
                stack: 'Stack 1',
              },
              {
                axis: tipoAxis,
                label: 'Otro',
                data: cantidad,
                backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)'],
                borderWidth: 1,
                stack: 'Stack 2'
              }
              ]
            },
            plugins: [ChartDataLabels],
            options: {
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